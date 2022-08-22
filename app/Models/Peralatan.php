<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peralatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'peralatans';

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class, 'peralatan_id', 'id');
    }

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function lokasi()
    {
    	return $this->belongsTo(Lokasi::class);
    }

}
