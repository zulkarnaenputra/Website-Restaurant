<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{ 
    

    protected $fillable = [
        'id', 'facilities_id', 'users_id', 'person', 
        'transaction_total', 'transaction_status'
    ];

    protected $hidden = [];

    public function details(){
        return $this->hasMany(TransactionDetail::class, 'transactions_id', 'id');
    }

    public function facility(){
        return $this->belongsTo( Facility::class, 'facilities_id', 'id' );
    }

    public function user(){
        return $this->belongsTo(user::class, 'users_id', 'id');
    }
    
}
