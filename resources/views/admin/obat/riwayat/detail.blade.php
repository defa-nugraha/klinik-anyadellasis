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
                    <dd>{{$pasien->user->name}}</dd>
                    <dt><i class="fas fa-{{$pasien->gender == 'laki-laki' ? 'mars' : 'venus'}}"></i> Gender, status menikah</dt>
                    <dd>{{$pasien->gender}} ({{$pasien->status_menikah}})</dd>
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
    
    <div class="{{$pasien->status_menikah == 'menikah' ? 'col-md-4 col-lg-4' : 'col-md-6 col-lg-6'}} col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Info Pasien</h4>
                    {{-- <span class="badge bg-warning fs-2 text-capitalize">{{$statusRekamMedis ? $statusRekamMedis->status : ''}}</span> --}}
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
<hr>
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
                        <td>{{$item->jumlah}}</td>
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
                <td id="total-harga" colspan="1">Rp. {{formatRupiah($total)}}</td>
            </tfoot>
        </x-table>
    </div>
</div>

  
@endsection