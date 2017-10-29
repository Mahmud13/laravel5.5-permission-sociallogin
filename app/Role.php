<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as RootRole;

class Role extends RootRole
{
    protected $fillable = ['name', 'guard_name'];
    
}
