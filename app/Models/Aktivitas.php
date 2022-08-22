<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'aktivitass';

    public function mahasiswa()
    {
    	return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function peralatan()
    {
    	return $this->belongsTo(Peralatan::class, 'peralatan_id', 'id');
    }
}
