<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'tblcrclient';
    protected $primaryKey = 'crcid';

    protected $casts = [
        'crcid' => 'string'
    ];

    public $timestamps = false;

    protected $fillable = ['crcid','crcname','designation','street','city','country','mobile','email','notes','cdate','udate','status','upstatus','dnstatus','usrid','bid'];
}
