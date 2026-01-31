<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SizeMaster extends Model
{
    protected $table = 'size_master';
    
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }
}
