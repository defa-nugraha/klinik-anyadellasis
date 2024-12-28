@extends('layouts.dashboard-pasien')
@section('dashboard-content')
<x-table>
    <thead>
        <th>No</th>
        <th>Tanggal Periksa</th>
        @if($profil->status_menikah == 'menikah')
            <th>Riwayat Persalinan</th>
        @endif
        <th style="min-width: 170px">anamnesa (S)</th>
        <th style="min-width: 170px">Pemeriksaan (O)</th>
        <th style="min-width: 170px">Diagnosa (A)</th>
        <th style="min-width: 170px">Tindakan (P)</th>
    </thead>

    <tbody>
        @foreach ($rekamMedis as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                @if($profil->status_menikah == 'menikah')
                
                    <td>
                        @if($item->id_rm_kandungan)
                        G: {{ $item->riwayat_persalinan->g }}
                        P: {{ $item->riwayat_persalinan->p }}
                        A: {{ $item->riwayat_persalinan->a }}
                        @else
                            -
                        @endif
                    </td>
                @endif
                <td>{{ $item->anamnesa }}</td>
                <td>
                    @if($item->id_pemeriksaan)
                    <dl>
                        <dt>Pemeriksaan</dt>
                        <dd>{!! $item->pemeriksaan->deskripsi !!}</dd>
                        <dt>File Pemeriksaan</dt>
                        <dd>
                            @if($item->pemeriksaan->file_pemeriksaan)
                                <a href="{{asset('file/pemeriksaan/'.$item->pemeriksaan->file_pemeriksaan)}}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                            
                        </dd>
                    </dl>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($item->id_diagnosa)
                    <dl>
                        <dt>Diagnosa</dt>
                        <dd>{!! $item->diagnosa->deskripsi !!}</dd>
                        <dt>File Diagnosa</dt>
                        <dd>
                            @if($item->diagnosa->file_diagnosa)
                                <a href="{{asset('file/diagnosa/'.$item->diagnosa->file_diagnosa)}}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                            
                        </dd>
                    </dl>
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($item->id_tindakan)
                    <dl>
                        <dt>Tindakan</dt>
                        <dd>{!! $item->tindakan->deskripsi !!}</dd>
                        <dt>File Tindakan</dt>
                        <dd>
                            @if($item->tindakan->file_tindakan)
                                <a href="{{asset('file/tindakan/'.$item->tindakan->file_tindakan)}}" target="_blank">Lihat</a>
                            @else
                                -
                            @endif
                            
                        </dd>
                    </dl>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table>
@endsection