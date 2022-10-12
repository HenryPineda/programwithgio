<?php

namespace App\Controllers;
use App\Models\Ticket;
use App\Attributes\Route;

class GeneratorExampleController
{
    public function __construct(protected Ticket $ticket)
    {

    }

    #[Route('/examples/generator')]
    public function index()
    {
//        $numbers = $this->lazyRange(1, 30);

//        echo $numbers->current();
//
//        $numbers->next();
//
//        echo $numbers->current();
//
//        $numbers->next();
//
//        echo $numbers->getReturn();
//        foreach ($numbers as $key => $number){
//
//            echo $key. ":". $number. "<br />";
//        }
        foreach ($this->ticket->all() as $ticket){
            echo $ticket['id']. " : ". substr($ticket['content'], 0, 15);
        }
    }

    private function lazyRange(int $start, int $end): \Generator
    {
        echo "Hello";
        for ($i = $start; $i <=$end; $i++){
            yield $i * 5 => $i;
        }
//        yield $start;
//
//        echo "World";
//
//        yield $end;
//
//        return "!";
    }
}