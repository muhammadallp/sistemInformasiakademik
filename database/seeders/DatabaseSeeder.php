<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'nik'=>'18101152610510',
            'nama'=>'admin',
            'password'=>bcrypt('123456'),
            'level' =>'admin',
            'photo' =>'default.jpg'

        ]);
        User::create([
            'nik'=>'18101152610511',
            'nama'=>'guru',
            'password'=>bcrypt('123456'),
            'level' =>'guru',
            'photo' =>'default.jpg'
        ]);
        User::create([
            'nik'=>'18101152610512',
            'nama'=>'wina',
            'password'=>bcrypt('123456'),
            'level' =>'guru',
            'photo' =>'default.jpg'
        ]);
        User::create([
            'nik'=>'18101152610513',
            'nama'=>'siswa',
            'password'=>bcrypt('123456'),
            'level' =>'siswa',
            'photo' =>'default.jpg'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
