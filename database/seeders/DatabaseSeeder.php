<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->createUserAdmin();
  }
  public function createUserAdmin() {
    // \App\Models\User::whereEmail('admin@gmail.com')->delete();
    // \App\Models\User::create([
    //   'email' => 'admin@gmail.com',
    //   'password' => \Hash::make('12345678'),
    //   'level' => 'admin'
    // ])->personalInformation()->create([
    //     'name' => 'admin'
    // ]);
    \App\Models\School::firstOrCreate(['name' => 'SMK Dummy 1']);
  }
}
