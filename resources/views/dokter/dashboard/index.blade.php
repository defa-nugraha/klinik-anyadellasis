@extends('layouts.dokter')

@section('content')
    <div class="row">
        <div class="col-md-3 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <i class="fa fa-clipboard-list" style="font-size: 40px"></i>
                        <h1>17</h1>
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
                        <h1>12</h1>
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
                        <h1>70</h1>
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
                        <h1>25</h1>
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
                    <h5 class="card-title"><i class="fa fa-clipboard"></i> Jadwal Dokter Hari Ini</h5>
        
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-user-md me-2"></i> Dr. Defa Nugraha</h5>
                            <p class="card-text mb-2">
                                <i class="fa fa-calendar-alt me-2"></i><strong>Hari:</strong> Senin, Rabu, Jumat
                            </p>
                            <p class="card-text mb-2">
                                <i class="fa fa-clock me-2"></i><strong>Waktu:</strong> 08:00 - 12:00
                            </p>
                            <p class="card-text mb-2">
                                <i class="fa fa-hospital me-2"></i><strong>Poli:</strong> Poli Umum
                            </p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa fa-user-md me-2"></i> Dr. Seika Nugraha</h5>
                            <p class="card-text mb-2">
                                <i class="fa fa-calendar-alt me-2"></i><strong>Hari:</strong> Senin, Rabu, Jumat
                            </p>
                            <p class="card-text mb-2">
                                <i class="fa fa-clock me-2"></i><strong>Waktu:</strong> 08:00 - 12:00
                            </p>
                            <p class="card-text mb-2">
                                <i class="fa fa-hospital me-2"></i><strong>Poli:</strong> Poli Umum
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa fa-clipboard"></i> Perawatan Hari Ini</h5>
        
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>I Rosiana</strong></h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="fa fa-clock me-2"></i> 
                                        <strong>Waktu:</strong> 1 jam yang lalu
                                    </li>
                                    <li>
                                        <i class="fa fa-check-circle me-2"></i> 
                                        <strong>Status:</strong> 
                                        <span class="badge bg-success">Selesai</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-comment-dots me-2"></i> 
                                        <strong>Keluhan:</strong> Sasak Nafas
                                    </li>
                                    <li>
                                        <i class="fa fa-user-md me-2"></i> 
                                        <strong>Dokter:</strong> Defa Nugraha
                                    </li>
                                </ul>
                            </div>
                        </div>
        
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Seika Nugraha</strong></h5>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <i class="fa fa-clock me-2"></i> 
                                        <strong>Waktu:</strong> 1 jam yang lalu
                                    </li>
                                    <li>
                                        <i class="fa fa-check-circle me-2"></i> 
                                        <strong>Status:</strong> 
                                        <span class="badge bg-success">Selesai</span>
                                    </li>
                                    <li>
                                        <i class="fa fa-comment-dots me-2"></i> 
                                        <strong>Keluhan:</strong> Sasak Nafas
                                    </li>
                                    <li>
                                        <i class="fa fa-user-md me-2"></i> 
                                        <strong>Dokter:</strong> Defa Nugraha
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection