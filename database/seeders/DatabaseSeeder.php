<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */

  public function run(): void
  {
    \App\Models\School::query()->delete();
    \App\Models\School::firstOrCreate([
      'name' => 'SMP 3 Maospati',
      'nspn' => '20509351',
      'website' => 'www.smp3maospati.sch.id',
      'head_office_nip' => '9823940',
      'province' => 'Jawa Timur',
      'regency' => 'Maospati',
      'district' => 'Maospati',
      'village' => 'MAOSPATI',
      'address' => 'Jl. Raya I/17 Maospati, MAOSPATI, Kec. Maospati, Kab. Magetan Prov. Jawa Timur',
      'semester' => 'Ganjil',
      'school_year_from' => '2023',
      'school_year_to' => '2024',
    ]);

    \App\Models\User::whereEmail('admin@gmail.com')->delete();
    \App\Models\User::create([
      'email' => 'admin@gmail.com',
      'password' => \Hash::make('12345678'),
      'level' => 'admin'
    ])->personalInformation()->create([
        'name' => 'admin'
    ]);
    foreach ([1,2,3,4,5] as $item) {
      \App\Models\User::whereEmail('guru'.$item.'@gmail.com')->whereLevel('teacher')->delete();
      $user = \App\Models\User::create([
        'email' => 'guru'.$item.'@gmail.com',
        'password' => \Hash::make('12345678'),
        'level' => 'teacher'
      ]);
      $user->personalInformation()->create([
          'name' => Str::random(10),
          'gender' => 'l',
          'birth_info' => 'Magetan '.\Carbon\Carbon::now()->format('d, F Y'),
          'religion' => 'Atheis',
      ]);
      $user->residenceInformation()->create([
        'address' => 'Jl. Raya I/17 Maospati, MAOSPATI, Kec. Maospati, Kab. Magetan Prov. Jawa Timur',
      ]);

      \App\Models\User::whereEmail('wali'.$item.'@gmail.com')->whereLevel('head_class')->delete();
      $user = \App\Models\User::create([
        'email' => 'wali'.$item.'@gmail.com',
        'password' => \Hash::make('12345678'),
        'level' => 'head_class'
      ]);
      $user->personalInformation()->create([
        'name' => Str::random(10),
        'gender' => 'l',
        'birth_info' => 'Magetan '.\Carbon\Carbon::now()->format('d, F Y'),
        'religion' => 'Atheis',
      ]);
      $user->residenceInformation()->create([
        'address' => 'Jl. Raya I/17 Maospati, MAOSPATI, Kec. Maospati, Kab. Magetan Prov. Jawa Timur',
      ]);

      \App\Models\User::whereEmail('siswa'.$item.'@gmail.com')->delete();
      $user = \App\Models\User::create([
        'email' => 'siswa'.$item.'@gmail.com',
        'password' => \Hash::make('12345678'),
        'level' => 'student'
      ]);
      $user->personalInformation()->create([
        'name' => Str::random(10),
        'gender' => 'l',
        'birth_info' => 'Magetan '.\Carbon\Carbon::now()->format('d, F Y'),
        'religion' => 'Atheis',
      ]);
      $user->residenceInformation()->create([
        'address' => 'Jl. Raya I/17 Maospati, MAOSPATI, Kec. Maospati, Kab. Magetan Prov. Jawa Timur',
      ]);
    }

    \App\Models\Mapel::query()->delete();
    foreach ([
      'Pendidikan Agama dan Budi Pekerti',
      'Pendidikan Pancasila dan Kewarganegaraan',
      'Bahasa Indonesia',
      'Bahasa Inggris',
      'Matematika (Umum)',
      'Ilmu Pengetahuan Alam (IPA)',
      'Ilmu Pengetahuan Sosial (IPS)',
      'Seni dan Budaya',
      'Pendidikan Jasmani, Olahraga dan Kesehatan',
      'Muatan Lokal Bahasa Daerah',
      'Prakarya',
    ] as $item) {
      $users = \App\Models\User::whereLevel('teacher')->get();
      $mapel = \App\Models\Mapel::firstOrCreate([
        'name' => $item
      ]);
      $mapel->teachers()->syncWithoutDetaching($users->shuffle()->first()->id);
    }

    \App\Models\Project::query()->delete();
    foreach ([
      'Beriman bertaqwa kepada tuhan YME',
      'Berkebinekaan Global',
      'Gotong Royong',
      'Mandiri',
      'Bernalar Kritis',
      'Kreatif',
    ] as $item) {
      \App\Models\Project::create([
        'name' => $item
      ]);
    }

    foreach (['7A','7B','7C','7D','7E','7F','8A','8B','8C','8D','8E','8F','9A','9B','9C','9D','9E','9F'] as $item) {
      $class = \App\Models\Classes::firstOrCreate([
        'name' => $item
      ]);
      $users = \App\Models\User::whereLevel('head_class')->get();
      $class->update([
        'head_class_id' => $users->shuffle()->first()->id
      ]);
      $mapels = \App\Models\Mapel::all();
      foreach ($mapels as $mapel) {
        $classTeacher = $class->teachers()->wherePivot('mapel_id', $mapel->id)->first();
        if ($classTeacher) {
          $class->teachers()->wherePivot('mapel_id', $mapel->id)->detach($classTeacher->id);
        }
        $user = \App\Models\User::whereLevel('teacher')->get()->shuffle()->first();
        $payload[$user->id] = ['mapel_id' => $mapel->id];
        $class->teachers()->attach($payload);
      }
    }
  }
}
