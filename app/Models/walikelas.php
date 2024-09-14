<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walikelas extends Model
{
    use HasFactory;
    protected $table = 'walikelas';
    protected $guarded =['id'];
}
