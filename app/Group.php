<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'tblcrgroup';
    protected $primaryKey = 'crgid';

    protected $casts = [
        'crgid' => 'string'
    ];

    public $timestamps = false;

    protected $fillable = ['crgid','crgname','description','status','upstatus','dnstatus','usrid','bid'];
}
