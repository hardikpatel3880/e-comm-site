<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    protected $table = 'product_size';

    protected $fillable = [
        'product_id',
        'size_master_id'
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function size()
    {
        return $this->belongsTo(SizeMaster::class, 'size_master_id');
    }
}
