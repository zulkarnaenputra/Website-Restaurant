<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facility extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'location','about','available_for',
        'cappacity','price'
    ]; 

    protected $hidden =[

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'facilities_id', 'id');
    }
    
}
