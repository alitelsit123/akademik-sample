@extends('layout')

@section('body')
  @php
  $mapels = \App\Models\Mapel::paginate(10);
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
      <button type="button" data-toggle="modal" data-target="#create-student" class="btn btn-primary">Tambah Mapel</button>
      <div class="modal" id="create-student" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Mapel</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('admin/mapel/store')}}" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Nama Mapel</label>
                  <input type="text" name="name" class="form-control form-control-sm" required />
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
          <th scope="col">Nama Mapel</th>
          <th scope="col">Pengajar</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($mapels as $row)
        @php
        $teachers = \App\Models\User::whereLevel('teacher')->whereDoesntHave('teaches', function($query) use ($row) {
            $query->whereIn('mapels.id', [$row->id]);
        })->get();
        // dd($teacher_ids);
        @endphp
        <tr>
          <th scope="row">#</th>
          <td>{{$row->name}}</td>
          <td>
            @foreach ($row->teachers as $key => $rowTeacher)
            <div class="badge badge-secondary btn-block">{{$rowTeacher->getInformation('personalInformation', 'name')}}</div>
            @endforeach
          </td>
          <td>
            <a href="#add-teacher-{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-info">Tambah Guru</a>
            <div class="modal fade" id="add-teacher-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Tambah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/mapel/store_teacher')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      @if($teachers->count() == 0)
                      <div class="alert alert-warning">
                        Tidak ada guru yang bisa ditambahkan
                      </div>
                      @else
                      <div class="form-group">
                        <label for="">Nama Guru</label>
                        <select name="teacher_id" id="" class="form-control">
                            <option value="">-- Pilih Guru --</option>
                            @foreach ($teachers as $rowTeacher)
                            <option value="{{$rowTeacher->id}}">{{$rowTeacher->getInformation('personalInformation', 'name')}} - {{$rowTeacher->email}}</option>
                            @endforeach
                        </select>
                      </div>
                      @endif
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary @if($teachers->count() == 0) disabled @endif" @if($teachers->count() == 0) disabled @endif>Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="#edit-mapel-{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-warning">Edit</a>
            <div class="modal" id="edit-mapel-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/mapel/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="">Mapel</label>
                        <input type="text" name="name" value="{{$row->name}}" class="form-control form-control-sm" required />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="#" class="btn btn-xs btn-danger btn-delete" data-url="{{url('admin/mapel/destroy/'.$row->id)}}">Hapus</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$mapels->links()}}
    </div>
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
