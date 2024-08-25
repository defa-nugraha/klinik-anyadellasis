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
        
        @if ($pasien->status_menikah == 'menikah')
            <div class="col-md-4 col-lg-4 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">Detail {{$pasien->gender == 'laki-laki' ? 'Istri' : 'Suami'}}</h4>
                        </div>
        
                        <dl>
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
                    <th>Ammanesia (S)</th>
                    <th>Pemeriksaan (O)</th>
                    <th>Diagnosa (A)</th>
                    <th>Tindakan (P)</th>
                    <th></th>
                </thead>
            </x-table>
        </div>
    </div>
@endsection