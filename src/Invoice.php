<?php


namespace Eonlab;


class Invoice
{
    public array $order;
    public array $payer;
    public string $paymentMethod;
    public string $language;
    public string $signature;


    /**
     * Set Order for Invoice.
     *
     * @param array $order
     *
     * @return Invoice
     */
    public function setOrder(array $order): Invoice
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Get Order parameters of Invoice in array.
     *
     * @return array
     */
    public function getOrder(): array
    {
        return $this->order;
    }

    /**
     * Set signature form order parameters.
     *
     * @param string $signature
     *
     * @return Invoice
     */
    public function setSignature($signature): Invoice
    {
        $this->signature = $signature;
        return $this;
    }

    /**
     * Get Signature for Invoice.
     *
     * @return Invoice
     */
    public function getSignature(): string
    {
        return $this->signature;
    }

    /**
     * Set Payer .
     *
     * @param array $payer
     *
     * @return Invoice
     */
    public function setPayer($payer): Invoice
    {
        $this->payer = $payer;
        return $this;
    }

    /**
     * Get Payer .
     *
     * @return array
     */
    public function getPayer(): array
    {
        return $this->payer;
    }

    /**
     * Set PaymentMethod for Invoice.
     *
     * @param string $paymentMethod
     *
     * @return Invoice
     */
    public function setPaymentMethod($paymentMethod): Invoice
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Get PaymentMethod for Invoice.
     *
     * @return Invoice
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * Set Language for Invoice.
     *
     * @param string $language
     *
     * @return Invoice
     */
    public function setLanguage($language): Invoice
    {
        $this->language = $language;
        return $this;
    }

    /**
     * Get Language for Invoice.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'order'         => $this->order,
            'signature'     => $this->signature,
            'payer'         => $this->payer,
            'paymentMethod' => $this->paymentMethod,
            'language'      => $this->language,
        ];
    }

}
