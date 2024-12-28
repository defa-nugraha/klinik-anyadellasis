@extends('layouts.apotek')
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
                        <i class="fa fa-file-medical" style="font-size: 40px"></i>
                        <h1>{{ $permintaanObat->where('tgl_pemeriksaan', date('Y-m-d'))->count() }}</h1>
                    </div>
                    <span>Total Permintaan Obat Hari Ini</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-arrow-circle-down" style="font-size: 40px"></i>
                        <h1>{{ $obatKeluar->where('created_at', '>=', now()->startOfDay())->where('created_at', '<=', now()->endOfDay())->count() }}</h1>
                    </div>
                    <span>Total Obat Keluar Hari Ini</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-pills" style="font-size: 40px"></i>
                        <h1>{{ $obat->count() }}</h1>
                    </div>
                    <span>Total Data Obat</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-box-open" style="font-size: 40px"></i>
                        <h1>{{ $obatKeluar->count() }}</h1>
                    </div>
                    <span>Total Obat keluar</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa fa-file-medical"></i> Permintaan Obat Hari Ini</h5>
        
                    <div class="row">
                        @if(!$permintaanObat)
                            <strong class="text-center">Tidak ada</strong>
                        @else
                            @foreach($permintaanObat as $item)
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
                                <li class="mt-2">
                                    <a href="{{route('apotek.obat.resep.create', encryptStr($item->id))}}" class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i> Proses
                                    </a>
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