<div class="form-group">
  <label for="">Nomor Induk Siswa (NISN)</label>
  <input name="nisn" type="text" value="{{isset($row) ? $row->getInformation('personalInformation','nisn'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Nama / Jenis Sekolah</label>
  <input type="text" name="school_name" value="{{$school->name}}" class="form-control form-control-sm" readonly />
</div>
<div class="form-group">
  <label for="">Program Study / Jenjang</label>
  <input type="text" name="level" value="{{isset($row) ? $row->getInformation('personalInformation','level'):'SMP'}}" class="form-control form-control-sm" />
</div>
@php
$selectedClass = null;
if (isset($row)) {
  $selectedClass = ($row->getInformation('studentInformation', 'class') ? $row->getInformation('studentInformation', 'class')->id:null);
}
@endphp
<div class="form-group">
  <label for="">Kelas</label>
  <select name="class_id" id="" class="form-control" style="width: 50%;">
    <option value=""></option>
    @foreach ($classes as $rowClass)
    <option value="{{$rowClass->id}}" @if($selectedClass == $rowClass->id) selected @endif>{{$rowClass->name}}</option>
    @endforeach
  </select>
</div>

<div class="mt-3"><h4>A. Keterangan Pribadi</h4></div>
<div class="form-group">
  <label for="">Nama Lengkap</label>
  <input type="text" name="name" value="{{isset($row) ? $row->getInformation('personalInformation','name'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Nama Panggilan</label>
  <input type="text" name="nickname" value="{{isset($row) ? $row->getInformation('personalInformation','nickname'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Jenis Kelamin</label>
  <input type="text" name="gender" value="{{isset($row) ? $row->getInformation('personalInformation','gender'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tempat & Tanggal Lahir</label>
  <input type="text" name="birth_info" value="{{isset($row) ? $row->getInformation('personalInformation','birth_info'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Agama</label>
  <input type="text" name="religion" value="{{isset($row) ? $row->getInformation('personalInformation','religion'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Kewarganegaraan</label>
  <input type="text" name="citizen" value="{{isset($row) ? $row->getInformation('personalInformation','citizen'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Anak Keberapa</label>
  <input type="number" name="child_number" value="{{isset($row) ? $row->getInformation('personalInformation','child_number'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Jumlah Saudara Kandung</label>
  <input type="number" name="total_siblings" value="{{isset($row) ? $row->getInformation('personalInformation','total_siblings'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Jumlah Saudara Tiri</label>
  <input type="number" name="total_half_siblings" value="{{isset($row) ? $row->getInformation('personalInformation','total_half_siblings'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Jumlah Saudara Angkat</label>
  <input type="number" name="total_a_siblings" value="{{isset($row) ? $row->getInformation('personalInformation','total_a_siblings'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Anak (yatim/piatu/yatim piatu)</label>
  <input type="text" name="child_type" value="{{isset($row) ? $row->getInformation('personalInformation','child_type'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Bahasa sehari hari dirumah</label>
  <input type="text" name="language" value="{{isset($row) ? $row->getInformation('personalInformation','language'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>B. Keterangan Tempat Tinggal</h4></div>
<div class="form-group">
  <label for="">Alamat</label>
  <input type="text" name="residence_address" value="{{isset($row) ? $row->getInformation('residenceInformation','address'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Nomor Telepon</label>
  <input type="text" name="residence_phone" value="{{isset($row) ? $row->getInformation('residenceInformation','phone'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Jarak dari tempat tinggal</label>
  <input type="text" name="residence_home_distance" value="{{isset($row) ? $row->getInformation('residenceInformation','home_distance'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ke sekolah dengan</label>
  <input type="text" name="residence_transportation" value="{{isset($row) ? $row->getInformation('residenceInformation','transportation'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>C. Keterangan Kesehatan</h4></div>
<div class="form-group">
  <label for="">Golongan Darah</label>
  <input type="text" name="blood_group" value="{{isset($row) ? $row->getInformation('healthInformation','blood_group'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Penyakit yang pernah diderita</label>
  <input type="text" name="disease_history" value="{{isset($row) ? $row->getInformation('healthInformation','disease_history'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Kelainan Jasmani</label>
  <input type="text" name="physical_abnormalities" value="{{isset($row) ? $row->getInformation('healthInformation','physical_abnormalities'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tinggi</label>
  <input type="number" name="height" value="{{isset($row) ? $row->getInformation('healthInformation','height'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Berat Badan</label>
  <input type="number" name="weight" value="{{isset($row) ? $row->getInformation('healthInformation','weight'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>D. Keterangan Pendidikan Sebelumnya</h4></div>
<div class="mb-2"><strong>Asal Sekolah</strong></div>
<div class="form-group">
  <label for="">Nama Sekolah</label>
  <input type="text" name="education_school_name" value="{{isset($row) ? $row->getInformation('educationInformation','school_name'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">SD/SMP/SMA/K atau yang sederajat</label>
  <input type="text" name="education_level" value="{{isset($row) ? $row->getInformation('educationInformation','level'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tanggal dan Nomor STTB</label>
  <input type="text" name="education_sttb_date_number" value="{{isset($row) ? $row->getInformation('educationInformation','sttb_date_number'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Lama Belajar</label>
  <input type="text" name="education_study_duration" value="{{isset($row) ? $row->getInformation('educationInformation','study_duration'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Pindah dari sekolah ini</strong></div>
