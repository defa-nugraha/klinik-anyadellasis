@extends('layouts.apotek')
@section('content')
<details class="mb-3">
    <summary>
        Tampilkan detail pasien
    </summary>
    <p>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Detail Pasien</h4>
                            <span class="text-muted">RM# {{$pasien->no_rm}}</span>
                        </div>
                        <hr>
                        
                        <!-- Responsive Grid -->
                        <div class="row">
                            <!-- Detail Pasien -->
                            <div class="col-md-4">
                                <h5><i class="fas fa-user"></i> Detail Pasien</h5>
                                <dl>
                                    <dt><i class="fas fa-user"></i> Nama</dt>
                                    <dd>{{$pasien->user->name}}, {{$pasien->gender}} ({{$pasien->status_menikah}})</dd>
                                    <dt><i class="fas fa-calendar-alt"></i> Tempat, Tanggal Lahir</dt>
                                    <dd>{{$pasien->tempat_lahir}}, {{$pasien->tanggal_lahir}}</dd>
                                    <dt><i class="fas fa-briefcase"></i> Pekerjaan, Pendidikan</dt>
                                    <dd>{{$pasien->pekerjaan}}, {{$pasien->pendidikan}}</dd>
                                    <dt><i class="fas fa-map-marker-alt"></i> Alamat</dt>
                                    <dd>{{$pasien->alamat}}</dd>
                                </dl>
                            </div>
                            
                            <!-- Info Pasien -->
                            <div class="col-md-4">
                                <h5><i class="fas fa-info-circle"></i> Info Pasien</h5>
                                <dl>
                                    <dt><i class="fas fa-phone-alt"></i> No HP</dt>
                                    <dd>{{$pasien->no_hp}}</dd>
                                    <dt><i class="fas fa-id-card"></i> No BPJS/KTP</dt>
                                    <dd>{{$pasien->no_bpjs}}</dd>
                                    <dt><i class="fas fa-credit-card"></i> Pembayaran</dt>
                                    <dd>{{$pasien->jenis_pembayaran}}</dd>
                                    <dt><i class="fas fa-exclamation-triangle"></i> Alergi</dt>
                                    <dd>{{$pasien->alergi}}</dd>
                                </dl>
                            </div>
        
                            <!-- Detail Suami/Istri (Jika Menikah) -->
                            @if ($pasien->status_menikah == 'menikah')
                                <div class="col-md-4">
                                    <h5><i class="fas fa-heart"></i> Detail {{$pasien->gender == 'laki-laki' ? 'Istri' : 'Suami'}}</h5>
                                    <dl>
                                        <dt><i class="fas fa-user"></i> Nama</dt>
                                        <dd>{{$suamiIstri->nama}}</dd>
                                        <dt><i class="fas fa-phone-alt"></i> No HP</dt>
                                        <dd>{{$suamiIstri->no_hp}}</dd>
                                        <dt><i class="fas fa-id-card"></i> No BPJS/KTP</dt>
                                        <dd>{{$suamiIstri->no_bpjs}}</dd>
                                        <dt><i class="fas fa-calendar-alt"></i> Tempat, Tanggal Lahir</dt>
                                        <dd>{{$suamiIstri->tempat_lahir}}, {{$suamiIstri->tanggal_lahir}}</dd>
                                        <dt><i class="fas fa-briefcase"></i> Pekerjaan, Pendidikan</dt>
                                        <dd>{{$suamiIstri->pekerjaan}}, {{$suamiIstri->pendidikan}}</dd>
                                    </dl>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>
    </p>
</details>

<hr>

