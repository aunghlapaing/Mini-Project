<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = ('Blogs');
    protected $fillabe= ['name', 'title', 'image', 'owner_own'];
}
