<?php

namespace Tests\Unit\Services;

use App\Services\PaymentGatewayService;
use App\Services\SalesTaxService;
use PHPUnit\Framework\TestCase;
use App\Services\InvoiceServices;
use App\Services\EmailService;

class InvoiceServiceTest extends TestCase
{
    /** @test */
    public function it_process_the_invoice_correctly(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);
        //Given invoice instance
        $paymentGatewayServiceMock->method('charge')->willReturn(true);
        $invoiceService = new InvoiceServices($salesTaxServiceMock, $paymentGatewayServiceMock, $emailServiceMock);

        //Given the process is called
        $customer = ['name'=>'Henry'];
        $amount = 25;
        $result = $invoiceService->process($customer, $amount);
        // Assert the invoices was processed successfully
        $this->assertTrue($result);
    }

    /** @test */
    public function it_sends_receipt_email_when_the_invoice_is_processed(): void
    {
        $salesTaxServiceMock = $this->createMock(SalesTaxService::class);
        $paymentGatewayServiceMock = $this->createMock(PaymentGatewayService::class);
        $emailServiceMock = $this->createMock(EmailService::class);
        //Given invoice instance
        $paymentGatewayServiceMock->method('charge')->willReturn(true);
        $emailServiceMock
            ->expects($this->once())
            ->method('send')->with(['name' =>'Henry'], 'receipt');
        $invoiceService = new InvoiceServices($salesTaxServiceMock, $paymentGatewayServiceMock, $emailServiceMock);

        //Given the process is called
        $customer = ['name'=>'Henry'];
        $amount = 25;
        $result = $invoiceService->process($customer, $amount);
        // Assert the invoices was processed successfully
        $this->assertTrue($result);
    }
}