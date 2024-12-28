@extends('layouts.nurse')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tambah Rekam Medis Baru</h3>
            <form action="{{route('nurse.rekam_medis.store')}}" method="post" class="form-group">
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
                        <x-input-type-value value="{{date('Y-m-d')}}" type="date" name="tgl_pemeriksaan" label="Tanggal Pemeriksaan" required="true" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <label for="pilih-pasien" class="form-label">Pilih Pasien</label>
                        <input type="text" id="pilih-pasien" name="nama_pasien" class="form-control" placeholder="Klik untuk memilih pasien" readonly data-bs-toggle="modal" data-bs-target="#modalPilihPasien">
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

                <label for="ammanesia" class="form-label">Ammanesia</label>
                <textarea name="ammanesia" id="ammanesia" cols="30" rows="4" class="form-control" required></textarea>

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
                        <x-select name="poli" label="Poli Tujuan" required>
                            @foreach ($poli as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </x-select>    
                    </div>

                    <div class="col-md-6 col-lg-6 col-12">
                        <x-select name="dokter" label="Dokter" required>
                            @foreach ($dokter as $item)
                                <option value="{{$item->id}}">{{$item->user->name}}</option>
                            @endforeach
                        </x-select>
                    </div>
                </div>

                <div class="mt-3">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button> <button class="btn btn-danger" type="reset"><i class="fa fa-times"></i> Batal</button>
                </div>
            </form>
            
            <!-- Modal untuk memilih pasien -->
            <div class="modal fade" id="modalPilihPasien" tabindex="-1" aria-labelledby="modalPilihPasienLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPilihPasienLabel">Pilih Pasien</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <x-table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Pasien</th>
                                        <th>No. Rekam Medis</th>
                                        <th>Tanggal Lahir</th>
                                        <th>No Hp</th>
                                        <th>Cara Bayar</th>
                                        <th>No BPJS/KTP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pasien as $p)
                                    <tr>
                                        <td>
                                            <button type="button" class="btn btn-primary pilih-pasien-btn" data-nama="{{ $p->user->name }}" data-id="{{ $p->id }}" data-bs-dismiss="modal">Pilih</button>
                                        </td>
                                        <td>{{ $p->user->name }}</td>
                                        <td>{{ $p->no_rm }}</td>
                                        <td>{{ $p->tanggal_lahir }}</td>
                                        <td>{{ $p->no_hp }}</td>
                                        <td>{{ $p->jenis_pembayaran }}</td>
                                        <td>{{ $p->no_bpjs }}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </x-table>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                document.querySelectorAll('.pilih-pasien-btn').forEach(function(button) {
                    button.addEventListener('click', function() {
                        const namaPasien = this.getAttribute('data-nama');
                        const idPasien = this.getAttribute('data-id');
            
                        // Set nilai input text dengan nama pasien yang dipilih
                        document.getElementById('pilih-pasien').value = namaPasien;
            
                        $('#id_pasien').val(idPasien);
                    });
                });

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