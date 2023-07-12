@extends('layout-report')

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
  ])->having('student_evaluations_current_session_count', '>=', auth()->user()->classMapels->groupBy('id')->count())->paginate(10);
  $classes = \App\Models\Classes::get();
  // dd(auth()->user()->classMapels->groupBy('id'));
  // dd(auth()->user()->classMapels()->count());
  @endphp
  <style>
    * {
      margin:0;
      font-family: Helvetica,'Helvetica Neue';
    }
    .table td,.table th,.table{
      border-collapse: collapse;
    }
    .table td{
      text-align:center;
      padding-top:0.5rem;
      padding-bottom:0.5rem;
      padding-left:0.75rem;
      padding-right:0.75rem;
      border:1px solid rgba(0, 0, 0, 0.311);
    }
    .table-header {
      font-weight:bold;
      font-size:18px;
    }
    .hhe:not(:nth-of-type(1)) {
      page-break-before: always;
      top: 100%;
    }
  </style>
  <div class="container-fluid">

    <div style="padding:3rem;background-color:#ededed; max-width:850px;overflow-x:auto;margin:auto;">
      @foreach ($students as $K => $student)
      <h3 class="hhe" style="text-align:center;margin-bottom:2rem;font-weight:bold;@if($K > 0) margin-top:5rem; @endif">IDENTITAS PESERTA DIDIK</h3>
      <table class="table-borderless" border="0" style="margin-bottom:3rem;width:80%;margin-left:auto;margin-right:auto;">
        @php
        $tableInformation = [
          ['Nama Peserta Didik (Lengkap)', $student->getInformation('personalInformation','name')],
          ['Nomor Induk / NISN', $student->getInformation('personalInformation','nisn')],
          ['Tempat, Tanggal Lahir', $student->getInformation('personalInformation','birth_info')],
          ['Jenis Kelamin', $student->getInformation('personalInformation','gender')],
        ];
        $iInformation = 1;
        @endphp
        @foreach ($tableInformation as $key => $row)
        <tr>
          <td style="width: 50px;">
            @if ($row[1] === false)

            @else
            {{$iInformation++}}
            @endif
          </td>
          <td>{{$row[0]}}</td>
          <td style="width: 50px;">:</td>
          <td>{{$row[1]}}</td>
        </tr>
        @endforeach
      </table>
      <table class="table" style="margin-top:1.25rem;" width="100%">
        <thead>
          <tr>
            <td class="table-header" rowSpan="2">Mata Pelajaran</td>
            <td colspan="3">Pengetahuan & Keterampilan</td>
          </tr>
          <tr>
            <td>Angka</td>
            <td>Predikat</td>
            <td>Deskripsi</td>
          </tr>
          @foreach (\App\Models\Mapel::get() as $row)
          @php
          $currentEvl = $student->studentEvaluationsCurrentSession()->where('mapels.id',$row->id)->first();
          @endphp
          <tr>
            <td>{{$row->name}}</td>
            <td>{{$currentEvl ? $currentEvl->pivot->number:''}}</td>
            <td>{{$currentEvl ? $currentEvl->pivot->predicate:''}}</td>
            <td>{{$currentEvl ? $currentEvl->pivot->description:''}}</td>
          </tr>
          @endforeach
          {{-- <tr>
            <td style="border-right:none;" class="table-header">Absensi</td>
          </tr>
          <tr>
            <td>Sakit</td>
            <td colspan="4"></td>
          </tr>
          <tr>
            <td>Izin</td>
            <td colspan="4"></td>
          </tr>
          <tr>
            <td>Alpha</td>
            <td colspan="4"></td>
          </tr> --}}
        </thead>
      </table>
      @endforeach
    </div>
  </div>
@endsection
