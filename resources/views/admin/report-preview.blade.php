@extends('layout-report')

@section('body')
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
  </style>
  <div class="container-fluid">

    <div style="padding:3rem;background-color:#ededed; max-width:850px;overflow-x:auto;margin:auto;">
      <h3 style="text-align:center;margin-bottom:2rem;font-weight:bold;">RAPOR<br /> SEKOLAH MENENGAH PERTAMA <br />(SMP)</h3>
      <table class="table-borderless" border="0" style="margin-bottom:4rem;width:80%;margin-left:auto;margin-right:auto;">
        @php
        $school = \App\Models\School::first();
        $tableInformation = [
          ['Nama Sekolah', $school->name],
          ['NSPN', $school->nspn],
          ['NIS/NSS/NDS', $school->nis],
          ['Alamat Sekolah', $school->address],
          ['Kelurahan / Desa', ''],
          ['Kecamatan', ''],
          ['Kabupaten / Kota', $school->regency],
          ['Provinsi', $school->province],
          ['Website', $school->website],
          ['Email', $school->email],
        ];
        $iInformation = 1;
        @endphp
        @foreach ($tableInformation as $key => $row)
        <tr>
          <td style="width: 50px;">
            {{-- @if ($row[1] === false)

            @else
            {{$iInformation++}}
            @endif --}}
          </td>
          <td>{{$row[0]}}</td>
          <td style="width: 50px;">:</td>
          <td>{{$row[1]}}</td>
        </tr>
        @endforeach
      </table>
      <div style="width:100%;height:800px;"></div>
      <h3 style="text-align:center;margin-bottom:2rem;font-weight:bold;">IDENTITAS PESERTA DIDIK</h3>
      <table class="table-borderless" border="0" style="margin-bottom:30rem;width:80%;margin-left:auto;margin-right:auto;">
        @php
        $tableInformation = [
          ['Nama Peserta Didik (Lengkap)', $student->getInformation('personalInformation','name')],
          ['Nomor Induk / NISN', $student->getInformation('personalInformation','nisn')],
          ['Tempat, Tanggal Lahir', $student->getInformation('personalInformation','birth_info')],
          ['Jenis Kelamin', $student->getInformation('personalInformation','gender')],
          ['Agama', $student->getInformation('personalInformation','religion')],
          ['Anak Ke', $student->getInformation('personalInformation','child_number')],
          ['Alamat', $student->getInformation('residenceInformation','address')],
          ['Nomor Telepon Rumah', $student->getInformation('personalInformation','phone')],
          ['Sekolah Asal', $student->getInformation('educationInformation','school_name')],
          ['Diterima di sekolah ini', false],
          ['Di Kelas', false],
          ['Pada Tanggal', $student->getInformation('educationInformation','transfer_date')],
          ['Nama Orang Tua', false],
          ['Ayah', $student->getInformation('parentInformation','father_name')],
          ['Ibu', $student->getInformation('parentInformation','mother_name')],
          ['Alamat Orang Tua', $student->getInformation('parentInformation','father_address')],
          ['Nomor Telepon Rumah', $student->getInformation('parentInformation','father_phone')],
          ['Pekerjaan Orang Tua', false],
          ['Ayah', $student->getInformation('parentInformation','father_working_at')],
          ['Ibu', $student->getInformation('parentInformation','mother_working_at')],
          ['Nama Wali Siswa', $student->getInformation('studentGuardianInformation','name')],
          ['Alamat Wali Siswa', $student->getInformation('personalInformation','address')],
          ['Pekerjaan Wali Siswa', $student->getInformation('personalInformation','working_at')],
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
      <div style="width:100%;height:200px;"></div>

      <table width="100%">
        {{-- <div style="display:flex; align-items:center;justify-content:space-between;margin-bottom:1.75rem;">
          <h1 style="margin-bottom:1.25rem;">TRANSKRIP NILAI</h1>
          <img src="" alt="" srcset=""
            style="width:80px;height:80px;border-radius:999px;object-fit: cover;" />
        </div> --}}
        <tr>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;">Nama Sekolah </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;">
            {{\App\Models\School::first()->name}}
          </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;text-align:left;">Kelas </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;text-align:right;">
            {{$student->getInformation('studentInformation','class')->name}}
          </td>
        </tr>
        <tr>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;">Alamat </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;">
            {{$student->getInformation('residenceInformation','address')}}
          </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;text-align:left;">Semester </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;text-align:right;">
            {{\App\Models\School::first()->semester}}
          </td>
        </tr>

        <tr>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;">Nama Peserta Didik </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;">
            {{$student->getInformation('personalInformation','name')}}
          </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;text-align:left;">Tahun Ajaran </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;text-align:right;">
            {{\App\Models\School::first()->school_year_from.'/'.\App\Models\School::first()->school_year_to}}
          </td>
        </tr>
        <tr>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;">NISN </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;">
            {{$student->getInformation('personalInformation','nisn')}}
          </td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;"></td>
          <td style="padding-bottom: 0.5rem;padding-right: 0.75rem;font-weight: bold;">
          </td>
        </tr>
      </table>
      <h3 style="margin-top: 2.5rem;text-align:center;font-weight:bold;">PENCAPAIAN PESERTA DIDIK</h3>
      <h5 class="mt-4">A. SIKAP</h5>
      <H6>1. SIKAP SPIRITUAL</H6>
      <table class="table">
        <thead>
          <tr>
            <td style="font-weight: bold;">Predikat</td>
            <td style="font-weight: bold;">Keterangan</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$student->getInformation('attitude','spiritual_predicate')}}</td>
            <td>{{$student->getInformation('attitude','spiritual_description')}}</td>
          </tr>
        </tbody>
      </table>
      <H6>2. SIKAP SOSIAL</H6>
      <table class="table table-stripped">
        <thead>
          <tr>
            <td style="font-weight: bold;">Predikat</td>
            <td style="font-weight: bold;">Keterangan</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$student->getInformation('attitude','social_predicate')}}</td>
            <td>{{$student->getInformation('attitude','social_description')}}</td>
          </tr>
        </tbody>
      </table>

      <h5 class="mt-4">B. PENGETAHUAN DAN KETERAMPILAN</h5>
      <table class="table" style="margin-top:1.25rem" width="100%">
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

      <h5 class="mt-4">C. EXTRAKURIKULER</h5>
      <table class="table table-stripped">
        <thead>
          <tr>
            <td>No.</td>
            <td>Kegiatan</td>
            <td>Predikat</td>
            <td>Keterangan</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($student->extracurriculars as $key => $row)
          <tr>
            <td>{{$key+1}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->predicate}}</td>
            <td>{{$row->description}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <h5 class="mt-4">D. KETIDAKHADIRAN</h5>
      <table class="table table-stripped">
        <tbody>
          <tr>
            <td>Sakit </td>
            <td>{{$student->unpresent ? $student->unpresent->sick:''}}</td>
          </tr>
          <tr>
            <td>Izin</td>
            <td>{{$student->unpresent ? $student->unpresent->permission:''}}</td>
          </tr>
          <tr>
            <td>Alpha</td>
            <td>{{$student->unpresent ? $student->unpresent->alpha:''}}</td>
          </tr>
        </tbody>
      </table>

      <h5 class="mt-4">E. CATATAN WALI KELAS</h5>
      <textarea name="" id="" rows="3" class="form-control" readonly>{{$student->getInformation('note', 'from_head_class')}}</textarea>

      <h5 class="mt-4">F. TANGGAPAN ORANGTUA MURID</h5>
      <textarea name="" id="" rows="3" class="form-control" readonly>{{$student->getInformation('note', 'from_parent')}}</textarea>
    </div>
  </div class="container-fluid">
@endsection
