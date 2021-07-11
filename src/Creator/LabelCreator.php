<?php

declare(strict_types=1);

namespace App\Creator;

use App\Model\Response\Brand;
use Knp\Snappy\Pdf as SnappyPdf;
use Spatie\PdfToImage\Pdf as SpatiePdf;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Twig\Environment;

class LabelCreator
{
    /** @var HttpClientInterface */
    private $client;

    /** @var Environment */
    private $twig;

    /** @var SnappyPdf */
    private $snappyPdf;

    public function __construct(
        HttpClientInterface $client,
        Environment $twig,
        SnappyPdf $snappyPdf
    ) {
        $this->client = $client;
        $this->twig = $twig;
        $this->snappyPdf = $snappyPdf;
    }

    /**
     * @throws \Spatie\PdfToImage\Exceptions\InvalidFormat
     * @throws \Spatie\PdfToImage\Exceptions\PdfDoesNotExist
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Exception
     */
    public function createShippingLabel(
        array $shippingData,
        Brand $brand,
        array $orderLines
    ): string {
        if (!empty($shippingData['errors'])) {
            var_dump($shippingData['errors']); die(); // Nasty, but no time to do better.
        }

        $imageLocation = $this->getLabelForShippingProduct($shippingData['data']['labels']);
        $pdfDir = sprintf('%s/shipping_label.pdf', sys_get_temp_dir());

        // lol
        $bootstrapCss = file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');

        $this->snappyPdf->generateFromHtml(
            $this->twig->render(
                'label/shipping_label.html.twig', [
                    'labelImage' => $this->encodeImage($imageLocation),
                    'shippingData' => $shippingData,
                    'bootstrapCss' => $bootstrapCss,
                    'brand' => $brand,
                    'orderLines' => $orderLines,
                ]
            ),
            $pdfDir, [], true
        );

        return $pdfDir;
    }

    /**
     * @throws \Spatie\PdfToImage\Exceptions\InvalidFormat
     * @throws \Spatie\PdfToImage\Exceptions\PdfDoesNotExist
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     * @throws \Exception
     */
    private function getLabelForShippingProduct(array $labelData): string
    {
        $pdfLabelUrl = $labelData['a6'];

        $response = $this->client->request('GET', $pdfLabelUrl);
        if (200 !== $response->getStatusCode()) {
            throw new \Exception(sprintf('Can\'t get the PDF label, response code: %s', $response->getStatusCode()));
        }

        $pdfFileLocation = sprintf('%s/label.pdf', sys_get_temp_dir());
        $fileHandler = fopen($pdfFileLocation, 'w');
        foreach ($this->client->stream($response) as $chunk) {
            fwrite($fileHandler, $chunk->getContent());
        }

        // This is quite untestable -> needs refactoring.
        $pdf = (new SpatiePdf($pdfFileLocation))
            ->setOutputFormat('png');

        $pdfToImageFileLocation = sprintf('%s/image.png', sys_get_temp_dir());
        $pdf->saveImage($pdfToImageFileLocation);

        return $pdfToImageFileLocation;
    }

    private function encodeImage(string $imageLocation): string
    {
        $type = pathinfo($imageLocation, PATHINFO_EXTENSION);
        $data = file_get_contents($imageLocation);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}