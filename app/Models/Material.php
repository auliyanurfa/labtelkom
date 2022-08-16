<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name_material', 'like', '%' . $search . '%')
            ->orWhere('barcode', 'like', '%' . $search . '%');
        
        });
        $query->when($filters['unit'] ?? false, function($query, $unit){
            return $query->whereHas('unit', function($query) use ($unit) {
                $query->where('name_unit', $unit);
            });
        
        });
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function BHPbarcode()
    {
        return $this->hasOne(BHPBarcode::class);
    }

}
