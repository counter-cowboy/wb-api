<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $guarded=false;

    public function Tokentype()
    {
        return $this->belongsTo(Tokentype::class);
    }
}
