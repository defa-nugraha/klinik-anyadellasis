@extends('layouts.dashboard-pasien')
@section('dashboard-content')
<div class="row mt-4">
    @if($antrian)
        <div class="menu-item">
            <span class="divider"></span>
            <span class="menu-text">
                Rencana Kunjungan
            </span>
        </div>
        <div class="ml-4 mt-3">
            <div class="row">
                <div class="col-auto">
                    <dl>
                        <dt>No. Antrian</dt>
                        <dd><span class="badge bg-warning">{{ $antrian->no_antrian }}</span></dd>
                        <dt>Kode Booking</dt>
                        <dd><span class="badge bg-muted">{{ $antrian->kode_booking }}</span></dd>
                        <dt>Tanggal</dt>
                        <dd>{{ tanggalIndonesia($antrian->tanggal_periksa, true) }}</dd>
                    </dl>
                </div>

                <div class="col-auto">
                    <dl>
                        <dt>Dokter</dt>
                        <dd>{{ $antrian->dokter->user->name }}</dd>
                        <dt>Poli</dt>
                        <dd>{{ $antrian->poli->name }}</dd>
                        <dt>Status</dt>
                        <dd>
                            @if($antrian->status == 'selesai')
                                <span class="badge bg-success">Selesai</span>
                            @else
                                <span class="badge bg-warning text-uppercase">{{$antrian->status}}</span>
                            @endif
                        </dd>
                    </dl>
                </div>
                <hr>
            </div>
        </div>
    @endif

    <div class="menu-item">
        <span class="divider"></span>
        <span class="menu-text">
            Rekam Medis Terbaru <br>
            <span class="badge bg-muted text-uppercase fs-1">{{$rekamMedis->status}}</span>
        </span>
    </div>
    @if($rekamMedis)
    <div class="row mt-3">
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <dl>
                <dt>Tanggal Periksa</dt>
                <dd>{{ tanggalIndonesia($rekamMedis->tgl_pemeriksaan, true) }}</dd>
                <dt>Dokter</dt>
                <dd>{{ $rekamMedis->dokter->user->name }}</dd>
                <dt>Poli</dt>
                <dd>{{ $rekamMedis->poli->name }}</dd>
            </dl>
        </div>
    
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <dl>
                <dt>Ammanesia/Keluhan(S)</dt>
                <dd>{{ $rekamMedis->ammanesia }}</dd>
                @if($rekamMedis->id_rm_kandungan)
                <dt>Riwayat Persalinan</dt>
                <dd>
                    <span class="badge bg-info">G: {{ $rekamMedis->riwayat_persalinan->g }}</span>
                    <span class="badge bg-info">P: {{ $rekamMedis->riwayat_persalinan->p }}</span>
                    <span class="badge bg-info">A: {{ $rekamMedis->riwayat_persalinan->a }}</span>
                </dd>
                @endif
            </dl>
        </div>
    
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <dl>
                <dt>Pemeriksaan(O)</dt>
                <dd>
                    @if($rekamMedis->id_pemeriksaan)
                        {!! $rekamMedis->pemeriksaan->deskripsi !!}
                    @else 
                        -
                    @endif
                </dd>
                <dt>Diagnosa(A)</dt>
                <dd>
                    @if($rekamMedis->id_diagnosa)
                        {!! $rekamMedis->diagnosa->deskripsi !!}
                    @else 
                        -
                    @endif
                </dd>
                <dt>Tindakan(P)</dt>
                <dd>
                    @if($rekamMedis->id_tindakan)
                        {!! $rekamMedis->tindakan->deskripsi !!}
                    @else 
                        -
                    @endif
                </dd>
            </dl>
        </div>
    
        <div class="col-md-3 col-sm-6 col-12 mb-3">
            <dl>
                <dt>Riwayat Penyakit</dt>
                <dd>{{ ($rekamMedis->riwayat_penyakit)?:'-' }}</dd>
                <dt>Riwayat Penyakit Keluarga</dt>
                <dd>{{ ($rekamMedis->riwayat_penyakit_keluarga)?:'-' }}</dd>
            </dl>
        </div>
    </div>
    
    @else 
    Belum tersedia
    @endif
    <hr>
</div>
@endsection