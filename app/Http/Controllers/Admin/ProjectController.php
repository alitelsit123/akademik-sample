<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Project;

class ProjectController extends Controller
{
  public function index() {
    return view('admin.project');
  }
  public function store() {
      request()->validate([
          'name' => ['required']
      ]);
      Project::firstOrCreate(['name' => request('name')]);
      return back()->with(['message' => 'Berhasil tambah project.']);
  }
  public function update() {
      request()->validate([
          'id' => ['required'],
          'name' => ['required']
      ]);
      $project = Project::findOrFail(request('id'));
      $existingProject = Project::whereName(request('name'))->where('id', '<>', request('id'))->first();
      if ($existingProject) {
          return back()->with(['error' => 'Nama project sudah ada']);
      }
      $project->name = request('name');
      $project->save();
      return back()->with(['message' => 'Berhasil update project.']);
  }
  public function destroy($id) {
      $project = Project::findOrFail($id);
      Project::whereId($project->id)->delete();
      return back()->with(['message' => 'Berhasil hapus project.']);
  }
}
