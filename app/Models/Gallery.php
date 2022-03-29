<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    
    protected $fillable = [
        'facilities_id','menu_packages_id', 'image' ,
    ];

    protected $hidden = [];

    public function facility(){
        return $this->belongsTo(Facility::class, 'facilities_id', 'id' );
    }
    public function menu_package(){
        return $this->belongsTo(MenuPackage::class, 'menu_packages_id', 'id' );
    }
}
