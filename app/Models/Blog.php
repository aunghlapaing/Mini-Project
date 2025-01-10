<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = ('blogs');
    protected $fillable= ['name', 'description', 'image', 'owner_own'];
}
