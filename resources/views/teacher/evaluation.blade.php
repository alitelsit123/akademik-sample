@extends('layout')

@section('body')
  @php
  $school = \App\Models\School::first();
  $mapels = auth()->user()->teaches;
  $myClassIds = auth()->user()->classes()->wherePivotIn('mapel_id', $mapels->pluck('id')->toArray())->pluck('classes.id')->toArray();
  $students = \App\Models\User::whereLevel('student')->whereHas('studentInformation', function($query) use ($myClassIds) {
    $query->whereIn('class_id',$myClassIds);
  })->withCount([
    'studentEvaluationsCurrentSession' => function($query) use ($mapels) {
      $query->whereIn('mapels.id', auth()->user()->classMapels->pluck('id')->toArray());
    }
  ])->having('student_evaluations_current_session_count', '<', auth()->user()->classMapels->groupBy('id')->count())->paginate(10);
  $classes = \App\Models\Classes::get();
  // dd(auth()->user()->classMapels->groupBy('id'));
  // dd(auth()->user()->classMapels()->count());
  @endphp


  @if (session('message'))
  <script>
    Swal.fire(
      'Informasi',
      '{{session('message')}}',
      'success'
    )
  </script>
  @endif

  @if ($errors->any() || session('error'))
    @php
      $errorMsg = '';
      $errorBag = collect($errors->getMessages())->values()->first();
      if ($errorBag) {
        $errorMsg = $errorBag[0];
      } else {
        $errorMsg = session('error');
      }
    @endphp
    <script>
      Swal.fire(
        'Informasi',
        '{{$errorMsg}}',
        'error'
      )
    </script>
  @endif

  <!-- Main content -->
  <div class="container-fluid py-3">
    <div class="mb-3">
        <strong>Silahkan input nilai siswa dibawah ini</strong>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Siswa</th>
          <th scope="col">Kelas</th>
          <th scope="col">Nisn</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $row)
        @php
        $myMapelsOnCurrentClass = auth()->user()->classMapels()->wherePivot('class_id', $row->getInformation('studentInformation', 'class_id'))->get();
        @endphp
        <tr>
          <th scope="row">#</th>
          <td>{{$row->getInformation('personalInformation','name')}}</td>
          <td>{{$row->getInformation('studentInformation','class') ? $row->getInformation('studentInformation','class')->name: ''}}</td>
          <td>{{$row->getInformation('personalInformation','nisn')}}</td>
          <td>
            <button type="button" data-toggle="modal" data-target="#input-evaluation-{{$row->id}}" class="btn btn-primary btn-xs">Input Nilai</button>
            <div class="modal" id="input-evaluation-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Input Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('teacher/evaluation/store')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body row">
                      @foreach ($myMapelsOnCurrentClass as $key => $rowMapel)
                      @php
                      $evaluationValueOnCurrentSeason = $row->studentEvaluationsCurrentSession()->where('mapels.id', $rowMapel->id)->first();
                      @endphp
                      <input type="hidden" name="{{$rowMapel->id}}_semester" value="{{$school->semester}}" />
                      <input type="hidden" name="{{$rowMapel->id}}_school_year" value="{{$school->school_year_from.'/'.$school->school_year_to}}" />
                      <div class="form-group @if($myMapelsOnCurrentClass->count() > 0 && $myMapelsOnCurrentClass->count() % 2 != 0 && $myMapelsOnCurrentClass->count() - 1 == $key) col-12 @else col-6 @endif">
                        <label for="">{{$rowMapel->name}}</label>
                        <div><small>Nilai Angka</small></div>
                        <input type="integer" name="{{$rowMapel->id}}_number" value="{{$evaluationValueOnCurrentSeason ? $evaluationValueOnCurrentSeason->pivot->number:''}}" class="form-control form-control-sm" required />
                        <div><small>Predikat</small></div>
                        <input type="text" name="{{$rowMapel->id}}_predicate" value="{{$evaluationValueOnCurrentSeason ? $evaluationValueOnCurrentSeason->pivot->predicate:''}}" class="form-control form-control-sm" required />
                        <div><small>Deskripsi</small></div>
                        <textarea name="{{$rowMapel->id}}_description" id="" rows="2" class="form-control">{{$evaluationValueOnCurrentSeason ? $evaluationValueOnCurrentSeason->pivot->description:''}}</textarea>
                      </div>
                      @endforeach
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </td>
        </tr>
        @endforeach
        @if ($students->count() == 0)
        <tr>
          <td colspan="5" class="text-center">Tidak ada siswa yang perlu dinilai.</td>
        </tr>
        @endif
      </tbody>
    </table>
    </div>
    {{$students->links()}}
  </div>
@endsection
