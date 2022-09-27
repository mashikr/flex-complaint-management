<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'tblcrregion';
    protected $primaryKey = 'diid';

    protected $casts = [
        'diid' => 'string'
    ];

    public $timestamps = false;

    protected $fillable = ['diid','diname','location','distance','elevation','aboutdestination','country','city','notes','glid','status','upstatus','dnstatus','usrid','bid','acsid'];
}
