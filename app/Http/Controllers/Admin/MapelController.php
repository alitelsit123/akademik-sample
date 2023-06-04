<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Mapel;
use App\Models\User;

class MapelController extends Controller
{
    public function index() {
        return view('admin.mapel');
    }
    public function store() {
        request()->validate([
            'name' => ['required']
        ]);
        Mapel::firstOrCreate(['name' => request('name')]);
        return back()->with(['message' => 'Berhasil tambah mapel.']);
    }
    public function storeTeacher() {
        request()->validate([
            'id' => ['required'],
            'teacher_id' => ['required']
        ]);
        $teacher = User::findOrFail(request('teacher_id'));
        $mapel = Mapel::findOrFail(request('id'));
        $mapel->teachers()->syncWithoutDetaching($teacher->id);
        return back()->with(['message' => 'Berhasil tambah guru.']);
    }
    public function update() {
        request()->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);
        $mapel = Mapel::findOrFail(request('id'));
        $existingMapel = Mapel::whereName(request('name'))->first();
        if ($existingMapel) {
            return back()->with(['error' => 'Nama mapel sudah ada']);
        }
        $mapel->name = request('name');
        $mapel->save();
        return back()->with(['message' => 'Berhasil update mapel.']);
    }
    public function destroy($id) {
        $mapel = Mapel::findOrFail($id);
        Mapel::whereId($mapel->id)->delete();
        return back()->with(['message' => 'Berhasil hapus mapel.']);
    }
}
