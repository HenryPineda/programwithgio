<?php

namespace App\Controllers;
use App\Enums\InvoiceStatus;
use App\View;
use App\Attributes\Get;
use App\Models\Invoice;
use Carbon\Carbon;
use Symfony\Component\Mailer\MailerInterface;

class InvoiceController
{

    #[Get('/invoices')]
    public function index()
    {
//        unset($_SESSION['count']);
//        echo 'Invoices page!';
        var_dump(InvoiceStatus::PAID, gettype(InvoiceStatus::PENDING), is_object(InvoiceStatus::FAILED));
        $invoices = (new Invoice())->query()->where('status', '=', InvoiceStatus::PAID)->get()->toArray();
        var_dump($invoices);
        return View::make('invoices/index', ['invoices' => $invoices]);
    }
    #[Get('/invoices/new')]
    public function create()
    {
        $invoice = new Invoice();
        $invoice->amount = 150;
        $invoice->user_id = 1;
        $invoice->status = InvoiceStatus::PAID;
        $invoice->invoice_number = '54321';
        $invoice->due_date = (new Carbon())->addDay();

        $invoice->save();

        echo $invoice->id .', ' . $invoice->due_date->format('m/d/Y');
    }

//    public function create()
//    {
////        echo '';
//        return View::make('invoices/create');
//    }

    public function store()
    {
        echo $_POST['amount'];
    }

}