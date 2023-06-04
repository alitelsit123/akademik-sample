@extends('layout')

@section('body')
  @php
  $school = \App\Models\School::first();
  $attributes = [
    ['name', 'Nama Sekolah'],
    ['NSPN', 'NSPN'],
    ['website', 'Website'],
    ['head_officer_name', 'Nama Kepala Sekolah'],
    ['head_officer_nip', 'NIP Kepala Sekolah'],
    ['email', 'Email'],
    ['province', 'Provinsi'],
    ['regency', 'Kabupaten / Kota'],
    ['address', 'Alamat'],
    ['postal_code', 'Kode Pos'],
    ['phone', 'Nomor Telepon'],
    ['fax', 'FAX']
  ];
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
    <form class="row" action="{{url('admin/school/update')}}" method="post">
      <input type="hidden" name="id" value="{{$school->id}}" />
      @foreach ($attributes as $row)
      <div class="form-group col-6">
        <label for="">{{$row[1]}}</label>
        <input type="text" name="{{$row[0]}}" value="{{($school->{$row[0]})}}" class="form-control" id="" aria-describedby="emailHelp" placeholder="{{'-'}}">
      </div>
      @endforeach
      <div class="form-group col-6">
        <label for="">Semester</label>
        <input type="text" name="semester" value="{{$school->semester}}" class="form-control" id="" aria-describedby="emailHelp" placeholder="Masukkan Semester">
      </div>
      <div class="form-group col-6">
        <label for="">Tahun Ajaran</label>
        <div class="d-flex align-items justify-content-center">
          <input type="text" name="school_year_from" value="{{$school->school_year_from}}" class="form-control" id="" aria-describedby="emailHelp" placeholder="Contoh {{\Carbon\Carbon::now()->year}}">
          <strong class="mx-2 mt-1">/</strong>
          <input type="text" name="school_year_to" class="form-control" value="{{$school->school_year_to}}" id="" aria-describedby="emailHelp" placeholder="Contoh {{\Carbon\Carbon::now()->addYears(1)->year}}">
        </div>
      </div>
      <button type="submit" class="btn btn-primary mx-auto">Update</button>
    </form>
  </div>
@endsection
