<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PMInvoices extends Model
{
    use HasFactory;

    protected $table = 'pm_invoices';
    protected $primaryKey = 'id';
    protected $fillable = [
        'invoice_number',
        'project',
        'inovoice_date',
        'due_date',
        'invoice_sub_total',
        'discount_type',
        'discount',
        'discount_amount',
        'grand_total',
        'invoice_note',
        'status',
    ];
}
