<?php


namespace Eonlab;


class Payer
{
    public $pan;
    public $expirationDate;
    public $cvv;
    public $holderName;
    public $invoiceIdentifier;

    public function setPan($pan)
    {
        $this->pan = $pan;
        return $this;
    }

    public function getPan()
    {
        return $this->pan;
    }

    public function getExpirationDate($expirationDate)
    {
        return $this->expirationDate;
    }

    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;
        return $this;
    }

    public function getCvv()
    {
        return $this->cvv;
    }

    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
        return $this;
    }

    public function getHolderName()
    {
        return $this->holderName;
    }

    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
        return $this;
    }

    public function getInvoiceIdentifier()
    {
        return $this->invoiceIdentifier;
    }

    public function setInvoiceIdentifier($invoiceIdentifier)
    {
        $this->invoiceIdentifier = $invoiceIdentifier;
        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id'             => $this->invoiceIdentifier,
            'pan'            => $this->pan,
            'expirationDate' => $this->expirationDate,
            'cvv'            => $this->cvv,
            'holderName'     => $this->holderName,
        ];
    }


}
