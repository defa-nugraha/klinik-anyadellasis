@extends('layouts.pasien')

@section('content')
<style>
    .menu-item {
        display: flex;
        align-items: center;
        font-family: 'Arial', sans-serif; /* Ganti dengan font sesuai keinginan */
        font-weight: bold;
        color: #2C3E50; /* Warna teks, ganti sesuai kebutuhan */
    }

    .divider {
        width: 2px;
        height: 100%;
        background-color: #2C3E50; /* Warna garis, ganti sesuai kebutuhan */
        margin-right: 8px; /* Jarak antara garis dan teks */
    }

    .menu-text {
        font-size: 16px; /* Ukuran teks, sesuaikan dengan kebutuhan */
    }

</style>
    @if(!$profil)
        <div class="mt-2 mb-3">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Halo, {{Auth::user()->name}}!</strong>  Kamu belum bisa mengakses fitur-fitur aplikasi sebelum profil kamu lengkap. Yuk, lengkapi profil kamu terlebih dahulu supaya bisa menggunakan aplikasi dengan penuh fitur.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-user"></i> Profil Pasien</h4>
            
                <form action="{{route('pasien.pasien.store')}}" method="post" class="form-group">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-12">
                            <label for="name" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" value="{{Auth::user()->name}}" required disabled>
                            {{-- <x-input-type type="text" name="no_rm" label="Nomor RM (optional)" required='' /> --}}
    
                            <x-input-type type="text" name="tempat_lahir" label="Tempat Lahir" required='true' />
                            
                            <label for="gender">Jenis Kelamin*</label>
                            <select name="gender" id="gender" class="form-select" required onchange="formSuamiIstri()">
                                <option value="laki-laki">Laki-laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
    
                            <label for="agama">Agama*</label>
                            <select name="agama" id="agama" class="form-select" required>
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="khatolik">Khatolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="budha">Budha</option>
                                <option value="konghucu">Konghucu</option>
                            </select>
    
                            <x-input-type type="text" name="no_hp" label="No HP" required='true' />
    
                            <label for="jenis_pembayaran">Cara Bayar*</label>
                            <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-select" required>
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="umum/mandiri">Umum/Mandiri</option>
                                <option value="jaminan kesehatan">Jaminan Kesehatan</option>
                            </select>
    
                            <x-input-type type="text" name="pekerjaan" label="Pekerjaan" required='' />
                        </div>
    
                        <div class="col-md-6 col-lg-6 col-12">
                            <x-input-type type="text" name="no_bpjs" label="No. BPJS/KTP" required='' />
    
                            <x-input-type-value value="{{date('Y-m-d')}}" type="date" name="tanggal_lahir" label="Tanggal Lahir" required='true' />
                            
                            <label for="status_menikah">Status Menikah*</label>
                            <select name="status_menikah" id="status_menikah" class="form-select" required  onchange="formSuamiIstri()">
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="belum menikah">Belum Menikah</option>
                                <option value="menikah">Menikah</option>
                                <option value="duda">Duda</option>
                                <option value="janda">Janda</option>
                            </select>
    
                            <label for="pendidikan">Pendidikan*</label>
                            <select name="pendidikan" id="pendidikan" class="form-select" required>
                                <option value="" selected disabled>--Pilih--</option>
                                <option value="SD">SD</option>
                                <option value="SMP/Sederajat">SMP/Sederajat</option>
                                <option value="SMA/Sederajat">SMA/Sederajat</option>
                                <option value="Diploma">Diploma</option>
                                <option value="S1/Sederajat">S1/Sederajat</option>
                                <option value="S2/Sederajat">S2/Sederajat</option>
                                <option value="S3/Sederajat">S3/Sederajat</option>
                                <option value="Tidak Sekolah">Tidak Sekolah</option>
                            </select>
    
                            <x-input-type type="text" name="alergi" label="Alergi" required='' />
    
                            <label for="alamat">Alamat Lengkap</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="5"></textarea>                        
                        </div>
                    </div>
                    <hr>
                    <div class="suami-istri" style="display: none">
                        <h3 id="title">Data</h3>
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-12">
                                <x-input-type type="text" name="nama_ss" label="Nama" required='' />
                                <x-input-type type="text" name="tempat_lahir_ss" label="Tempat Lahir" required='' />
                                <x-input-type-value value="{{date('Y-m-d')}}" type="date" name="tanggal_lahir_ss" label="Tanggal Lahir" required='' />
                                <x-input-type type="text" name="pekerjaan_ss" label="Pekerjaan" required='' />
                                
                            </div>
                            
                            <div class="col-md-6 col-lg-6 col-12">
                                <x-input-type type="text" name="no_bpjs_ss" label="No. BPJS/KTP" required='' />
                                <x-input-type type="text" name="no_hp_ss" label="No. HP" required='' />
                                
                                <label for="pendidikan">Pendidikan*</label>
                                <select name="pendidikan_ss" id="pendidikan" class="form-select">
                                    <option value="" selected disabled>--Pilih--</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP/Sederajat">SMP/Sederajat</option>
                                    <option value="SMA/Sederajat">SMA/Sederajat</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="S1/Sederajat">S1/Sederajat</option>
                                    <option value="S2/Sederajat">S2/Sederajat</option>
                                    <option value="S3/Sederajat">S3/Sederajat</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
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
            
        </script>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6 col-12 mb-3 mb-md-0">
                    <div class="row align-items-center">
                        <div class="col-md-3 col-lg-3 col-4">
                            <img src="{{asset('img/profil/'.Auth::user()->foto)}}" class="rounded-circle" width="100px" alt="">
                        </div>
                        <div class="col-md-9 col-lg-9 col-8">
                            <h4>{{ Auth::user()->name }}</h4>
                            <dl>
                                <dt>NO. NPJS/NIK</dt>
                                <dd>
                                    <span class="badge bg-muted">
                                        {{ $profil->no_bpjs}}
                                    </span>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            
                <div class="col-md-6 col-lg-6 col-12 d-flex justify-content-md-end mt-3 mt-md-0">
                    <div class="row">
                        <div class="col-auto">
                            <a href="#" class="btn btn-primary mb-2 mb-md-0">
                                <i class="fa fa-clipboard-list"></i> Daftar Antrian
                            </a>
                        </div>
            
                        <div class="col-auto d-none d-md-block">
                            <div class="dropdown">
                                <a class="btn btn-outline-primary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bars"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Profil</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <x-tab/>

            @yield('dashboard-content')
        </div>
    </div>
@endsection