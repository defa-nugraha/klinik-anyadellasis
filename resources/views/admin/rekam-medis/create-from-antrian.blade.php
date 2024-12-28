@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tambah Rekam Medis Baru</h3>
            <form action="{{route('admin.rekam_medis.store')}}" method="post" class="form-group">
                @csrf
                <input type="hidden" name="pasien" id="id_pasien" required>
                
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="kandungan" class="form-label">Kandungan</label>
                        <select name="kandungan" id="kandungan" onclick="formKandungan()" class="form-select" required>
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>

                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="">Tanggal Pemeriksaan</label>
                        <input value="{{$antrian->tanggal_periksa}}" type="date" name="tgl_pemeriksaan" class="form-control" readonly required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <input type="hidden" name="pasien" value="{{$pasien->id}}">
                        <label for="pilih-pasien" class="form-label">Nama Pasien</label>
                        <input type="text" id="pilih-pasien" value="{{$pasien->user->name}}" name="nama_pasien" class="form-control" readonly>
                    </div>

                    <div class="col-md-6 col-lg-6 col-12 ">
                        <x-select name="jenis_pembayaran" label="Jenis Pembayaran">
                            <option value="umum/mandiri">Umum/Mandiri</option>
                            <option value="jaminan kesehatan">Jaminan Kesehatan</option>
                        </x-select>
                    </div>
                </div>

                <div id="form-kandungan" style="display: none">
                    <label for="username" class="form-label mt-2">Riwayat Persalinan yang Lalu</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">G</span>
                        <input type="text" class="form-control" name="g" placeholder="G" aria-label="G">
                        <span class="input-group-text">P</span>
                        <input type="text" class="form-control" name="p" placeholder="P" aria-label="P">
                        <span class="input-group-text">A</span>
                        <input type="text" class="form-control" name="a" placeholder="A" aria-label="A">
                    </div>
                </div>

                <label for="anamnesa" class="form-label">anamnesa</label>
                <textarea name="anamnesa" id="anamnesa" cols="30" rows="4" class="form-control" required></textarea>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit</label>
                        <textarea name="riwayat_penyakit" id="riwayat_penyakit" cols="30" rows="4" class="form-control"></textarea>  
                    </div>

                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="riwayat_penyakit_keluarga" class="form-label">Riwayat Penyakit Keluarga</label>
                        <textarea name="riwayat_penyakit_keluarga" id="riwayat_penyakit_keluarga" cols="30" rows="4" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="poli" class="form-label">Poli</label>
                        <input type="text"id="poli" class="form-control" value="{{$antrian->poli->name}}" readonly>
                        <input type="hidden" name="poli" value="{{$antrian->poli->id}}">
                    </div>

                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="dokter" class="form-label">Dokter</label>
                        <input type="text"id="dokter" class="form-control" value="{{$antrian->dokter->user->name}}" readonly>
                        <input type="hidden" name="dokter" value="{{$antrian->dokter->id}}">
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button> <button class="btn btn-danger" type="reset"><i class="fa fa-times"></i> Batal</button>
                </div>
            </form>
            
            
            <script>
                function formKandungan(){
                    const kandungan = $('#kandungan').val();
                    console.log(kandungan)
                    if(kandungan == 0){
                        $('#form-kandungan').hide();
                    } else{
                        $('#form-kandungan').show();
                    }
                }
            </script>
            
        </div>
    </div>
@endsection