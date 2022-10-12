<?php

namespace App;

interface DebtCollector extends Payable
{

    public function collect(float $owedAmount):float;

}