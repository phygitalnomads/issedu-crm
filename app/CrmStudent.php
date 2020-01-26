<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmStudent extends Model
{
    protected $fillable = [
        'crm_id',
        'email',
        'name',
        'url',
        'contact_id',
        'status_id',
        'user_id',
        'deleted',
        'business_id',
    ];
}
