<?php

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Mapel;
use App\Models\Evaluation;

class EvaluationController extends Controller
{
    public function index() {
        return view('head.evaluation');
    }
    public function update() {
        $school = \App\Models\School::first();
        $mapels = Mapel::all();
        $user = User::findOrFail(request('id'));

        foreach ($mapels as $item) {
            $payload['number'] = request($item->id.'_number');
            $payload['predicate'] = request($item->id.'_predicate');
            $payload['description'] = request($item->id.'_description');
            $payload['semester'] = request($item->id.'_semester');
            $payload['school_year'] = request($item->id.'_school_year');
            $exist = $user->studentEvaluations()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->where('mapels.id', $item->id)->first();
            if ($exist) {
                $evaluation = Evaluation::find(request($item->id.'_id'));
                if($evaluation) {
                    $evaluation->update($payload);
                }
            }
        }
        $attitude = $user->attitude()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first();
        if (!$attitude) {
            $user->attitude()->create([
                'spiritual_predicate' => request('spirit_predicate'),
                'spiritual_description' => request('spirit_description'),
                'social_predicate' => request('social_predicate'),
                'social_description' => request('social_description'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        } else {
            $user->attitude()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->update([
                'spiritual_predicate' => request('spirit_predicate'),
                'spiritual_description' => request('spirit_description'),
                'social_predicate' => request('social_predicate'),
                'social_description' => request('social_description'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        }
        $user->extracurriculars()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->delete();
        // dd(request()->all());
        if (request('extra_name1') && request('extra_predicate1')) {
            $cc = $user->extracurriculars()->create([
                'name' => request('extra_name1'),
                'predicate' => request('extra_predicate1'),
                'description' => request('extra_description1'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
            // dd($cc);
        }
        if (request('extra_name2') && request('extra_predicate2')) {
            $user->extracurriculars()->create([
                'name' => request('extra_name2'),
                'predicate' => request('extra_predicate2'),
                'description' => request('extra_description2'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        }
        $user->performances()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->delete();
        // dd(request()->all());
        if (request('performance_name1') && request('performance_description1')) {
            $cc = $user->performances()->create([
                'name' => request('performance_name1'),
                'description' => request('performance_description1'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
            // dd($cc);
        }
        if (request('performance_name2') && request('performance_description2')) {
            $user->performances()->create([
                'name' => request('performance_name2'),
                'description' => request('performance_description2'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        }
        $unpresent = $user->unpresent()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first();
        if (!$unpresent) {
            $user->unpresent()->create([
                'sick' => request('sick'),
                'permission' => request('permission'),
                'alpha' => request('alpha'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        } else {
            $user->unpresent()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->update([
                'sick' => request('sick'),
                'permission' => request('permission'),
                'alpha' => request('alpha'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        }
        $note = $user->note()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first();
        if (!$note) {
            $user->note()->create([
                'from_head_class' => request('from_head_class'),
                'from_parent' => request('from_parent'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        } else {
            $user->note()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->update([
                'from_head_class' => request('from_head_class'),
                'from_parent' => request('from_parent'),
                'semester' => $school->semester,
                'school_year' => $school->school_year_from.'/'.$school->school_year_to,
            ]);
        }
        return back()->with(['message' => 'Berhasil update raport.']);
    }
    public function submitRapor($id) {
        $school = \App\Models\School::first();
        $user = User::findOrFail($id);
        if ($user) {
            $info = $user->studentInformation;
            if ($info) {
                $info->rapor_ready = now();
                $info->save();
            }
            $user->raportSessions()->firstOrCreate(['semester' => $school->semester, 'school_year' => $school->school_year_from.'/'.$school->school_year_to]);
        }
        return back()->with(['message' => 'Berhasil di submit.']);
    }
}
