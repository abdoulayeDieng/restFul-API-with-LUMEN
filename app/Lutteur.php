<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lutteur extends Model
{
/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pseudo', 'poids',
    ];

    
}
