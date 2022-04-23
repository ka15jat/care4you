<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Owner extends Authenticatable
{
    use Notifiable;
    protected $table = 'owners';
    protected $guard = 'Owner';
    protected $guarded = [];
}
