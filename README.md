# QLS label POC
This serves as a POC to connect with QLS API's.

## Requirements
* PHP 7.3 or higher (tested on)
* Imagick PHP extension

## Installation
The front-end for the application has to be built with Yarn (NodeJS).

1. Download NodeJS from: https://nodejs.org/en/download/
2. Install Yarn globally: `npm install -g yarn`
3. Git clone this repo: `git clone https://github.com/BowlOfSoup/qls-label.git`
4. Run `composer install` in the project root
5. Do `cp .env .env.local` and configure `QLS_API_USER` and `QLS_API_PASS`.

## Run
Build the front-end:

`yarn install && yarn build`

You will need to have Symfony installed globally: [https://symfony.com/download]().

`symfony serve --no-tls` and visit http://127.0.0.1:8000/

## What does it do?
It displays some basic (default) information on a page.
You can fill in some details and choose a shipping product.
When submitting the form, a PDF is downloaded which serves as a shipping label.

Code uses Symfony, Forms, HTTP client, Twig (template engine), some external bundles.
