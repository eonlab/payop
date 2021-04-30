<?php
namespace Eonlab\Constants;

use Illuminate\Support\Facades\Config;

class PayOp
{
    const PUBLIC_KEY = Config::get('payop.public_key');
    const SECRET_KEY = Config::get('payop.secret_key');
    const SERVICE_TOKEN = Config::get('payop.service_token');
    const PROJECT_ID = Config::get('payop.project_id');


    const EXAMPLE_PAYER_PAN = "5555555555554444";
    const EXAMPLE_PAYER_EXPIRATION_DATE = "12/20";
    const EXAMPLE_PAYER_CVV = "123";
    const EXAMPLE_PAYER_HOLDER_NAME = "HOLDER";
}
