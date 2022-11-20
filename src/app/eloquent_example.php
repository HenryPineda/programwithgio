<?php

use App\Models\Invoice;
use App\Models\User;
use App\Enums\InvoiceStatus;
use App\Models\InvoiceItem;
use Carbon\Carbon;
use Illuminate\Database\Capsule\Manager as Capsule;


require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__.'/../eloquent.php';

$invoices = Capsule::table('invoices')->where('status', '=', InvoiceStatus::PAID)->get();
echo "List of invoices from Capsule". PHP_EOL;
var_dump($invoices);
//
//Capsule::connection()->transaction(function (){
//
//    $user = new User();
//    $user->full_name = 'Henry Pineda';
//    $user->email = 'pinedahenryandres@gmail.com';
//    $user->save();
//
//    $invoice = new Invoice();
//
//    $invoice->amount = 25;
//    $invoice->user()->associate($user);
////$invoice->user_id = 1;
//    $invoice->status = InvoiceStatus::PAID;
//    $invoice->due_date = (new Carbon())->addDays(10);
//    $invoice->invoice_number = '123456';
//    $invoice->save();
//
//    $items = [
//        ['Item 1', 1, 15],
//        ['Item 2', 2, 7.5],
//        ['Item 3', 4, 3.75]
//    ];
//
//    foreach($items as [$description, $quantity, $unitPrice ])
//    {
//        $item = new InvoiceItem();
//        $item->invoice()->associate($invoice);
//        $item->description = $description;
//        $item->quantity = $quantity;
//        $item->unit_price = $unitPrice;
//
//        $item->save();
//
//    }
//
//});
$invoiceId = 3;
echo Invoice::query()->where('id', '=', $invoiceId)->update([
    'status' => InvoiceStatus::PENDING
]);

Invoice::query()->where('status', InvoiceStatus::PAID)->get()->each(function (Invoice $invoice){
//    var_dump($invoice->created_at);
//    echo $invoice->status->toString(). PHP_EOL;
//    exit;
    echo $invoice->id . ', '. $invoice->amount .', ' . $invoice->status->toString() . ', '. $invoice->created_at->format('m/d/y'). PHP_EOL;
    $item = $invoice->items()->first();

    $item->description = 'Foo Bar';
    $item->save();

    var_dump($item);
});


