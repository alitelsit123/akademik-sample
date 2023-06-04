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
          <td>
            <button type="button" data-toggle="modal" data-target="#update-student-{{$row->id}}" class="btn btn-warning btn-xs">Edit Siswa</button>
            <div class="modal fade" id="update-student-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">UPDATE DATA LEMBAR BUKU INDUK SISWA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/student/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      @include('admin.student-form', ['row' => $row])
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-xs btn-danger btn-delete" data-url="{{url('admin/student/destroy/'.$row->id)}}">Hapus</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    {{$students->links()}}
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-delete').click(function() {
        const url = $(this).data('url')
        Swal.fire({
          title: 'Yakin ingin Hapus',
          text: "",
          type: "warning",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Ya, Hapus',
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
