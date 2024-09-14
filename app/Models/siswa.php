<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class siswa extends Model
{
    use HasFactory, Sluggable;
    
    protected $table = 'siswa';

    protected $guarded =['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nohp'
            ]
        ];
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
