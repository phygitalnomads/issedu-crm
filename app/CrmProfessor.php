<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrmProfessor extends Model
{
    protected $fillable = [
        'crm_id',
        'name',
        'url',
        'contact_id',
        'status_id',
        'user_id',
        'deleted',
        'business_id',
    ];
}
