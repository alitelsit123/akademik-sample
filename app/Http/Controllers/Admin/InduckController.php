<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Project;
use App\Models\EvaluationProject;

class InduckController extends Controller
{
  public function index() {
    return view('admin.induck');
  }
  public function detail($id) {
    return view('admin.induck-detail', compact('id'));
  }
  public function detailProyek($id) {
    return view('admin.induck-detail-proyek', compact('id'));
  }
  public function storeProject() {
    $user = User::find(request('userId'));
    $exist = $user->studentEvaluationProjects()->whereSemester(request('semester'))
    ->whereSchool_year(request('schoolYear').'/'.request('schoolYear')+1)
    ->where('projects.id', request('projectId'))->first();
    $projectEvaluation = null;
    if ($exist) {
      $payload[request('name')] = request('value');
      $projectEvaluation = EvaluationProject::whereUser_id(request('userId'))->whereSemester(request('semester'))
      ->whereSchool_year(request('schoolYear').'/'.request('schoolYear')+1)
      ->where('project_id', request('projectId'))->first();
      $projectEvaluation->update($payload);
    } else {
      $projectEvaluation = EvaluationProject::create([
        'user_id' => $user->id,
        'project_id' => request('projectId'),
        'school_year' => request('schoolYear').'/'.request('schoolYear')+1,
        'semester' => request('semester'),
      ]);
      $payload[request('name')] = request('value');
      $projectEvaluation->update($payload);
    }
    return response()->json(['existing_payload' => request()->all(), 'object' => EvaluationProject::all()]);
  }
}
