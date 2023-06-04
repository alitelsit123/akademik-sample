<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Classes;

class ClassController extends Controller
{
    public function index() {
        return view('admin.class');
    }
    public function store() {
        request()->validate([
            'name' => ['required']
        ]);
        Classes::firstOrCreate(['name' => request('name'),'head_class_id' => request('head_class_id')]);
        return back()->with(['message' => 'Berhasil tambah kelas.']);
    }
    public function update() {
        request()->validate([
            'id' => ['required'],
            'name' => ['required']
        ]);
        $class = Classes::findOrFail(request('id'));
        $existingclass = Classes::whereName(request('name'))->first();
        if ($existingclass && $existingclass->id != request('id')) {
            return back()->with(['error' => 'Nama kelas sudah ada']);
        }
        $class->name = request('name');
        $class->head_class_id = request('head_class_id');
        $class->save();
        return back()->with(['message' => 'Berhasil update kelas.']);
    }
    public function destroy($id) {
        $class = Classes::findOrFail($id);
        Classes::whereId($class->id)->delete();
        return back()->with(['message' => 'Berhasil hapus kelas.']);
    }
}
