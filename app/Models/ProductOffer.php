<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variation_id',
        'dealer_id',
        'price'
    ];

    public $timestamps = false;

    public function product_variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class);
    }

    public function prepareData()
    {
        return [
            'id' => $this->id,
            'name' => $this->dealer->name,
            'option' => $this->product_variation->option ?? '',
            'unit' => $this->product_variation->unit ?? '',
            'price' => $this->price ?? '',
        ];
    }
}
