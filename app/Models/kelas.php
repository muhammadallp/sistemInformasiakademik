<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class kelas extends Model
{
    use HasFactory, Sluggable;
    
    protected $guarded =['id'];
    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'kelas'
            ]
        ];
    }

    

    public function getRouteKeyName(): string
    {
        return 'slug';
    }


}