<div class="form-group">
  <label for="">Nama Sekolah</label>
  <input type="text" name="education_move_school" value="{{isset($row) ? $row->getInformation('educationInformation','education_move_school'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Diterima di sekolah ini tanggal</label>
  <input type="text" name="education_transfer_date" value="{{isset($row) ? $row->getInformation('educationInformation','transfer_date'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Alasan Pindah</label>
  <input type="text" name="education_reason" value="{{isset($row) ? $row->getInformation('educationInformation','reason'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>D. Keterangan Tentang Orang Tua Kandung</h4></div>
<div class="mb-2"><strong>Nama</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_name" value="{{isset($row) ? $row->getInformation('parentInformation','father_name'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_name" value="{{isset($row) ? $row->getInformation('parentInformation','mother_name'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Tempat dan Tanggal Lahir</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_birth_information" value="{{isset($row) ? $row->getInformation('parentInformation','father_birth_information'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_birth_information" value="{{isset($row) ? $row->getInformation('parentInformation','mother_birth_information'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Agama</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_religion" value="{{isset($row) ? $row->getInformation('parentInformation','father_religion'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_religion" value="{{isset($row) ? $row->getInformation('parentInformation','mother_religion'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Kewarganegaraan</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_citizen" value="{{isset($row) ? $row->getInformation('parentInformation','father_citizen'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_citizen" value="{{isset($row) ? $row->getInformation('parentInformation','mother_citizen'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Ijazah Tertinggi</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_highest_certificate" value="{{isset($row) ? $row->getInformation('parentInformation','father_highest_certificate'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_highest_certificate" value="{{isset($row) ? $row->getInformation('parentInformation','mother_highest_certificate'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Pekerjaan</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_working_at" value="{{isset($row) ? $row->getInformation('parentInformation','father_working_at'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_working_at" value="{{isset($row) ? $row->getInformation('parentInformation','mother_working_at'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Penghasilan</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_income" value="{{isset($row) ? $row->getInformation('parentInformation','father_income'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_income" value="{{isset($row) ? $row->getInformation('parentInformation','mother_income'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Alamat Tempat Tinggal</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_address" value="{{isset($row) ? $row->getInformation('parentInformation','father_address'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_address" value="{{isset($row) ? $row->getInformation('parentInformation','mother_address'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Nomor Telepon</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_phone" value="{{isset($row) ? $row->getInformation('parentInformation','father_phone'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_phone" value="{{isset($row) ? $row->getInformation('parentInformation','mother_phone'):''}}" class="form-control form-control-sm" />
</div>
<div class="mb-2"><strong>Masih Hidup / Meninggal Dunia</strong></div>
<div class="form-group">
  <label for="">Ayah</label>
  <input type="text" name="father_alive" value="{{isset($row) ? $row->getInformation('parentInformation','father_alive'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ibu</label>
  <input type="text" name="mother_alive" value="{{isset($row) ? $row->getInformation('parentInformation','mother_alive'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>F. Keterangan Tentang Wali</h4></div>
<div class="form-group">
  <label for="">Nama</label>
  <input type="text" name="guardian_name" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','name'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tempat dan Tanggal Lahir</label>
  <input type="text" name="guardian_birth_information" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','birth_information'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Agama</label>
  <input type="text" name="guardian_religion" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','religion'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Kewarganegaraan</label>
  <input type="text" name="guardian_citizen" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','citizen'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Hubungan Keluarga</label>
  <input type="text" name="guardian_relation" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','relation'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Ijazah Tertinggi</label>
  <input type="text" name="guardian_highest_certificate" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','highest_certificate'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Pekerjaan</label>
  <input type="text" name="guardian_working_at" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','working_at'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Penghasilan / bulan</label>
  <input type="text" name="guardian_income" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','income'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Alamat</label>
  <input type="text" name="guardian_address" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','address'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Nomor Telepon</label>
  <input type="text" name="guardian_phone" value="{{isset($row) ? $row->getInformation('studentGuardianInformation','phone'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>G. Kegemaran</h4></div>
<div class="mb-2"><strong>Bakat khusus dan prestasi yang menonjol dalam</strong></div>
<div class="form-group">
  <label for="">Kesenian</label>
  <input type="text" name="art" value="{{isset($row) ? $row->getInformation('passionInformation','art'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Pendidikan Jasmani</label>
  <input type="text" name="pysics" value="{{isset($row) ? $row->getInformation('passionInformation','pysics'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Kemasyarakatan / Organisasi</label>
  <input type="text" name="organization" value="{{isset($row) ? $row->getInformation('passionInformation','organization'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Dan lain lain</label>
  <input type="text" name="etc" value="{{isset($row) ? $row->getInformation('passionInformation','etc'):''}}" class="form-control form-control-sm" />
</div>

<div class="mt-3"><h4>H. Keterangan Perkembangan Siswa</h4></div>
<div class="form-group">
  <label for="">Tahun masuk / terdaftar</label>
  <input type="text" name="development_registration_date" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','registration_date'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Menerima Bea Siswa</label>
  <input type="text" name="development_scholarship_grantee" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','scholarship_grantee'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tahun meninggalkan sekolah</label>
  <input type="text" name="development_finish_date" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','finish_date'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Alasan</label>
  <input type="text" name="development_reason" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','reason'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Tanggal dan nomor STTB</label>
  <input type="text" name="development_sttb_date_number" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','sttb_date_number'):''}}" class="form-control form-control-sm" />
</div>
<div class="form-group">
  <label for="">Melanjutkan pendidikan/Bekerja</label>
  <input type="text" name="development_plan" value="{{isset($row) ? $row->getInformation('studentDevelopmentInformation','plan'):''}}" class="form-control form-control-sm" />
</div>
