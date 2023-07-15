<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\School;

class SchoolController extends Controller
{
    public function index() {
      return view('admin.school');
    }
    public function update() {
      $school = School::findOrFail(request('id'));
      // dd(request()->all());
      foreach (getTableColumn($school->getTable(), ['id','created_at','updated_at']) as $item) {
          $school->{$item} = request($item);
      }
      $school->save();
      return back()->with(['message' => 'Sekolah diubah.']);
    }
    public function sInduck() {
      return view('admin.s-induck');
    }
}
