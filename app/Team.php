<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'tblcrteam';
    protected $primaryKey = 'eid';

    protected $casts = [
        'eid' => 'string'
    ];

    public $timestamps = false;

    protected $fillable = ['eid','uname','department','designation','address','phone','mobile','email','notes','status','upstatus','dnstatus','usrid','cusrid','bid'];
}
