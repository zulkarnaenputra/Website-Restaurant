<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class MenuPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'price', 'nasi','sayur','ikan', 'lauk',
        'pelengkap', 'gorengan', 'sambal', 'desert', 'minum'
    ]; 

    protected $hidden =[

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'menu_packages_id', 'id');
    }
}
