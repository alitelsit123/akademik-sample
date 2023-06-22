@extends('layout')

@section('body')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  @php
  $students = \App\Models\User::when(request('q'), function($query) {
    $query->whereHas('personalInformation', function($query) {
      $query->where('name', 'like', '%'.request('q').'%')
      ->orWhere('email', 'like', '%'.request('q').'%');
    });
  })->get();
  $teachers = \App\Models\User::when(request('q'), function($query) {
    $query->whereHas('personalInformation', function($query) {
      $query->where('name', 'like', '%'.request('q').'%')
      ->orWhere('email', 'like', '%'.request('q').'%');
    });
  })->whereLevel('teacher')->get();
  $headClasses = \App\Models\User::when(request('q'), function($query) {
    $query->whereHas('personalInformation', function($query) {
      $query->where('name', 'like', '%'.request('q').'%')
      ->orWhere('email', 'like', '%'.request('q').'%');
    });
  })->whereLevel('head_class')->get();
  @endphp

  <style>
    .form-group {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .form-group label{
      font-weight: normal!important;
    }
    .form-group input{
      width: 50%;
    }
    .form-group select{
      width: 50%;
    }
  </style>

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
    <h5><strong>cari </strong> "{{request('q')}}"</h5>
    <hr />
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">Nama</th>
          <th scope="col">Alamat</th>
          <th>###</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($students as $row)
          @php
          // dd($teacher_ids);
          @endphp
          <tr>
            <td style="width: 20%;">
              {{$row->getInformation('personalInformation','name')}}
              <div>
                <div class="badge badge-info">{{$row->level}}</div>
                <div class="badge badge-info">{{$row->getInformation('studentInformation','class') ? $row->getInformation('studentInformation','class')->name: ''}}</div>
              </div>
            </td>
            <td style="width: 30%;">{{$row->getInformation('residenceInformation','address')}}</td>
            <td>
              @if ($row->level == 'student')
                @php
                $inYear = \Carbon\Carbon::parse(request('start_year') ?? $row->getInformation('educationInformation','transfer_date').'-01-01');
                $evaluationsYears = [];
                $hasRapors = [];
                foreach ([1,2,3] as $_key) {
                  $evaluationsSemesters = \App\Models\RaportSession::where('user_id', $row->id)->where('school_year',$inYear->year.'/'.$inYear->year+1)->get();
                  if ($evaluationsSemesters->count() > 0) {
                    $hasRapors[] = $evaluationsSemesters;
                  }
                  $evaluationsYears[] = $inYear->year;
                  $inYear->addYears(1);
                }
                $totalMapel = \App\Models\Mapel::count();
                @endphp
                @if ($row->getInformation('educationInformation','transfer_date') && sizeof($hasRapors) > 0)
                  <div class="mb-1"><strong>List Rapor</strong></div>
                  <div>
                    @foreach ($evaluationsYears as $rowEvaluation)
                      <div class="btn-block">
                        <small>{{$rowEvaluation}}/{{$rowEvaluation+1}}: </small>
                        @php
                        $evaluationsSemesters = \App\Models\Evaluation::where('student_id', $row->id)->where('school_year',$rowEvaluation.'/'.$rowEvaluation+1)->groupByRaw('semester')->select('semester')->get();
                        @endphp
                        @foreach ($evaluationsSemesters as $rowSemester)
                        <a target="_blank" href="{{url('admin/report/report_preview/'.$row->id.'?year='.$rowEvaluation.'/'.($rowEvaluation+1).'&semester='.$rowSemester->semester)}}" class="btn btn-xs btn-success">Rapor semester {{$rowSemester->semester}}</a>
                        @endforeach
                      </div>
                    @endforeach
                  </div>
                @endif
                @php

                @endphp
                <div class="mb-1 mt-1"><strong>Laporan Proyek</strong></div>
                <div>
                  <a target="_blank" href="{{url('/admin/induck/detail/'.$row->id)}}" class="btn btn-xs btn-success">Lihat Laporan Nilai</a>
                  <a target="_blank" href="{{url('/admin/induck/detail-proyek/'.$row->id)}}" class="btn btn-xs btn-success">Lihat Laporan Proyek</a>
                </div>
              @elseif($row->level == 'teacher')
                @php
                $mapels = $row->teaches;
                $myClasses = $row->classes()->wherePivotIn('mapel_id', $mapels->pluck('id')->toArray())->has('students')->get()->groupBy('name');
                @endphp
                @if ($mapels->count() > 0)
                <div class="mb-1"><strong>List Mapel</strong></div>
                <div>
                  @foreach ($mapels as $rowTeach)
                  <div class="badge badge-primary">{{$rowTeach->name}}</div>
                  @endforeach
                </div>
                @endif
                @if ($myClasses->count() > 0)
                <div class="mb-1 mt-2"><strong>List Mengajar</strong></div>
                <div>
                  @foreach ($myClasses as $rowTeachClass => $v)
                  <div class="badge badge-primary">{{$rowTeachClass}}</div>
                  @endforeach
                </div>
                @endif
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    {{-- <h5 class="mt-3"><strong>List Guru</strong></h5>
    <hr />
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">Nama</th>
          <th scope="col">Alamat</th>
          <th scope="col">Mengajar</th>
          <th>###</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($teachers as $row)
          @php
          // dd($teacher_ids);
          @endphp
          <tr>
            <td>{{$row->getInformation('personalInformation','name')}}</td>
            <td>{{$row->getInformation('residenceInformation','address')}}</td>
            <td>
              @foreach ($row->teaches as $rowTeach)
              <div class="badge badge-info">{{$rowTeach->name}}</div>
              @endforeach
            </td>
            <td style="width:180px;">
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div> --}}

  </div>

  <script>
    $(document).ready(function() {
      $('table').DataTable({
          paging: true,
          pageLength: 5, // Menampilkan 5 baris per halaman
          lengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Semua"]],
          // Atur nilai default paginasi ke 5
          displayStart: 0
      })
    })
  </script>
@endsection
