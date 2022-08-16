<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhppemasukan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    
    public function materials()
    {
        return $this->hasOne(Material::class);
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name_material', 'like', '%' . $search . '%')
            ->orWhere('barcode', 'like', '%' . $search . '%');
        
        });
    }
}

