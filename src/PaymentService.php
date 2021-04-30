<?php

namespace Eonlab;

use Eonlab\Constants\PayOp;
use Eonlab\Constants\ReturnHandleUrls;
use Eonlab\Exceptions\CardTokenizationException;
use Eonlab\Exceptions\CreateInvoiceException;
use Eonlab\Exceptions\GetPaymentMethodException;
use GuzzleHttp\Exception\GuzzleException;
use Eonlab\Shared\HttpRequests;

class PaymentService extends HttpRequests
{
    const BASE_URL = 'https://payop.com/v1/';
    const VisaID = 773;
    const PAYER = [
        "email"       => "test.user@payop.com",
        "phone"       => "",
        "name"        => "",
        "extraFields" => [],
    ];

    public string $serviceToken;
    public string $projectID;

    /**
     * Setting Config For Service
     */
    public function setConfig($serviceToken, $projectID)
    {
        $this->serviceToken = $serviceToken;
        $this->projectID = $projectID;
    }

    /**
     * Build Uri
     *
     * @param string $endpoints
     *
     * @return string
     */
    protected function buildUri($endpoints): string
    {
        return self::BASE_URL . $endpoints;
    }

    /**
     * @param string $invoiceID
     * @param Payer  $payer
     *
     * @return array
     * @throws CardTokenizationException
     */
    public function cardTokenization(string $invoiceID, Payer $payer): array
    {
        $uri = $this->buildUri('payment-tools/card-token/create');
        $payload = $payer->toArray();
        $payload['invoiceIdentifier'] = $invoiceID;
        $response = $this->_request('POST', $uri, $payload);
        if ($response->getStatusCode() !== 200 ) {
            throw new CardTokenizationException();
        }
        return $response->getBody();
    }

    /**
     * Get Payment Method From service
     *
     * @return array
     * @throws GetPaymentMethodException
     */
    public function getPaymentMethods(): APIResponse
    {
        $uri = $this->buildUri('instrument-settings/payment-methods/available-for-application/' . $this->projectID);
        $response = $this->_request('GET', $uri);
        if ($response->getStatusCode() !== 200 ) {
            throw new GetPaymentMethodException();
        }
        return $response->getBody();
    }


    /**
     * Making the payment
     *
     * @param Order $order
     * @param Payer $payer
     *
     * @throws CardTokenizationException
     */
    public function checkout(Order $order, Payer $payer)
    {
        [$invoice, $response] = $this->createInvoice($order);
        $invoiceID = $response->geIdentifier();
        try {
            $token = $this->cardTokenization($invoiceID, $payer);
        } catch (CardTokenizationException $e) {

        }
        $uri = $this->buildUri('checkout/create');
        $payload = [
            "invoiceIdentifier" => $invoiceID,
            "customer"          =>
                [
                    "email" => "test@email.com",
                    "ip"    => "127.0.0.1",
                ],
            "checkStatusUrl"    => "https://your.site/check-status/{{txid}}",
            "payCurrency"       => $order->getCurrency(),
            "paymentMethod"     => $invoice->getPaymentMethod(),
            "cardToken"         => $token,
        ];

        try {
            $response = $this->_request('POST', $uri, $payload);
        } catch (Exceptions\ServiceException $e) {
            var_dump($e);
            return 'failure';
        } catch (GuzzleException $e) {
            var_dump($e);
            return 'failure';
        }
        return $response->getBody();
    }

    /**
     * Sign & Return Payload Data & Signature
     *
     * @param Order $order
     *
     * @return string
     */
    protected function sign(Order $order): string
    {
        $dataSet = [$order->getAmount(), $order->getCurrency(), $order->getOrderID(), config('payop.secret_key')];
        return hash('sha256', implode(':', $dataSet));
    }

    /**
     * @param Invoice    $invoice
     * @param \BNG\Order $order
     * @param string     $signature
     *
     * @return array
     */
    public function invoiceObjectCreate(Invoice $invoice, Order $order, string $signature): array
    {
        $invoice->setOrder($order->toArray());
        $invoice->setSignature($signature);
        $invoice->setPaymentMethod(261);
        $invoice->setPayer(self::PAYER);
        $invoice->setLanguage('en');
        $invoice = $invoice->toArray();
        $invoice['publicKey'] = config('payop.public_key');
        $invoice['resultUrl'] = ReturnHandleUrls::RESULT_URL;
        $invoice['failPath'] = ReturnHandleUrls::FAIL_URL;
        return $invoice;
    }

    public function checkPaymentStatus($invoiceID)
    {
        $uri = $this->buildUri('/checkout/check-invoice-status/' . $invoiceID);
        try {
            return $this->_request('GET', $uri);
        } catch (Exceptions\ServiceException $e) {
        } catch (GuzzleException $e) {
        }
    }

    /**
     * Get Payment Method From service
     *
     * @param Order $order
     *
     * @return array
     * @throws CreateInvoiceException
     */
    public function createInvoice(Order $order): array
    {
        $invoice = new Invoice();
        $signature = $this->sign($order);
        $invoice = $this->invoiceObjectCreate($invoice, $order, $signature);
        $uri = $this->buildUri('invoices/create');
        $response = $this->_request('POST', $uri, $invoice);
        if ($response->getStatusCode() !== 200 ) {
            throw new CreateInvoiceException();
        }
        return [$invoice, $response->getBody()];
    }

}
