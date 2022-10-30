<?php

namespace App\Controllers;
use App\Enums\InvoiceStatus;
use App\View;
use App\Attributes\Get;
use App\Models\Invoice;

class InvoiceController
{
    #[Get('/invoices')]
    public function index()
    {
//        unset($_SESSION['count']);
//        echo 'Invoices page!';
        var_dump(InvoiceStatus::PAID, gettype(InvoiceStatus::PENDING), is_object(InvoiceStatus::FAILED));
        $invoices = (new Invoice())->all(InvoiceStatus::PAID);
        var_dump($invoices);
        return View::make('invoices/index', ['invoices' => $invoices]);
    }

    public function create()
    {
//        echo '';
        return View::make('invoices/create');
    }

    public function store()
    {
        echo $_POST['amount'];
    }

}