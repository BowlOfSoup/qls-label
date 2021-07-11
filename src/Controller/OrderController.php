<?php

namespace App\Controller;

use App\Creator\LabelCreator;
use App\Creator\ShipmentCreator;
use App\Fetcher\BrandFetcher;
use App\Fetcher\ProductFetcher;
use App\Form\OrderFormType;
use App\Model\Order;
use App\Service\DummyOrderLinesService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mime\FileinfoMimeTypeGuesser;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /** @var string */
    private $qlsDefaultCompanyId;

    /** @var BrandFetcher */
    private $brandFetcher;

    /** @var ProductFetcher */
    private $productFetcher;

    /** @var ShipmentCreator */
    private $shipmentCreator;

    /** @var LabelCreator */
    private $labelCreator;

    public function __construct(
        string $qlsDefaultCompanyId,
        BrandFetcher $brandFetcher,
        ProductFetcher $productFetcher,
        ShipmentCreator $shipmentCreator,
        LabelCreator $labelCreator
    ) {
        $this->qlsDefaultCompanyId = $qlsDefaultCompanyId;
        $this->brandFetcher = $brandFetcher;
        $this->productFetcher = $productFetcher;
        $this->shipmentCreator = $shipmentCreator;
        $this->labelCreator = $labelCreator;
    }

    /**
     * @Route("/", name="order")
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Exception
     */
    public function index(Request $request): Response
    {
        $brand = $this->brandFetcher->fetchRandomBrandByCompany($this->qlsDefaultCompanyId);
        $dummyOrderLines = DummyOrderLinesService::getDummyOrderLines();

        $order = (new Order())->setBrandId($brand->getId());
        $form = $this->createForm(OrderFormType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Order $order */
            $order = $form->getData();

            $shippingData = $this->shipmentCreator->createShipment($this->qlsDefaultCompanyId, $order);
            $shippingLabelLocation = $this->labelCreator->createShippingLabel(
                $shippingData,
                $brand,
                $dummyOrderLines
            );

            return $this->createDownloadResponse($shippingLabelLocation);
        }

        return $this->render('order/order.html.twig', [
            'brand' => $brand,
            'orderLines' => $dummyOrderLines,
            'products' => $this->productFetcher->fetchAllProductsByCompany($this->qlsDefaultCompanyId),
            'orderForm' => $form->createView(),
        ]);
    }

    /**
     * @throws \Exception
     */
    private function createDownloadResponse(string $shippingLabelLocation): BinaryFileResponse
    {
        $response = new BinaryFileResponse($shippingLabelLocation);

        $mimeTypeGuesser = new FileinfoMimeTypeGuesser(); // Not testable, needs injection!
        if ($mimeTypeGuesser->isGuesserSupported()){
            $response->headers->set('Content-Type', $mimeTypeGuesser->guessMimeType($shippingLabelLocation));
        } else {
            throw new \Exception('Shipping label file content type could not be determined.');
        }

        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'shipping_label.pdf');

        return $response;
    }
}
