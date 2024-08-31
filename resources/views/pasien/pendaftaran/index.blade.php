@extends('layouts.dashboard-pasien')
@section('dashboard-content')
<x-table>
    <thead>
        <th>Pasien</th>
        <th>Antrian</th>
        <th>Tujuan</th>
    </thead>

    <tbody>
        @foreach($antrian as $a)
            <tr>
                <td>
                    <dl>
                        <dt>Nama</dt>
                        <dd>{{$a->pasien->user->name}}</dd>
                        <dt>No Hp</dt>
                        <dd>{{$a->pasien->user->no_hp}}</dd>
                        <dt>No BPJS/NIK</dt>
                        <dd>{{$a->pasien->no_bpjs}}</dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Status</dt>
                        <dd><span class="badge text-uppercase bg-{{ ($a->status == 'selesai' ? 'success' : 'warning') }}">{{$a->status}}</span></dd>
                        <dt>No. Antrian</dt>
                        <dd><span class="badge bg-info">{{$a->no_antrian}}</span></dd>
                        <dt>Kode Booking</dt>
                        <dd><span class="badge bg-muted">{{$a->kode_booking}}</span></dd>
                    </dl>
                </td>
                <td>
                    <dl>
                        <dt>Poli</dt>
                        <dd>{{$a->poli->name}}</dd>
                        <dt>Dokter</dt>
                        <dd>{{$a->dokter->user->name}}</dd>
                    </dl>
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table>
@endsection