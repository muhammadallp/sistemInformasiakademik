<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $guarded =['id'];

    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => 'jadmapel_id'
    //         ]
    //     ];
    // }
    // public function getRouteKeyName(): string
    // {
    //     return 'slug';
    // }
}
