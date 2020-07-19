<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property string private_key
 * @property string public_key
 * @property string public_address
 */
class Wallet extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'private_key', 'public_address'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getPrivateKey(){
        return decrypt($this->private_key);
    }

    public function getPublicAddress(){
        return decrypt($this->public_address);
    }

    public function setPrivateKey($privateKey){
        $this->private_key = encrypt($privateKey);
        return $this->update();
    }

    public function setPublicAddress($publicAddress){
        $this->public_address= encrypt($publicAddress);
        return $this->update();
    }
}
