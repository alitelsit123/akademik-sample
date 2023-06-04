<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AccountController extends Controller
{
    public function index() {
        return view('admin.account');
    }
    public function store() {
        request()->validate([
            'level' => ['required'],
            'email' => ['required'],
            'password' => ['required'],
        ]);

        $user = User::whereEmail(request('email'))->whereLevel(request('level'))->first();
        if ($user) {
            return back()->with(['error' => 'Akun dengan email '.request('email').' sudah terdaftar.']);
        }
        $user = User::create([
            'email' => request('email'),
            'password' => \Hash::make(request('password')),
            'level' => request('level')
        ]);
        // PERSONAL INFORMATION
        $user->personalInformation()->delete();
        $personalInformation = $user->personalInformation()->create(['name' => request('name')]);
        $attributes = getTableColumn($personalInformation->getTable(),['id','name','user_id','created_at','updated_at']);
        foreach ($attributes as $item) {
            $personalInformation->{$item} = request($item);
        }
        $personalInformation->save();

        // RESIDENCE INFORMATION
        $user->residenceInformation()->delete();
        $residenceInformation = $user->residenceInformation()->create([]);
        $attributes = getTableColumn($residenceInformation->getTable(),['id','user_id','created_at','updated_at']);
        foreach ($attributes as $item) {
            $residenceInformation->{$item} = request('residence_'.$item);
        }
        $residenceInformation->save();


        return back()->with(['message' => 'Berhasil Tambah Akun.']);
    }
    public function update() {
        request()->validate([
            'id' => ['required'],
            'level' => ['required'],
            'email' => ['required']
        ]);

        $user = User::findOrFail(request('id'));
        if (!$user) {
            return back()->with(['error' => 'Akun tidak ada!']);
        }
        $user = User::whereEmail(request('email'))->whereLevel(request('level'))->first();
        if ($user) {
            return back()->with(['error' => 'Akun dengan email '.request('email').' sudah terdaftar.']);
        }
        $user = User::findOrFail(request('id'));
        User::whereId(request('id'))->update([
            'email' => request('email'),
            'level' => request('level')
        ]);
        // PERSONAL INFORMATION
        $user->personalInformation()->delete();
        $personalInformation = $user->personalInformation()->create(['name' => request('name')]);
        $attributes = getTableColumn($personalInformation->getTable(),['id','name','user_id','created_at','updated_at']);
        foreach ($attributes as $item) {
            $personalInformation->{$item} = request($item);
        }
        $personalInformation->save();

        // RESIDENCE INFORMATION
        $user->residenceInformation()->delete();
        $residenceInformation = $user->residenceInformation()->create([]);
        $attributes = getTableColumn($residenceInformation->getTable(),['id','user_id','created_at','updated_at']);
        foreach ($attributes as $item) {
            $residenceInformation->{$item} = request('residence_'.$item);
        }
        $residenceInformation->save();


        return back()->with(['message' => 'Berhasil Update Akun.']);
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
        return back()->with(['message' => 'Berhasil hapus Akun.']);
    }
}