<div class="row">
    <div class="col-md-12 col-lg-12 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="ti ti-stethoscope fs-6"></i> Rekam Medis Pasien
                </h4>

                <div class="row">
                    <div class="col-md-6 col-lg-6 col-12">
                        <ul>
                            <li>
                                <Strong>Tanggal Pemeriksaan: </Strong>
                                <p>
                                    {{$rekamMedis->tgl_pemeriksaan}}
                                </p>
                            </li>
                            <li>
                                <Strong>Riwayat Persalinan: </Strong>
                                <p>
                                    @if($rekamMedis->id_rm_kandungan)
                                    G: {{$rekamMedis->riwayat_persalinan->g}} P: {{$rekamMedis->riwayat_persalinan->p}} A: {{$rekamMedis->riwayat_persalinan->a}}
                                    @else 
                                        -
                                    @endif
                                </p>
                            </li>
                            <li>
                                <strong>Ammanesia: </strong> 
                                <p>
                                    {{$rekamMedis->ammanesia}}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-6 col-12">
                        <ul>
                            <li>
                                <strong>Pemeriksaan: </strong> {!! ($rekamMedis->id_pemeriksaan) ? $rekamMedis->pemeriksaan->deskripsi : '-' !!}
                            </li>
                            <li>
                                <strong>Diagnosa: </strong> {!!($rekamMedis->id_diagnosa) ? $rekamMedis->diagnosa->deskripsi : '-'!!}
                            </li>
                            <li>
                                <strong>Tindakan: </strong> {!!($rekamMedis->id_tindakan) ? $rekamMedis->tindakan->deskripsi : '-'!!}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4 col-lg-4 col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-pills"></i> Pemberian Obat</h4>

                <form action="" method="post">
                    <input type="hidden" name="id_obat" id="id_obat">
                    <input type="hidden" name="kode" id="kode">
                    <label for="obat" class="form-label">Nama Obat*</label>
                    <input type="text" class="form-control" id="obat" placeholder="pilih obat" readonly required data-bs-toggle="modal" data-bs-target="#pilihObatModal">
                
                    <x-input-type type="number" name="jml_obat" label="Jumlah Obat" required="true" />
                
                    <label for="harga" class="form-label">Harga*</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Rp. 0" readonly required>
                
                    <x-input-type type="text" name="keterangan" label="Keterangan" required="" />

                    <button class="w-100 mt-2 btn btn-primary" type="button" onclick="TambahObat()">
                        <i class="fa fa-plus"></i> Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8 col-lg-8 col-sm-12 col-12">
        
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">
                        <i class="fa fa-pills"></i> Obat yang dikeluarkan
                    </h4>
                    <a href="{{route('apotek.rekam_medis.update-status').'?rekam_medis='.encryptStr($rekamMedis->id).'&status=selesai'}}" class="btn btn-success mb-3">
                        Selesaikan tanpa pemberian obat <i class="fa fa-check-circle fs-6"></i> 
                    </a>
                </div>

                <form action="{{route('apotek.obat.storeResep')}}" method="post">
                    <x-table>
                        <thead>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Ket</th>
                            <th></th>
                        </thead>
    
                        <tbody id="tabel-obat">
                            
                        </tbody>
                        <tfoot>
                            <td colspan="2">
                                <strong>Total</strong>
                            </td>
                            <td id="total-harga" colspan="7">Rp. 0</td>
                        </tfoot>
                    </x-table>
                    <div class="input-resep">
                        @csrf
                        <input name="id_rekam_medis" type="hidden" value="{{encryptStr($rekamMedis->id)}}">
                    </div>
                    <button class="btn btn-primary w-100" >Simpan dan selesaikan proses</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="pilihObatModal" tabindex="-1" aria-labelledby="pilihObatLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="pilihObatLabel">Pilih Obat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <x-table>
            <thead>
              <tr>
                <th></th>
                <th>Kode Obat</th>
                <th>Nama Obat</th>
                <th>Harga</th>
                <th>Satuan</th>
                <th>untuk BPJS</th>
                <th>Stok</th>
                
              </tr>
            </thead>
            <tbody>
              @foreach($obat as $item)
                <tr>
                    <td>
                        <button data-bs-dismiss="modal" onclick="selectObat('{{encryptStr($item->id)}}', '{{$item->kode}}', '{{$item->nama}}', '{{formatRupiah($item->harga)}}')" class="btn btn-sm btn-primary">Pilih</button>
                        <td>{{$item->kode}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{formatRupiah($item->harga)}}</td>
                        <td>{{$item->satuan}}</td>
                        <td>{{$item->bpjs}}</td>
                        <td>{{$item->stok}}</td>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </x-table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    
     function selectObat(id, kode, nama, harga){
        $('#id_obat').val(id);
        $('#obat').val(nama);
        $('#harga').val(harga);
        $('#kode').val(kode);
     }
     
     function TambahObat(){
        let tabel = $('#tabel-obat');
        let input_resep = $('.input-resep');
        let id_obat = $('#id_obat').val();
        let kode = $('#kode').val();
        let nama = $('#obat').val();
        let harga = $('#harga').val();
        let jml_obat = $('#jml_obat').val();
        let keterangan = $('#keterangan').val();
        let total = jml_obat*parseRupiah(harga);

        let total_harga = $('#total-harga');

        
        if(!id_obat || !kode || !nama || !harga || !jml_obat){
            alert('Lengkapi data obat terlebih dahulu');
            console.log('id:' + id_obat, 'kode:' + kode, 'nama:' + nama, 'harga:' + harga, 'jumlah:' + jml_obat);
            return;
        }
        $('.dt-empty').html('');
        console.log(parseRupiah(total_harga.text()));
        total_harga.text(formatRupiah(parseRupiah(total_harga.text()) + total));

        tabel.prepend(`<tr>
            <td>${kode}</td>
            <td>${nama}</td>
            <td>${jml_obat}</td>
            <td>${formatRupiah(harga)}</td>
            <td class="total">${formatRupiah(total)}</td>
            <td>${keterangan}</td>
            <td>
                <button class="btn btn-danger" type="button" onclick="hapusRow(this)">
                <i class="fa fa-trash"></i>
                </button>
            </td>
        </tr>`);

        // input resep
        input_resep.append(`<input type="hidden" name="obat[]" value="${id_obat}">`);
        input_resep.append(`<input type="hidden" name="jml_obat[]" value="${jml_obat}">`);
        input_resep.append(`<input type="hidden" name="keterangan[]" value="${keterangan}">`);
        
     }
    </script>
    

    <script>
        function formatRupiah(angka, prefix = 'Rp. ') {
            const numberString = angka.toString().replace(/[^,\d]/g, '');
            const split = numberString.split(',');
            const sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Tambahkan titik jika ribuan
            if (ribuan) {
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix + rupiah;
        }

        function parseRupiah(rupiah) {
            return parseInt(rupiah.replace(/[^,\d]/g, ''), 10);
        }

        function hapusRow(button) {
            // Mendapatkan baris yang berisi tombol hapus
            const row = $(button).closest('tr');
            
            const harga = parseRupiah(row.find('.total').text());
            
            let total_harga = parseRupiah($('#total-harga').text());
            total_harga -= harga;
            
            $('#total-harga').text(formatRupiah(total_harga));

            row.remove();
        }

    </script>
  
@endsection