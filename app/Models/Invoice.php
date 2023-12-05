<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'number',
        'due_date',
    ];


    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function total()
    {
        return $this->items->sum('quantity') * $this->items->sum('price');
    }
}
