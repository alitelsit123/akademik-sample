@extends('layout')

@section('body')
  @php
  $mapels = auth()->user()->teaches;
  $classes = \App\Models\Classes::where('head_class_id',auth()->user()->id)->get();
  $school = \App\Models\School::first();
  $students = \App\Models\User::whereLevel('student')->paginate(10);
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
    {{-- <div class="mb-3">
        <div class="alert alert-info">
            <strong>Informasi</strong>
            <ul>
                <li>Hijau: sudah bisa dicetak</li>
                <li>kuning: belum di validasi wali kelas</li>
                <li>Merah: belum di input</li>
            </ul>
        </div>
    </div> --}}
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
        @foreach ($students as $key=>$row)
        <tr class="">
          <th scope="row">{{$key+ $students->firstItem()}}</th>
          <td>{{$row->getInformation('personalInformation','name')}}</td>
          <td>{{$row->getInformation('studentInformation','class') ? $row->getInformation('studentInformation','class')->name: ''}}</td>
          <td>{{$school->school_year_from.'/'.$school->school_year_to}}</td>
          <td>{{$school->semester}}</td>
          <td style="width:180px;">
            <a href="{{url('/admin/induck/detail/'.$row->id)}}" class="btn btn-xs btn-success btn-block">Lihat Laporan Nilai</a>
            <a href="{{url('/admin/induck/detail-proyek/'.$row->id)}}" class="btn btn-xs btn-success btn-block">Lihat Laporan Proyek</a>
          </td>
        </tr>
        @endforeach
        @if ($students->count() == 0)
        <tr>
          <td colspan="5" class="text-center">Tidak ada data.</td>
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
