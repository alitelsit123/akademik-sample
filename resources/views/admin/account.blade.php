@extends('layout')

@section('body')
  @php
  $accounts = \App\Models\User::where('level', '<>','student')->paginate(10);
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
      <button type="button" data-toggle="modal" data-target="#create-student" class="btn btn-primary">Tambah Akun</button>
      <div class="modal" id="create-student" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Akun</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{url('admin/account/store')}}" method="post">
              <div class="modal-body">
                <div class="mt-3"><h4>Informasi Akun</h4></div>
                <div class="form-group">
                  <label for="">Type</label>
                  <select name="level" id="" class="form-control" required>
                    <option value="">-- Pilih Level --</option>
                    <option value="admin">Admin</option>
                    <option value="head_class">Wali Kelas</option>
                    <option value="teacher">Guru Kelas</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="email" class="form-control form-control-sm" required />
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="text" name="password" class="form-control form-control-sm" required />
                </div>

                <div class="mt-3"><h4>Informasi Pribadi</h4></div>
                <div class="form-group">
                  <label for="">Nama Lengkap</label>
                  <input type="text" name="name" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Nomor HP</label>
                  <input type="text" name="residence_phone" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <input type="text" name="gender" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Tempat & Tanggal Lahir</label>
                  <input type="text" name="birth_info" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Agama</label>
                  <input type="text" name="religion" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Kewarganegaraan</label>
                  <input type="text" name="citizen" class="form-control form-control-sm" />
                </div>
                <div class="form-group">
                  <label for="">Alamat Rumah</label>
                  <input type="text" name="residence_address" class="form-control form-control-sm" />
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
          <th scope="col">Nama Akun</th>
          <th scope="col">Email</th>
          <th scope="col">Jenis Akun</th>
          <th scope="col">Alamat</th>
          <th>###</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($accounts as $key=>$row)
        <tr>
          <th scope="row">{{$key+ $accounts->firstItem()}}</th>
          <td>{{$row->getInformation('personalInformation','name')}}</td>
          <td>{{$row->email}}</td>
          <td>
            {{str_replace('head_class', 'wali kelas', str_replace('teacher', 'guru', $row->level))}}
          </td>
          <td>{{$row->getInformation('residenceInformation','address')}}</td>
          <td>
            <a href="#edit-account-{{$row->id}}" data-toggle="modal" class="btn btn-xs btn-warning">Edit</a>
            <div class="modal" id="edit-account-{{$row->id}}" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form action="{{url('admin/account/update')}}" method="post">
                    <input type="hidden" name="id" value="{{$row->id}}" />
                    <div class="modal-body">
                      <div class="mt-3"><h4>Informasi Akun</h4></div>
                      <div class="form-group">
                        <label for="">Type</label>
                        <select name="level" id="" class="form-control" required>
                          <option value="">-- Pilih Level --</option>
                          <option value="admin" @if($row->level == 'admin') selected @endif>Admin</option>
                          <option value="head_class" @if($row->level == 'head_class') selected @endif>Wali Kelas</option>
                          <option value="teacher" @if($row->level == 'teacher') selected @endif>Guru Kelas</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" value="{{$row->email}}" class="form-control form-control-sm" required />
                      </div>

                      <div class="mt-3"><h4>Informasi Pribadi</h4></div>
                      <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="name" value="{{$row->getInformation('personalInformation', 'name')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Nomor HP</label>
                        <input type="text" name="residence_phone" value="{{$row->getInformation('residenceInformation', 'phone')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <input type="text" name="gender" value="{{$row->getInformation('personalInformation', 'gender')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Tempat & Tanggal Lahir</label>
                        <input type="text" name="birth_info" value="{{$row->getInformation('personalInformation', 'birth_info')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Agama</label>
                        <input type="text" name="religion" value="{{$row->getInformation('personalInformation', 'religion')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Kewarganegaraan</label>
                        <input type="text" name="citizen" value="{{$row->getInformation('personalInformation', 'citizen')}}" class="form-control form-control-sm" />
                      </div>
                      <div class="form-group">
                        <label for="">Alamat Rumah</label>
                        <input type="text" name="residence_address" value="{{$row->getInformation('residenceInformation', 'address')}}" class="form-control form-control-sm" />
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @if ($row->level != 'admin')
            <a href="#" class="btn btn-xs btn-danger btn-delete" data-url="{{url('admin/account/destroy/'.$row->id)}}">Hapus</a>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
    {{$accounts->links()}}
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
