<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use \App\Models\User;
use \App\Models\PersonalInformation;

class StudentController extends Controller
{
    public function index() {
        return view('admin.student');
    }
    public function store() {
        request()->validate([
            'nisn' => ['required'],
            'class_id' => ['required']
        ]);
        User::whereEmail(request('nisn').'@akademik.sch.id')->delete();
        $existingUser = User::whereEmail(request('nisn').'@akademik.sch.id')->first();
        if (!$existingUser) {
            $user = User::create([
                'email' => request('nisn').'@akademik.sch.id',
                'password' => \Hash::make(uniqid()),
                'level' => 'student'
            ]);

            // PERSONAL INFORMATION
            $user->personalInformation()->delete();
            $personalInformation = $user->personalInformation()->create(['name' => request('name')]);
            $attributes = getTableColumn($personalInformation->getTable(),['id','name','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $personalInformation->{$item} = request($item);
            }
            $personalInformation->save();

            // STUDENT INFORMATION
            $user->studentInformation()->delete();
            $studentInformation = $user->studentInformation()->create([]);
            $attributes = getTableColumn($studentInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $studentInformation->{$item} = request($item);
            }
            $studentInformation->save();

            // EDUCATION INFORMATION
            $user->educationInformation()->delete();
            $educationInformation = $user->educationInformation()->create([]);
            $attributes = getTableColumn($educationInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $educationInformation->{$item} = request('education_'.$item);
            }
            $educationInformation->save();

            // HEALTH INFORMATION
            $user->healthInformation()->delete();
            $healthInformation = $user->healthInformation()->create([]);
            $attributes = getTableColumn($healthInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $healthInformation->{$item} = request($item);
            }
            $healthInformation->save();

            // PARENT INFORMATION
            $user->parentInformation()->delete();
            $parentInformation = $user->parentInformation()->create([]);
            $attributes = getTableColumn($parentInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $parentInformation->{$item} = request($item);
            }
            $parentInformation->save();

            // PASSION INFORMATION
            $user->passionInformation()->delete();
            $passionInformation = $user->passionInformation()->create([]);
            $attributes = getTableColumn($passionInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $passionInformation->{$item} = request($item);
            }
            $passionInformation->save();

            // RESIDENCE INFORMATION
            $user->residenceInformation()->delete();
            $residenceInformation = $user->residenceInformation()->create([]);
            $attributes = getTableColumn($residenceInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $residenceInformation->{$item} = request('residence_'.$item);
            }
            $residenceInformation->save();

            // STUDENT DEVELOPMENT INFORMATION
            $user->studentDevelopmentInformation()->delete();
            $studentDevelopmentInformation = $user->studentDevelopmentInformation()->create([]);
            $attributes = getTableColumn($studentDevelopmentInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $studentDevelopmentInformation->{$item} = request('development_'.$item);
            }
            $studentDevelopmentInformation->save();

            // STUDENT DEVELOPMENT INFORMATION
            $user->studentGuardianInformation()->delete();
            $studentGuardianInformation = $user->studentGuardianInformation()->create([]);
            $attributes = getTableColumn($studentGuardianInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $studentGuardianInformation->{$item} = request('guardian_'.$item);
            }
            $studentGuardianInformation->save();

        } else {

        }

        return back()->with(['message' => 'DATA LEMBAR BUKU INDUK SISWA BERHASIL DITAMBAH']);
    }
    public function update() {
        request()->validate([
            'nisn' => ['required'],
            'id' => ['required'],
            'class_id' => ['required']
        ]);
        $user = User::findOrFail(request('id'));
        if ($user) {
            User::whereId($user->id)->update([
                'email' => request('nisn').'@akademik.sch.id',
                'level' => 'student'
            ]);

            // PERSONAL INFORMATION
            $user->personalInformation()->delete();
            $personalInformation = $user->personalInformation()->create(['name' => request('name')]);
            $attributes = getTableColumn($personalInformation->getTable(),['id','name','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $personalInformation->{$item} = request($item);
            }
            $personalInformation->save();

             // STUDENT INFORMATION
             $user->studentInformation()->delete();
             $studentInformation = $user->studentInformation()->create([]);
             $attributes = getTableColumn($studentInformation->getTable(),['id','user_id','created_at','updated_at']);
             foreach ($attributes as $item) {
                 $studentInformation->{$item} = request($item);
             }
             $studentInformation->save();

            // EDUCATION INFORMATION
            $user->educationInformation()->delete();
            $educationInformation = $user->educationInformation()->create([]);
            $attributes = getTableColumn($educationInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $educationInformation->{$item} = request('education_'.$item);
            }
            $educationInformation->save();

            // HEALTH INFORMATION
            $user->healthInformation()->delete();
            $healthInformation = $user->healthInformation()->create([]);
            $attributes = getTableColumn($healthInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $healthInformation->{$item} = request($item);
            }
            $healthInformation->save();

            // PARENT INFORMATION
            $user->parentInformation()->delete();
            $parentInformation = $user->parentInformation()->create([]);
            $attributes = getTableColumn($parentInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $parentInformation->{$item} = request($item);
            }
            $parentInformation->save();

            // PASSION INFORMATION
            $user->passionInformation()->delete();
            $passionInformation = $user->passionInformation()->create([]);
            $attributes = getTableColumn($passionInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $passionInformation->{$item} = request($item);
            }
            $passionInformation->save();

            // RESIDENCE INFORMATION
            $user->residenceInformation()->delete();
            $residenceInformation = $user->residenceInformation()->create([]);
            $attributes = getTableColumn($residenceInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $residenceInformation->{$item} = request('residence_'.$item);
            }
            $residenceInformation->save();

            // STUDENT DEVELOPMENT INFORMATION
            $user->studentDevelopmentInformation()->delete();
            $studentDevelopmentInformation = $user->studentDevelopmentInformation()->create([]);
            $attributes = getTableColumn($studentDevelopmentInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $studentDevelopmentInformation->{$item} = request('development_'.$item);
            }
            $studentDevelopmentInformation->save();

            // STUDENT GUARDIAN INFORMATION
            $user->studentGuardianInformation()->delete();
            $studentGuardianInformation = $user->studentGuardianInformation()->create([]);
            $attributes = getTableColumn($studentGuardianInformation->getTable(),['id','user_id','created_at','updated_at']);
            foreach ($attributes as $item) {
                $studentGuardianInformation->{$item} = request('guardian_'.$item);
            }
            $studentGuardianInformation->save();

        }

        return back()->with(['message' => 'DATA LEMBAR BUKU INDUK SISWA BERHASIL DI UPDATE']);
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->personalInformation()->delete();
        $user->educationInformation()->delete();
        $user->healthInformation()->delete();
        $user->parentInformation()->delete();
        $user->passionInformation()->delete();
        $user->residenceInformation()->delete();
        $user->studentDevelopmentInformation()->delete();
        $user->studentGuardianInformation()->delete();
        $user->delete();
        return back()->with(['message' => 'DATA LEMBAR BUKU INDUK SISWA BERHASIL DI HAPUS']);
    }
}
