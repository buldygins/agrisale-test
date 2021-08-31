<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    protected $fillable = [];

    public $timestamps = false;

    public function offers()
    {
        return $this->hasMany(ProductOffer::class);
    }
}
