@extends('layouts.admin')

@section('content')
    <div class="mb-3">
        <x-tambah-data action="{{route('admin.antrian.create')}}" >
            <x-select name="pasien" label="Pasien" required="true">
                @foreach($pasien as $p)
                    <option value="{{encryptStr($p->id)}}">{{$p->user->name}}</option>
                @endforeach
            </x-select>
            <x-select name="poli" label="Poli" required="true">
                @foreach($poli as $p)
                    <option value="{{encryptStr($p->id)}}">{{$p->name}}</option>
                @endforeach
            </x-select>
            <x-select name="dokter" label="Dokter" required="true">
                @foreach($dokter as $d)
                    <option value="{{encryptStr($d->id)}}">{{$d->user->name}}</option>
                @endforeach
            </x-select>
            <x-input-type-value type="date" label="Tanggal Periksa" value="{{date('Y-m-d')}}" name="tanggal_periksa" required="true"/>
        </x-tambah-data>
    </div>

    <x-card title="Data Antrian Hari Ini - {{date('Y-m-d')}}">
        <x-table>
            <thead>
                <th>Pasien</th>
                <th>Antrian</th>
                <th>Tujuan</th>
                <th></th>
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
                                <dt>No. Antrian</dt>
                                <dd><span class="badge bg-warning">{{$a->no_antrian}}</span></dd>
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
                        <td>
                            <div class="row">
                                <div class="col-auto">
                                    @if($a->status == 'antri')
                                        <a href="{{route('admin.antrian.proses', encryptStr($a->id))}}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Proses
                                        </a>
                                    @else 
                                        <span class="btn btn-sm btn-success">Telah Diproses</span>
                                    @endif
                                </div>

                                <div class="col-auto">
                                    <x-delete id="{{$a->id}}" route="{{route('admin.antrian.delete', encryptStr($a->id))}}" />
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection