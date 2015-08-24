<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $casts = ['done' => 'boolean'];
    protected $fillable = ['text', 'done'];
}
