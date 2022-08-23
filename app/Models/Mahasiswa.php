<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'mahasiswas';
    protected $primaryKey = 'id_mahasiswa';

    public function aktivitas()
    {
    	return $this->hasMany(Aktivitas::class, 'mahasiswa_id', 'id');
    }

}
