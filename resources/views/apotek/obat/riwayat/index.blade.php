@extends('layouts.apotek')
@section('content')
    <x-card title="Data Keluar Obat">
        <x-table>
            <thead>
                <th>No</th>
                <th>Pasien</th>
                <th>Tanggal Keluar</th>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Sub Total</th>
            </thead>

            <tbody>
                @foreach($obatkeluar as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <ul>
                                <li>{{ $o->pasien->user->name }}</li>
                                <li>
                                    @if($o->pasien->jenis_pembayaran == 'jaminan kesehatan')
                                        <span class="badge bg-success">{{ $o->pasien->jenis_pembayaran }}</span>
                                    @else 
                                        <span class="badge bg-warning">{{ $o->pasien->jenis_pembayaran }}</span>
                                    @endif
                                </li>
                                <li>
                                    <a href="{{route('apotek.obat-keluar.detail', encryptStr($o->id_rekam_medis))}}">
                                        Lihat Riwayat Obat
                                    </a>
                                </li>
                            </ul>
                        </td>
                        <td>{{ $o->created_at->format('d-m-Y H:i:s') }}</td>
                        <td>{{ $o->obat->nama }}</td>
                        <td>{{ $o->jumlah }} {{ $o->obat->satuan }}</td>
                        <td>{{ formatRupiah($o->harga) }}</td>
                        <td>{{ formatRupiah($o->harga * $o->jumlah) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection