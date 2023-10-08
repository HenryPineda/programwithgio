<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property string $description
 * @property integer $quantity
 * @property float $unit_price
 * @property BelongsTo $invoice
 */
class InvoiceItem extends Model
{
    CONST UPDATED_AT = null;


    /**
     * @return BelongsTo
     */
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
}