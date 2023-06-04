@extends('layout')

@section('body')
  @php
  $classes = \App\Models\Classes::paginate(10);
  $headClasses = \App\Models\User::whereLevel('head_class')->get();
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

    <div class="mb-4">
      <button type="button" data-toggle="modal" data-target="#create-student" class="btn btn-primary">Tambah Kelas</button>
      <div class="modal" id="create-student" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Kelas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('admin/class/store')}}" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Nama Kelas</label>
                  <input type="text" name="name" class="form-control form-control-sm" required />
                </div>
                <div class="form-group">
                  <label for="">Wali Kelas</label>
                  <select name="head_class_id" id="" class="form-control">
                      <option value=""></option>
                      @foreach ($headClasses as $rowHeadClass)
                      <option value="{{$rowHeadClass->id}}">{{$rowHeadClass->getInformation('personalInformation','name')}}</option>
                      @endforeach
                  </select>
                </div>
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
          <th scope="col">Kelas</th>
          <th scope="col">Wali Kelas</th>
          <th scope="col">Jumlah Siswa</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($classes as $row)
        <tr>
          <th scope="row">#</th>
          <td>{{$row->name}}</td>
          <td>{{$row->headClass ? $row->headClass->getInformation('personalInformation','name'): ''}}</td>
          <td>{{$row->students()->count()}}</td>
          <td>
            <a href="#edit-class-{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-warning">Edit</a>
            <div class="modal" id="edit-class-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/class/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="">Nama Kelas</label>
                        <input type="text" name="name" value="{{$row->name}}" class="form-control form-control-sm" required />
                      </div>
                      <div class="form-group">
                        <label for="">Wali Kelas</label>
                        <select name="head_class_id" id="" class="form-control">
                            <option value=""></option>
                            @foreach ($headClasses as $rowHeadClass)
                            <option value="{{$rowHeadClass->id}}">{{$rowHeadClass->getInformation('personalInformation','name')}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-xs btn-danger btn-delete" data-url="{{url('admin/class/destroy/'.$row->id)}}">Hapus</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    {{$classes->links()}}
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
