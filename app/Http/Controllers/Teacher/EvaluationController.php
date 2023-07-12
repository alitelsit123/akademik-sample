<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function index() {
        return view('teacher.evaluation');
    }
    public function indexHistory() {
      return view('teacher.evaluation-history');
  }
    public function store() {
        $mapels = auth()->user()->classMapels;
        $user = User::findOrFail(request('id'));
        // $user->studentEvaluations()->sync([]);
        foreach ($mapels as $item) {
          $payload['number'] = request($item->id.'_number');
          $payload['predicate'] = request($item->id.'_predicate');
          $payload['description'] = request($item->id.'_description');
          $payload['semester'] = request($item->id.'_semester');
          $payload['school_year'] = request($item->id.'_school_year');
          $payload['student_id'] = $user->id;
          $payload['mapel_id'] = $item->id;
          $exist = $user->studentEvaluationsCurrentSession()->where('mapels.id', $item->id)->first();
          // if (!$payload['number']) {
          //   dd($payload);
          // }
          if (!$exist) {
              Evaluation::create($payload);
          }
        }
        return back()->with(['message' => 'Berhasil input nilai.']);
    }
}
