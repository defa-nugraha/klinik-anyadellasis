@extends('layouts.admin')

@section('content')
<a href="{{route('admin.pasien.create')}}" class="mb-3 btn btn-primary">
   <i class="fa fa-circle-plus"></i> Tambah Pasien
</a>
<x-card title="Data Pasien">
    <x-table>
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Pengobatan</th>
            <th></th>
        </thead>

        <tbody>
            @foreach($pasien as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <dl>
                            <dt>Nama</dt>
                            <dd>{{ $p->user->name }}</dd>
                            <dt>No Hp</dt>
                            <dd>{{ $p->user->no_hp }}</dd>
                        </dl>
                    </td>
                    <td>{{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->gender }}</td>
                    <td>
                        <dl>
                            <dt>Cara Bayar</dt>
                            <dd>{{ $p->jenis_pembayaran }}</dd>
                            <dt>No BPJS/KTP</dt>
                            <dd>{{ $p->no_bpjs }}</dd>
                        </dl>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
</x-card>
@endsection