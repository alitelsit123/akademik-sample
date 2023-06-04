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
        $mapels = Mapel::all();
        $user = User::findOrFail(request('id'));
        foreach ($mapels as $item) {
            $payload['number'] = request($item->id.'_number');
            $payload['predicate'] = request($item->id.'_predicate');
            $payload['description'] = request($item->id.'_description');
            $payload['semester'] = request($item->id.'_semester');
            $payload['school_year'] = request($item->id.'_school_year');
            $exist = $user->studentEvaluationsCurrentSession()->where('mapels.id', $item->id)->first();
            if ($exist) {
                $evaluation = Evaluation::find(request($item->id.'_id'));
                if($evaluation) {
                    $evaluation->update($payload);
                }
            }
        }
        $attitude = $user->attitude;
        if (!$attitude) {
            $user->attitude()->create([
                'spiritual_predicate' => request('spirit_predicate'),
                'spiritual_description' => request('spirit_description'),
                'social_predicate' => request('social_predicate'),
                'social_description' => request('social_description')
            ]);
        } else {
            $user->attitude()->update([
                'spiritual_predicate' => request('spirit_predicate'),
                'spiritual_description' => request('spirit_description'),
                'social_predicate' => request('social_predicate'),
                'social_description' => request('social_description')
            ]);
        }
        $user->extracurriculars()->delete();
        if (request('extra_name1') && request('extra_predicate1')) {
            $user->extracurriculars()->create([
                'name' => request('extra_name1'),
                'predicate' => request('extra_predicate1'),
                'description' => request('extra_description1'),
            ]);
        }
        if (request('extra_name2') && request('extra_predicate2')) {
            $user->extracurriculars()->create([
                'name' => request('extra_name2'),
                'predicate' => request('extra_predicate2'),
                'description' => request('extra_description2'),
            ]);
        }
        $unpresent = $user->unpresent;
        if (!$unpresent) {
            $user->unpresent()->create([
                'sick' => request('sick'),
                'permission' => request('permission'),
                'alpha' => request('alpha'),
            ]);
        } else {
            $user->unpresent()->update([
                'sick' => request('sick'),
                'permission' => request('permission'),
                'alpha' => request('alpha'),
            ]);
        }
        $note = $user->note;
        if (!$note) {
            $user->note()->create([
                'from_head_class' => request('from_head_class'),
                'from_parent' => request('from_parent'),
            ]);
        } else {
            $user->note()->update([
                'from_head_class' => request('from_head_class'),
                'from_parent' => request('from_parent'),
            ]);
        }
        return back()->with(['message' => 'Berhasil update raport.']);
    }
    public function submitRapor($id) {
        $user = User::findOrFail($id);
        if ($user) {
            $info = $user->studentInformation;
            if ($info) {
                $info->rapor_ready = now();
                $info->save();
            }
        }
        return back()->with(['message' => 'Berhasil di submit.']);
    }
}
