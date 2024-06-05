<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apiservice extends Model
{
    protected $guarded=false;

    public function Tokentypes()
    {
        return $this->hasOne(Tokentype::class);
    }
}
