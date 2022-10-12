<?php

namespace App\Controllers;

use App\Attributes\Get;
use App\Attributes\Post;
use App\View;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
//use Symfony\Component\Mime\Email;
use App\Models\Email;
use Symfony\Component\Mime\Address;

class UserController
{
    public function __construct(protected MailerInterface $mailer)
    {
    }

    #[Get('/users/create')]
    public function create(): View
    {
        return View::make('users/register');
    }

    #[Post('/users')]
    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $firstName = explode(' ', $name)[0];

        $text = <<<Body
Hello $firstName,

Thanks for signing up!
Body;
        $html = <<<Body
<h1 style="text-align: center; color: gray;">Welcome</h1>
Hello $firstName,
<br></br>
Thank you for signing up!
Body;


//        $dsn = 'smtp://mailhog:1025';
//        $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
//        $email = (new Email())
//            ->from('henry@example.com')
//            ->to($email)
//            ->subject('Welcome!')
//            ->text($text)
//            ->attach('Hello. Welcome', 'welcome.txt')
//            ->html($html);
        (new Email())->queue(
            new Address($email),
            new Address('support@example.com', 'Support'),
            'Welcome',
            $html,
            $text
        );
//        $mailer = new Mailer($transport);

//        $this->mailer->send($email);

    }
}