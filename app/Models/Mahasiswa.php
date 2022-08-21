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
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('nama_mahasiswa', 'like', '%' . $search . '%')
            ->orWhere('id_mahasiswa', 'like', '%' . $search . '%');

        });
    }

    public function aktivitas()
    {
    	return $this->hasMany(Aktivitas::class);
    }
}
