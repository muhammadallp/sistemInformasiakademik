<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pertemuan extends Model
{
    use HasFactory;
    protected $table = 'pertemuan';
    protected $guarded =['id_pertemuan'];
}
