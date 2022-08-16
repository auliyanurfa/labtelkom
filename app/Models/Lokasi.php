<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $table = 'lokasis';

    public function peralatans()
    {
        return $this->hasMany(Peralatan::class);
    }
}