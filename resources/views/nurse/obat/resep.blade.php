@extends('layouts.nurse')

@section('content')
    <x-card title="Resep dan Pemberian Obat">
        <x-table>
            <thead>
                <th>No</th>
                <th>Tanggal Periksa</th>
                <th>Diagnosa</th>
                <th>Tindakan</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($resep as $r)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$r->tgl_pemeriksaan}}</td>
                        <td>
                            @if($r->id_diagnosa)
                            <dl>
                                <dt>Diagnosa</dt>
                                <dd>
                                    {{ getDiagnosa($r->id_diagnosa)?:'-' }}
                                </dd>
                                <dt>Catatan</dt>
                                <dd>
                                    {!! $r->diagnosa->deskripsi?:'-' !!}
                                </dd>
                                <dt>File Diagnosa</dt>
                                <dd>
                                    @if($r->diagnosa->file_diagnosa)
                                        <a href="{{asset('file/diagnosa/'.$r->diagnosa->file_diagnosa)}}" target="_blank">Lihat</a>
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
                            @if($r->id_tindakan)
                                <dl>
                                    <dt>Tindakan</dt>
                                    <dd>{!! $r->tindakan->deskripsi !!}</dd>
                                    <dt>File Tindakan</dt>
                                    <dd>
                                        @if($r->tindakan)
                                            @if($r->tindakan->file_tindakan)
                                                <a href="{{asset('file/tindakan/'.$r->tindakan->file_tindakan)}}" target="_blank">Lihat</a>
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </dd>
                                </dl>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{route('nurse.obat.resep.create', encryptStr($r->id))}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-edit"></i> Proses
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection