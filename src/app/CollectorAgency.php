<?php

namespace App;

class CollectorAgency implements DebtCollector
{

    public function collect(float $owedAmount): float
    {
        $guaranteed = 0.5 * $owedAmount;
        return  mt_rand($guaranteed, $owedAmount);

    }

    public function pay(): float
    {
        // TODO: Implement pay() method.
    }
}