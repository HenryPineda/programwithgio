<?php

namespace App\Controllers;
use App\Attributes\Route;
use App\Models\SignUp;
use App\Services\InvoiceServices;
use App\View;
use App\Models\User;
use App\Models\Invoice;
use App\App;
use App\Models\TransactionFiles;
use App\Attributes\Post;

class HomeController
{
    #[Post('/')]
    public string $x;

    public function __construct(protected InvoiceServices $invoiceServices )
    {

    }

    #[Route('/')]
    public function index(): View
    {

        //return (new View('index'))->render();
        //phpinfo();
        $this->invoiceServices->process([], 2500);
        echo "<pre >";
            print_r($_ENV['DB_HOST']);
        echo "</pre >";
        $users = (new User())->all();
        $invoice = new Invoice();

        $files = TransactionFiles::getCSVTransactionFiles();
        var_dump($files);
        $transactions = [];

        foreach($files as $file)
        {
            $transactions = array_merge($transactions, TransactionFiles::getTransactions($file, 'parseTransaction'));
        }
        var_dump('INVOICE',$invoice->find(18));
        return View::make('index', ['invoice' => $invoice->find(18), 'users' => $users, 'transactions' => $transactions] );


//        setcookie('userName', 'Henry', time()+10);
//        $_SESSION['count'] = ($_SESSION['count'] ?? 0) +1;
//
//        echo "<pre>";
//        var_dump($_REQUEST);
//        echo "</pre>";
//
//        echo "<pre>";
//            var_dump($_GET);
//        echo "</pre>";
//
//        echo "<pre>";
//            var_dump($_POST);
//        echo "</pre>";

//        echo 'Home';
//        echo '';

    }

    #[Post('/', 'post')]
    public function store()
    {

    }

    public function signUp()
    {
        $db = App::db();
        $email = "liseth@doe.com";
        $full_name = "Liseth Rodriguez";
        $is_active = 1;
        $createdAt = date('Y-m-d H:i:s', strtotime('7/11/2022 5:00PM'));
        $amount = 25;

        $user = new User();
        $invoice = new Invoice();

        $invoiceId = (new SignUp($user, $invoice))->register(['email'=> $email, 'full_name' => $full_name, 'is_active'=> $is_active, 'created_at' => $createdAt], ['amount'=> $amount]);
        $users= $db->table('users')->get();
        $specificUser= $db->table('users')->where('id', 50)->get();
        echo "<pre >";
        print_r($users);
        echo "<pre />";

        echo "<pre >";
        print_r($specificUser);
        echo "<pre />";

    }

    public function download()
    {
        header('Content-type: application/pdf');
        header('Content-disposition: attachment; filename="myfile.pdf"');
        readfile(STORAGE_PATH.'/'. 'Factura REMOTE TO PAY- May 2022 Henry Andres Pineda Torrez.xlsx - Simple Invoice.pdf');
        exit;
    }

    public function upload()
    {
//        echo "<pre>";
//            var_dump($_FILES);
//        echo "</pre>";

        $filePath = STORAGE_PATH . '/'. $_FILES['transactions']['name'];
        move_uploaded_file($_FILES['transactions']['tmp_name'], $filePath);
        //var_dump(pathinfo($filePath));
        header('Location: /');
    }
}