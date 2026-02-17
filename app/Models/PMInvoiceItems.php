<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMInvoiceItems extends Model
{
    use HasFactory;

    protected $table = 'pm_invoice_items';
    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_id',
        'item',
        'qty',
        'unit_price',
        'tax_type',
        'tax_rate',
        'sub_total',
    ];
}
