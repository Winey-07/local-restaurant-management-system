<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'Category';
    protected $fillable = ['Cambodia_Food','Rice','Noodle','Drink', 'Dessert'];
}
