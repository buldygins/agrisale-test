<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'option',
        'unit',
        'recommend_price',
        'product_id',
    ];

    public $timestamps = false;

    public function offers()
    {
        return $this->hasMany(ProductOffer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getData()
    {
        return [
            'product' => $this->product->name,
            'option' => $this->option,
            'unit' => $this->unit,
            'offers' => $this->offers()->count(),
            'avg_price' => $this->processAvgPrice(),
        ];
    }

    public function processAvgPrice()
    {
        $offersPrice = $this->offers()->pluck('price')->toArray();
        if (empty($offersPrice)) {
            return $this->product->recommend_price ?? 0;
        }
        $offersPrice = array_unique($offersPrice);
        sort($offersPrice);
        $medianPosition = intdiv(count($offersPrice), 2);
        return $offersPrice[$medianPosition];
    }
}
