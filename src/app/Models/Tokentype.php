<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tokentype extends Model
{
    public function Apiservices()
    {
        return $this->hasOne(Apiservice::class);
    }
}
