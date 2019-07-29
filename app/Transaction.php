<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function from(){
        return $this->belongsTo('App\Wallet','from_id');
    }

    public function to(){
        return $this->belongsTo('App\Wallet','to_id');
    }
}
