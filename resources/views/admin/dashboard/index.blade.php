@extends('layouts.admin')
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
@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-clipboard-list" style="font-size: 40px"></i>
                        <h1>{{ $pasienHariIni->count() }}</h1>
                    </div>
                    <span>Pendaftaran Pasien Hari Ini</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-calendar-check" style="font-size: 40px"></i>
                        <h1>{{ $pasienHariIni->count() }}</h1>
                    </div>
                    <span>Pemeriksaan Pasien Hari Ini</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-user-injured" style="font-size: 40px"></i>
                        <h1>{{ $pasien->count() }}</h1>
                    </div>
                    <span>Total Pasien</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-user-md" style="font-size: 40px"></i>
                        <h1>{{ $dokter->count() }}</h1>
                    </div>
                    <span>Total Dokter</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa fa-clipboard"></i> Jadwal Dokter Hari Ini</h5>
        
                    @if(!$jadwalDokter)
                            <strong class="text-center">Tidak ada</strong>
                    @else
                        @foreach($jadwalDokter as $jd)
                            <ul>
                                <li class="mb-2">
                                    <i class="fa fa-user-md me-2"></i> <strong>Dokter:</strong> {{ $jd->dokter->user->name }}
                                </li>
                                <li class="mb-2">
                                    <i class="fa fa-clock me-2"></i><strong>Waktu:</strong>{{ $jd->jam_mulai }} - {{ $jd->jam_selesai }}
                                </li>
                                <li class="mb-2">
                                    <i class="fa fa-hospital me-2"></i><strong>Poli:</strong> {{ $jd->dokter->poli->name }}
                                </li>
                            </ul>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa fa-clipboard"></i> Perawatan Hari Ini</h5>
        
                    <div class="row">
                        @if(!$pasienHariIni)
                            <strong class="text-center">Tidak ada</strong>
                        @else
                            @foreach($pasienHariIni as $item)
                            <div class="menu-item mb-2">
                                <span class="divider"></span>
                                <span class="menu-text">
                                    {{ $item->pasien->user->name }}
                                </span>
                            </div>
                            <ul class="list-unstyled mb-2">
                                <li class="mb-2">
                                    <i class="fa fa-clock me-2"></i> 
                                    <strong>Waktu:</strong> {{ $item->created_at->diffForHumans() }}
                                </li>
                                <li>
                                    <i class="fa fa-check-circle me-2"></i> 
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ $item->status == 'selesai' ? 'success' : 'warning' }} text-uppercase">{{ $item->status }}</span>
                                </li>
                                <li>
                                    <i class="fa fa-comment-dots me-2"></i> 
                                    <strong>Keluhan:</strong> {{ $item->ammanesia }}
                                </li>
                                <li>
                                    <i class="fa fa-user-md me-2"></i> 
                                    <strong>Dokter:</strong> {{ $item->dokter->user->name }}
                                </li>
                            </ul>
                            <hr>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection