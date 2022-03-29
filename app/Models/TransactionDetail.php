<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{


    protected $fillable = [
        'id', 'transactions_id', 'username', 'tanggal', 'jam', 'the_person', 'massage','no_handphone'
    ];

    protected $hidden = [];

    public function transactions(){
        return $this->belongsTo(Transaction::class, 'transactions_id', 'id' );
    }
    
}
