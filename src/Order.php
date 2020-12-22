<?php


namespace BNG;

class Order
{
    public string $id;
    public string $amount;
    public string $currency;
    public array $items;
    public string $description;
    public array $payer;

    /**
     * Get ID of Order.
     *
     * @return string
     */
    public function getOrderID(): string
    {
        return $this->id;
    }

    /**
     * Get ID of Order.
     *
     * @param string $id
     *
     * @return Order
     */
    public function setOrderID($id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get amount of Order.
     *
     * @return string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * Get amount of Order.
     *
     * @param string $amount
     *
     * @return Order
     */
    public function setAmount($amount): Order
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Get Currency of Order.
     *
     * @param string $currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set Currency of Order.
     *
     * @param string $currency
     *
     * @return Order
     */
    public function setCurrency($currency): Order
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Set Description of Order.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set Description of Order.
     *
     * @param string $description
     *
     * @return Order
     */
    public function setDescription(string $description): Order
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Set Items of Order.
     *
     * @param array $items
     *
     * @return Order
     */
    public function setItems(array $items): Order
    {
        $this->items[] = $items;
        return $this;
    }

    /**
     * Get Items of Order.
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'          => $this->id,
            'amount'      => $this->amount,
            'status'      => $this->currency,
            'items'       => $this->items,
            'description' => $this->description,
        ];
    }

}