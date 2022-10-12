<?php

namespace App;

class DebtCollectService
{
    public function CollectDebt(DebtCollector $collector):string
    {
        $owedAmount = mt_rand(500, 800);
        $amountCollected = $collector->collect($owedAmount);
        return "Collected $".$amountCollected."out of $".$owedAmount.PHP_EOL;
    }

}