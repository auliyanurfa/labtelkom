<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhppengeluaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function materials()
    {
        return $this->hasOne(Material::class);
    }
}
