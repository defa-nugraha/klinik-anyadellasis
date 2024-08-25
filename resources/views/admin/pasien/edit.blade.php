@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><i class="fa fa-user-injured"></i> Tambah Pasien Baru</h4>
        
            <form action="{{route('admin.pasien.update')}}" method="post" class="form-group">
                @csrf
                <input type="hidden" name="user" value="{{encryptStr($pasien->user->id)}}">
                <input type="hidden" name="id" value="{{encryptStr($pasien->id)}}">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <x-input-type-value value="{{$pasien->user->name}}" type="text" name="name" label="Nama Pasien" required='true' />
                        <x-input-type-value value="{{$pasien->no_rm}}" type="text" name="no_rm" label="Nomor RM" required='true' />

                        <x-input-type-value value="{{$pasien->tempat_lahir}}" type="text" name="tempat_lahir" label="Tempat Lahir" required='true' />
                        
                        <label for="gender">Jenis Kelamin*</label>
                        <select name="gender" id="gender" class="form-select" required onchange="formSuamiIstri()">
                            <option value="laki-laki" {{$pasien->gender == 'laki-laki' ? 'selected' : ''}}>Laki-laki</option>
                            <option value="perempuan" {{$pasien->gender == 'perempuan' ? 'selected' : ''}}>Perempuan</option>
                        </select>

                        <label for="agama">Agama*</label>
                        <select name="agama" id="agama" class="form-select" required>
                            <option value="" selected disabled>--Pilih--</option>
                            <option value="islam" {{$pasien->agama == 'islam' ? 'selected' : ''}}>Islam</option>
                            <option value="kristen" {{$pasien->agama == 'kristen' ? 'selected' : ''}}>Kristen</option>
                            <option value="khatolik" {{$pasien->agama == 'khatolik' ? 'selected' : ''}}>Khatolik</option>
                            <option value="hindu" {{$pasien->agama == 'hindu' ? 'selected' : ''}}>Hindu</option>
                            <option value="budha" {{$pasien->agama == 'budha' ? 'selected' : ''}}>Budha</option>
                            <option value="konghucu" {{$pasien->agama == 'konghucu' ? 'selected' : ''}}>Konghucu</option>
                        </select>

                        <x-input-type-value value="{{$pasien->no_hp}}" type="text" name="no_hp" label="No HP" required='true' />

                        <label for="jenis_pembayaran">Cara Bayar*</label>
                        <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select" required>
                            <option value="" selected disabled>--Pilih--</option>
                            <option value="umum/mandiri" {{$pasien->jenis_pembayaran == 'umum/mandiri' ? 'selected' : ''}}>Umum/Mandiri</option>
                            <option value="jaminan kesehatan" {{$pasien->jenis_pembayaran == 'jaminan kesehatan' ? 'selected' : ''}}>Jaminan Kesehatan</option>
                        </select>

                        <x-input-type-value value="{{$pasien->pekerjaan}}" type="text" name="pekerjaan" label="Pekerjaan" required='' />
                    </div>

                    <div class="col-md-6 col-lg-6 col-12">
                        <x-input-type-value value="{{$pasien->no_bpjs}}" type="text" name="no_bpjs" label="No. BPJS/KTP" required='' />

                        <x-input-type-value value="{{$pasien->tanggal_lahir}}" type="date" name="tanggal_lahir" label="Tanggal Lahir" required='true' />
                        
                        <label for="status_menikah">Status Menikah*</label>
                        <select name="status_menikah" id="status_menikah" class="form-select" required  onchange="formSuamiIstri()">
                            <option value="" selected disabled>--Pilih--</option>
                            <option value="belum menikah" {{$pasien->status_menikah == 'belum menikah' ? 'selected' : ''}}>Belum Menikah</option>
                            <option value="menikah" {{$pasien->status_menikah == 'menikah' ? 'selected' : ''}}>Menikah</option>
                            <option value="duda" {{$pasien->status_menikah == 'duda' ? 'selected' : ''}}>Duda</option>
                            <option value="janda" {{$pasien->status_menikah == 'janda' ? 'selected' : ''}}>Janda</option>
                        </select>

                        <label for="pendidikan">Pendidikan*</label>
                        <select name="pendidikan" id="pendidikan" class="form-select" required>
                            <option value="" selected disabled>--Pilih--</option>
                            <option value="SD" {{$pasien->pendidikan == 'SD' ? 'selected' : ''}}>SD</option>
                            <option value="SMP/Sederajat" {{$pasien->pendidikan == 'SMP/Sederajat' ? 'selected' : ''}}>SMP/Sederajat</option>
                            <option value="SMA/Sederajat" {{$pasien->pendidikan == 'SMA/Sederajat' ? 'selected' : ''}}>SMA/Sederajat</option>
                            <option value="Diploma" {{$pasien->pendidikan == 'Diploma' ? 'selected' : ''}}>Diploma</option>
                            <option value="S1/Sederajat" {{$pasien->pendidikan == 'S1/Sederajat' ? 'selected' : ''}}>S1/Sederajat</option>
                            <option value="S2/Sederajat" {{$pasien->pendidikan == 'S2/Sederajat' ? 'selected' : ''}}>S2/Sederajat</option>
                            <option value="S3/Sederajat" {{$pasien->pendidikan == 'S3/Sederajat' ? 'selected' : ''}}>S3/Sederajat</option>
                            <option value="Tidak Sekolah" {{$pasien->pendidikan == 'Tidak Sekolah' ? 'selected' : ''}}>Tidak Sekolah</option>
                        </select>

                        <x-input-type-value value="{{$pasien->user->email}}" type="email" name="email" label="Email (digunakan username dan password)" required='true' />
                        
                        <x-input-type-value value="{{$pasien->alergi}}" type="text" name="alergi" label="Alergi" required='' />

                        <label for="alamat">Alamat Lengkap</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5">{{$pasien->alamat}}</textarea>                        
                    </div>
                </div>
                <hr>
                <div class="suami-istri" style="display: {{(!$suamiIstri) ? 'none' : ''}}">
                    <input type="hidden" name="suami_istri" value="{{($suamiIstri) ? encryptStr($suamiIstri->id) : ''}}">
                    <h3 id="title">Data {{$pasien->gender == 'laki-laki' ? 'Istri' : 'Suami'}}</h3>
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-12">
                            <x-input-type-value value="{{($suamiIstri) ? $suamiIstri->nama : ''}}" type="text" name="nama_ss" label="Nama" required='' />
                            <x-input-type-value value="{{$suamiIstri ? $suamiIstri->tempat_lahir : ''}}" type="text" name="tempat_lahir_ss" label="Tempat Lahir" required='' />
                            <x-input-type-value value="{{$suamiIstri ? $suamiIstri->tanggal_lahir: ''}}" type="date" name="tanggal_lahir_ss" label="Tanggal Lahir" required='' />
                            <x-input-type-value value="{{$suamiIstri ? $suamiIstri->pekerjaan : ''}}" type="text" name="pekerjaan_ss" label="Pekerjaan" required='' />
                            
                        </div>
                        
                        <div class="col-md-6 col-lg-6 col-12">
                            <x-input-type-value value="{{$suamiIstri ? $suamiIstri->no_bpjs : ''}}" type="text" name="no_bpjs_ss" label="No. BPJS/KTP" required='' />
                            <x-input-type-value value="{{$suamiIstri ? $suamiIstri->no_hp : ''}}" type="text" name="no_hp_ss" label="No. HP" required='' />
                            
                            <label for="pendidikan">Pendidikan*</label>
                            <select name="pendidikan_ss" id="pendidikan" class="form-select">
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="SD" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP/Sederajat" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'SMP/Sederajat' ? 'selected' : '' }}>SMP/Sederajat</option>
                                <option value="SMA/Sederajat" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'SMA/Sederajat' ? 'selected' : '' }}>SMA/Sederajat</option>
                                <option value="Diploma" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                                <option value="S1/Sederajat" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'S1/Sederajat' ? 'selected' : '' }}>S1/Sederajat</option>
                                <option value="S2/Sederajat" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'S2/Sederajat' ? 'selected' : '' }}>S2/Sederajat</option>
                                <option value="S3/Sederajat" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'S3/Sederajat' ? 'selected' : '' }}>S3/Sederajat</option>
                                <option value="Tidak Sekolah" {{ ($suamiIstri) && $suamiIstri->pendidikan == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                            </select>
                                
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mt-3">SIMPAN</button>
            </form>
        </div>
    </div>

    <script>
        function formSuamiIstri(){
            const gender = $('#gender').val();
            const status_menikah = $('#status_menikah').val();

            let title = '';
            if(gender == 'laki-laki' && status_menikah == 'menikah'){
                title = 'Data Istri';
            } else if(gender == 'perempuan' && status_menikah == 'menikah'){
                title = 'Data Suami';
            }

            if(title){
                $('.suami-istri').show();
            } else{
                $('.suami-istri').hide();
            }
            // update text title
            $('#title').text(title)

        }
        formSuamiIstri()
    </script>
@endsection