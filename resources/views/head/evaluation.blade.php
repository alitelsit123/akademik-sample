@extends('layout')

@section('body')
  @php
  $mapels = auth()->user()->teaches;
  $classes = \App\Models\Classes::where('head_class_id',auth()->user()->id)->get();
  $school = \App\Models\School::first();
  $students = \App\Models\User::whereLevel('student')->whereHas('studentInformation', function($query) use ($classes) {
    $query->whereIn('class_id', $classes->pluck('id'));
  })->paginate(10);
  $historyEvaluationHistory = \App\Models\Evaluation::select('school_year','semester','student_id')->groupByRaw('school_year,semester,student_id')->paginate(10);
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
        <strong>Silahkan review nilai siswa dibawah ini.</strong>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Siswa</th>
          <th scope="col">Kelas</th>
          <th scope="col">Semester</th>
          <th scope="col">Tahun Ajaran</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $row)
        @php
        $key = 0;
        $totalMapel = \App\Models\Mapel::count();
        $evaluationCompleted = ($row->studentEvaluationsCurrentSession()->count() >= $totalMapel);
        $evaluationSubmitted = ($row->raportSessions()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first() ? true: false);
        @endphp
        <tr class="@if(!$evaluationCompleted) table-danger @elseif($evaluationSubmitted) table-success @else @endif">
          <th scope="row">#</th>
          <td>{{$row->getInformation('personalInformation','name')}}</td>
          <td>{{$row->getInformation('studentInformation','class') ? $row->getInformation('studentInformation','class')->name: ''}}</td>
          <td>{{$school->school_year_from.'/'.$school->school_year_to}}</td>
          <td>{{$school->semester}}</td>
          <td>
            @if ($evaluationCompleted && $evaluationSubmitted == null)
            <button type="button" class="btn btn-success btn-xs btn-submit" data-id="{{$row->id}}" data-url="{{url('/head/evaluation/submit_rapor/'.$row->id)}}">Submit Raport</button>
            <button type="button" data-toggle="modal" data-target="#input-evaluation-{{$row->id}}" class="btn btn-primary btn-xs">Review Raport</button>
            <div class="modal" id="input-evaluation-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Input Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('head/evaluation/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body row">
                      <div class="col-12"><h5>A. SIKAP</h5></div>
                      @php
                      $currentAttitude = $row->attitude()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first();
                      @endphp
                      <div class="form-group col-6">
                        <label for="">Sikap Spiritual</label>
                        <div><small>Predikat</small></div>
                        <input type="text" name="spirit_predicate" value="{{$currentAttitude->spiritual_predicate ?? ''}}" class="form-control form-control-sm" required />
                        <div><small>Deskripsi</small></div>
                        <textarea name="spirit_description" id="" rows="2" class="form-control">{{$currentAttitude->spiritual_description ?? ''}}</textarea>
                      </div>
                      <div class="form-group col-6">
                        <label for="">Sikap Sosial</label>
                        <div><small>Predikat</small></div>
                        <input type="text" name="social_predicate" value="{{$currentAttitude->social_predicate ?? ''}}" class="form-control form-control-sm" required />
                        <div><small>Deskripsi</small></div>
                        <textarea name="social_description" id="" rows="2" class="form-control">{{$currentAttitude->social_predicate ?? ''}}</textarea>
                      </div>

                      @php
                      $currentEvaluationsStudent = $row->studentEvaluationsCurrentSession()->get();
                    //   dd($currentEvaluationsStudent);
                    //   dd($currentEvaluationsStudent->pluck('name')->toArray(),[$currentEvaluationsStudent->pluck('pivot.semester')->toArray(),$currentEvaluationsStudent->pluck('pivot.school_year')->toArray()]);
                      @endphp
                      <div class="col-12"><h5>B. PENGETAHUAN DAN KETERAMPILAN</h5></div>
                      @foreach ($currentEvaluationsStudent as $rowMapel)
                      <input type="hidden" name="{{$rowMapel->id}}_id" value="{{$rowMapel->id}}" />
                      <input type="hidden" name="{{$rowMapel->id}}_semester" value="{{$school->semester}}" />
                      <input type="hidden" name="{{$rowMapel->id}}_school_year" value="{{$school->school_year_from.'/'.$school->school_year_to}}" />
                      <div class="form-group @if($currentEvaluationsStudent->count() > 0 && $currentEvaluationsStudent->count() % 2 != 0 && $currentEvaluationsStudent->count() - 1 == $key) col-12 @else col-6 @endif">
                        <label for="">{{$rowMapel->name}}</label>
                        <div><small>{{$row->getInformation('personalInformation','name')}} {{$rowMapel->pivot->school_year}}</small></div>
                        <div><small>Nilai Angka</small></div>
                        <input type="integer" name="{{$rowMapel->id}}_number" value="{{$rowMapel->pivot->number}}" class="form-control-sm form-control-plaintext" required />
                        <div><small>Predikat</small></div>
                        <input type="text" name="{{$rowMapel->id}}_predicate" value="{{$rowMapel->pivot->predicate}}" class="form-control-plaintext form-control-sm" required />
                        <div><small>Deskripsi</small></div>
                        <textarea name="{{$rowMapel->id}}_description" id="" value="{{$rowMapel->pivot->description}}" rows="2" class="form-control-plaintext"></textarea>
                      </div>
                      @php
                        $key++;
                      @endphp
                      @endforeach

                      <div class="col-12"><h5>C. EXTRAKULIKURER</h5></div>
                      @php
                      $extracurriculars = $row->extracurriculars()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->get()->all();
                      // dd($extracurriculars);
                      @endphp
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Nama Kegiatan</th>
                            <th>Predikat</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ([0,1] as $k => $v)
                          <tr>
                            <td><input type="text" name="extra_name{{$k+1}}" value="{{isset($extracurriculars[$k]) ? $extracurriculars[$k]->name: ''}}" class="form-control form-control-sm" /></td>
                            <td><input type="text" name="extra_predicate{{$k+1}}" value="{{isset($extracurriculars[$k]) ? $extracurriculars[$k]->predicate: ''}}" class="form-control form-control-sm" /></td>
                            <td><textarea name="extra_description{{$k+1}}" id="" rows="2" class="form-control">{{isset($extracurriculars[$k]) ? $extracurriculars[$k]->description: ''}}</textarea></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                      <div class="col-12"><h5>D. PRESTASI</h5></div>
                      @php
                      $performances = $row->performances()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->get()->all();
                      @endphp
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Jenis Prestasi</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ([0,1] as $kk => $rowPerformance)
                          <tr>
                            <td><input type="text" name="performance_name{{$kk+1}}" value="{{$performances[$kk]->name ?? ''}}" class="form-control form-control-sm" /></td>
                            <td><textarea name="performance_description{{$kk+1}}" id="" rows="2" class="form-control">{{$performances[$kk]->description ?? ''}}</textarea></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                      <div class="col-12"><h5>E. KETIDAKHADIRAN</h5></div>
                      <div class="form-group col-6">
                        <div><small>Sakit</small></div>
                        <input type="text" name="sick" value="0" class="form-control form-control-sm" />
                        <div><small>Izin</small></div>
                        <input type="text" name="permission" value="0" class="form-control form-control-sm" />
                        <div><small>Alpha</small></div>
                        <input type="text" name="alpha" value="0" class="form-control form-control-sm" />
                      </div>

                      <div class="col-12"><h5>E. CATATAN WALI KELAS</h5></div>
                      @php
                      $note = $row->note()->whereSemester($school->semester)->whereSchool_year($school->school_year_from.'/'.$school->school_year_to)->first();
                      @endphp
                      <div class="form-group col-12">
                        <textarea name="from_head_class" id="" rows="2" class="form-control">{{$note->from_head_class ?? ''}}</textarea>
                      </div>

                      <div class="col-12"><h5>F. TANGGAPAN WALI MURID</h5></div>
                      <div class="form-group col-12">
                        <textarea name="from_parent" id="" rows="2" class="form-control">{{$note->from_parent ?? ''}}</textarea>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @elseif ($evaluationSubmitted)
            <small>Sudah di submit</small>
            @else
            <small>Belum input</small>
            @endif
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

    {{-- <div class="my-3">
        <strong>History Evaluasi.</strong>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Siswa</th>
          <th scope="col">Kelas</th>
          <th scope="col">Semester</th>
          <th scope="col">Tahun Ajaran</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($historyEvaluationHistory as $row)
        @php
        $user = \App\Models\User::find($row->student_id);
        @endphp
        <tr>
          <th scope="row">#</th>
          <td>{{$user->getInformation('personalInformation','name')}}</td>
          <td>{{$user->getInformation('studentInformation','class') ? $user->getInformation('studentInformation','class')->name: ''}}</td>
          <td>{{$row->semester}}</td>
          <td>{{$row->school_year}}</td>
          <td><button class="btn btn-default btn-xs disabled" disabled>Lihat Nilai</button></td>
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
    {{$students->links()}} --}}
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-submit').click(function() {
        const url = $(this).data('url')
        Swal.fire({
          title: 'Setelah submit raport akan di kirim ke admin',
          text: "",
          type: "success",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Ya, Submit',
          denyButtonText: `Tidak`,
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = url;
          }
        })
      })
    })
  </script>
@endsection
