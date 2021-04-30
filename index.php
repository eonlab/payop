<?php

use Eonlab\Constants\PayOp;
use Eonlab\Exceptions\CardTokenizationException;
use Eonlab\Order;
use Eonlab\Payer;
use Eonlab\PaymentService;

include 'vendor/autoload.php';

$order = new Order();
$order->setOrderID(1);
$order->setAmount(3);
$order->setCurrency('EUR');
$order->setDescription('denem');
$order->setItems(
    [
        'id'    => '1',
        'name'  => 'deneme Ürün',
        'price' => '2',
    ],
);
$order->setItems(
    [
        'id'    => '2',
        'name'  => 'deneme Ürün2',
        'price' => '1',
    ],
);

$payer = new Payer();
$payer->setHolderName(PayOp::EXAMPLE_PAYER_HOLDER_NAME);
$payer->setExpirationDate(PayOp::EXAMPLE_PAYER_EXPIRATION_DATE);
$payer->setPan(PayOp::EXAMPLE_PAYER_PAN);
$payer->setCvv(PayOp::EXAMPLE_PAYER_CVV);

$paymentService = new PaymentService();
$paymentService->setConfig(PayOp::SERVICE_TOKEN, PayOp::PROJECT_ID);
try {
    $response = $paymentService->checkout($order, $payer);
} catch (CardTokenizationException $e) {
}
var_dump($response);

?>
