@extends('layout')

@section('body')
  @php
  $students = \App\Models\User::whereLevel('student')->paginate(10);
  $classes = \App\Models\Classes::get();
  $school = \App\Models\School::first();
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

    <div class="mb-4">
      <button type="button" data-toggle="modal" data-target="#create-student" class="btn btn-primary">Tambah Siswa</button>
      <div class="modal fade" id="create-student" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">DATA LEMBAR BUKU INDUK SISWA</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('admin/student/store')}}" method="post">
              <div class="modal-body">
                @include('admin.student-form')
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Siswa</th>
          <th scope="col">Kelas</th>
          <th scope="col">Nisn</th>
          <th scope="col">Jenjang</th>
          <th scope="col">Alamat</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($students as $row)
        <tr>
          <th scope="row">#</th>
          <td>{{$row->getInformation('personalInformation','name')}}</td>
          <td>{{$row->getInformation('studentInformation','class') ? $row->getInformation('studentInformation','class')->name: ''}}</td>
          <td>{{$row->getInformation('personalInformation','nisn')}}</td>
          <td>{{$row->getInformation('personalInformation','level')}}</td>
          <td>{{$row->getInformation('residenceInformation','address')}}</td>
          <td>#</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    {{$students->links()}}
  </div>
@endsection
