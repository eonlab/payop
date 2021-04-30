<?php
namespace Eonlab\Constants;

class PayOp
{
    const PUBLIC_KEY = config('payop.public_key');
    const SECRET_KEY = config('payop.secret_key');
    const SERVICE_TOKEN = config('payop.service_token');
    const PROJECT_ID = config('payop.project_id');


    const EXAMPLE_PAYER_PAN = "5555555555554444";
    const EXAMPLE_PAYER_EXPIRATION_DATE = "12/20";
    const EXAMPLE_PAYER_CVV = "123";
    const EXAMPLE_PAYER_HOLDER_NAME = "HOLDER";
}
