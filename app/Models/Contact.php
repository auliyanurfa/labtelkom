<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = ['id'];
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'address', 'mobile'];
}
