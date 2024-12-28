@extends('layouts.nurse')
@section('content')
    <div class="mb-3">
        <a href="{{route('nurse.rekam_medis.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Rekam Medis Baru</a>
    </div>

    <x-card title="Data Rekam Medis">
        <x-table>
            <thead>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Pasien</th>
                <th>Poli/Dokter</th>
                <th>anamnesa/Kesimpulan</th>
                <th>Cara Bayar</th>
                <th>Status</th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($rekamMedis as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $item->pasien->user->name }}</td>
                        <td>
                            <dl>
                                <dt>Poli</dt>
                                <dd>{{ $item->poli->name }}</dd>
                                <dt>Dokter</dt>
                                <dd>{{ $item->dokter->user->name }}</dd>
                            </dl>
                        </td>
                        <td>
                            <dl>
                                <dt>anamnesa</dt>
                                <dd>{{ $item->anamnesa }}</dd>
                                <dt>Kesimpulan</dt>
                                <dd>{{ $item->kesimpulan }}</dd>
                            </dl>
                        </td>
                        <td>
                            @if($item->jenis_pembayaran == 'jaminan kesehatan')
                                <span class="badge bg-success">{{ $item->jenis_pembayaran }}</span>
                            @else 
                                <span class="badge bg-muted">{{ $item->jenis_pembayaran }}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'selesai')
                                <span class="badge bg-success">{{ $item->status }}</span>
                            @else
                                <span class="badge bg-warning">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-auto p-2">
                                    <a href="{{route('nurse.rekam_medis.detail', encryptStr($item->pasien->id))}}" class="btn btn-info">
                                        <i class="fas fa-user-md"></i>
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection