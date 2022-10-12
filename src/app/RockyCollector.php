<?php

namespace App;

class RockyCollector implements DebtCollector
{

    public function collect(float $owedAmount): float
    {
        return 0.65 * $owedAmount;
    }

    public function pay(): float
    {
        // TODO: Implement pay() method.
    }
}