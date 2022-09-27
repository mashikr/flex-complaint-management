<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{
    protected $table = 'tblcregroup';
    protected $primaryKey = 'creid';

    protected $casts = [
        'creid' => 'string'
    ];

    public $timestamps = false;

    protected $fillable = ['creid','crename','description','status','upstatus','dnstatus','usrid','bid'];
}
