<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class raport extends Model
{
    use HasFactory;
    protected $table ='nilai_raport';
    protected $guarded = ['id'];
}
