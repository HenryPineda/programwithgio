<?php

namespace App\Services;

class InvoiceServices
{
    public function __construct(
        protected SalesTaxService $salesTaxService,
        protected PaymentGatewayInterface $gatewayService,
        protected EmailService $emailService
    )
    {

    }


    public function process(array $customer, float $amount):bool
    {


        $tax = $this->salesTaxService->calculate($amount, $customer);

        if(! $this->gatewayService->charge($customer, $amount, $tax)){
            return false;
        }

        $this->emailService->send($customer, 'receipt');
        echo "Invoice processed!";
        return true;

    }

}