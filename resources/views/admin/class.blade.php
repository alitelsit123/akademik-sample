@extends('layout')

@section('body')
  @php
  $classes = \App\Models\Classes::paginate(10);
  $headClasses = \App\Models\User::whereLevel('head_class')->get();
  $mapels = \App\Models\Mapel::all();
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
                  <select name="head_class_id" id="" class="form-control" style="width:50%;">
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
          <th scope="col">Guru Kelas</th>
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
          <td>
            <button type="button" data-toggle="modal" data-target="#list-teacher-{{$row->id}}" class="btn btn-xs btn-info">List Guru</button>
            <div class="modal" id="list-teacher-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">List Guru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/class/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      @foreach ($mapels as $rowMapel)
                      @php
                      $mapelTeachers = $rowMapel->teachers;
                      $getCurrentTeacher = $row->teachers()->wherePivot('mapel_id', $rowMapel->id)->first();
                      @endphp
                      <div class="form-group">
                        <label for="">{{$rowMapel->name}}</label>
                        <div style="width:200px;flex-shrink:0;position:relative;">
                          <select name="head_class_id" id="" class="form-control mapel-class" data-class-id="{{$row->id}}" data-mapel-id="{{$rowMapel->id}}">
                            <option value=""></option>
                            @foreach ($mapelTeachers as $teacher)
                            <option value="{{$teacher->id}}" @if($getCurrentTeacher && $getCurrentTeacher->id == $teacher->id) selected @endif>{{$teacher->getInformation('personalInformation','name')}}</option>
                            @endforeach
                          </select>
                          <small class="alert-{{$row->id}}-{{$rowMapel->id}}" style="position: absolute;top: 100%;"></small>
                        </div>
                      </div>
                      @endforeach

                    </div>
                  </form>
                </div>
              </div>
            </div>
          </td>
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
                        <select name="head_class_id" id="" class="form-control" style="width:50%;">
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

      var alertTimeout = null
      $('.mapel-class').change(function() {
        if (alertTimeout !== null) {
          clearTimeout(alertTimeout)
          alertTimeout = null
        }
        const classId = $(this).data('class-id')
        const mapelId = $(this).data('mapel-id')
        const teacherId = $(this).val()
        const alert = $(`.alert-${classId}-${mapelId}`)
        alert.text('').css('color','initial')
        if ($(this).val()) {
          alert.text('Sedang menyimpan ...')
          $.post('{{url('admin/class/store_teacher')}}', {classId,mapelId,teacherId}, function(data) {
            alert.text('Tersimpan ...').css('color','green')
            alertTimeout = setTimeout(() => {
              alert.text('').css('color','initial')
            }, 5000);
          }).fail(() => {
            alert.text('Gagal menyimpan ...').css('color','red')
            alertTimeout = setTimeout(() => {
              alert.text('').css('color','initial')
            }, 5000);
          })
        }
      })
    })
  </script>
@endsection
