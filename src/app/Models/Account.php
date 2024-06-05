<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'accounts';
    protected $guarded=false;

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
