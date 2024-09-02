@extends('layouts.nurse')
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
                                <strong>Anamnesa: </strong> 
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
                                <strong>Diagnosa: </strong> <br>
                                {{ getDiagnosa($rekamMedis->id_diagnosa)?:'-' }}
                            </li>
                            <li><strong>Catatan (diagnosa)</strong>{!! $rekamMedis->diagnosa->deskripsi?:'-' !!}</li>
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
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between">
            <h4 class="card-title">
                <i class="fa fa-pills"></i> Riwayat Obat
            </h4>
        </div>

        <x-table>
            <thead>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
                <th>Ket</th>
            </thead>

            <tbody>
                @php
                    $total = 0
                @endphp
                @foreach ($riwayatObat as $item)
                    <tr>
                        <td>
                            <span class="badge bg-muted">{{$item->obat->kode}}</span>
                        </td>
                        <td>{{$item->obat->nama}}</td>
                        <td>{{$item->jumlah}} {{ $item->obat->satuan }}</td>
                        <td>{{formatRupiah($item->harga)}}</td>
                        <td>{{formatRupiah($item->jumlah * $item->harga)}}</td>
                        <td>{{$item->keterangan}}</td>
                    </tr>
                    @php
                        $total += $item->jumlah * $item->harga
                    @endphp
                @endforeach
            </tbody>
            <tfoot>
                <td colspan="5" class="text-end">
                    <strong>Total: </strong>
                </td>
                <td id="total-harga" colspan="1">{{formatRupiah($total)}}</td>
            </tfoot>
        </x-table>
    </div>
</div>

  
@endsection