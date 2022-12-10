<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','value','campaign_id','product_id'
    ];

    public function campaign()
    {
        return $this->hasOne(Campaign::class,'id','campaign_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }
}
