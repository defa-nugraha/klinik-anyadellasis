@extends('layouts.admin')
@section('content')
    <div class="row d-flex justify-content-between">
        <div class="{{$pasien->status_menikah == 'menikah' ? 'col-md-4 col-lg-4' : 'col-md-6 col-lg-6'}} col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Detail Pasien</h4>
                        <span class="text-muted">RM# {{$pasien->no_rm}}</span>
                    </div>
        
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
            </div>
        </div>
        
        <div class="{{$pasien->status_menikah == 'menikah' ? 'col-md-4 col-lg-4' : 'col-md-6 col-lg-6'}} col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">Info Pasien</h4>
                        <span class="badge bg-warning fs-2">Di Apotek</span>
                    </div>
        
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
            </div>
        </div>

        @if ($pasien->status_menikah == 'menikah')
            <div class="col-md-4 col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Detail {{$pasien->gender == 'laki-laki' ? 'Istri' : 'Suami'}}</h4>
                        </div>
        
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
                </div>
            </div>
        @endif
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Rekam Medis Pasien</h4>
                <a href="" class="btn btn-primary">Selesaikan Rekam Medis Ini <i class="fa fa-check-circle"></i></a>
            </div>
            <x-table>
                <thead>
                    <th>No</th>
                    <th>Tanggal Periksa</th>
                    @if($pasien->status_menikah == 'menikah')
                        <th>Riwayat Persalinan</th>
                    @endif
                    <th style="min-width: 170px">Ammanesia (S)</th>
                    <th style="min-width: 170px">Pemeriksaan (O)</th>
                    <th style="min-width: 170px">Diagnosa (A)</th>
                    <th style="min-width: 170px">Tindakan (P)</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($rekamMedis as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                            @if($pasien->status_menikah == 'menikah')
                            
                                <td>
                                    @if($item->id_rm_kandungan)
                                    G: {{ $item->riwayat_persalinan->g }}
                                    P: {{ $item->riwayat_persalinan->p }}
                                    A: {{ $item->riwayat_persalinan->a }}
                                    @else
                                        -
                                    @endif
                                </td>
                            @endif
                            <td>{{ $item->ammanesia }}</td>
                            <td>
                                @if($item->id_pemeriksaan)
                                <dl>
                                    <dt>Pemeriksaan</dt>
                                    <dd>{{ $item->pemeriksaan->deskripsi }}</dd>
                                    <dt>File Pemeriksaan</dt>
                                    <dd>
                                        <a href="{{asset('file/pemeriksaan/'.$item->pemeriksaan->file)}}">Lihat</a>
                                    </dd>
                                </dl>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->id_pemeriksaan)
                                <dl>
                                    <dt>Diagnosa</dt>
                                    <dd>{{ $item->diagnosa->deskripsi }}</dd>
                                    <dt>File Diagnosa</dt>
                                    <dd>
                                        <a href="{{asset('file/diagnosa/'.$item->diagnosa->file)}}">Lihat</a>
                                    </dd>
                                </dl>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($item->id_pemeriksaan)
                                <dl>
                                    <dt>Tindakan</dt>
                                    <dd>{{ $item->tindakan->deskripsi }}</dd>
                                    <dt>File Diagnosa</dt>
                                    <dd>
                                        <a href="{{asset('file/tindakan/'.$item->tindakan->file)}}">Lihat</a>
                                    </dd>
                                </dl>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-auto p-2">
                                        <a href="{{route('admin.rekam_medis.detail', encryptStr($item->pasien->id))}}" class="btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
    </div>
@endsection