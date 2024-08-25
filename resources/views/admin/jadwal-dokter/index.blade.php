@extends('layouts.admin')
@section('content')
    <div class="mb-3">
        <x-tambah-data action="{{route('admin.jadwal-dokter.create')}}" >
            <x-select name="id_dokter" label="Dokter" required="true">
                @foreach($dokter as $d)
                    <option value="{{$d->id}}">{{$d->user->name}}</option>
                @endforeach
            </x-select>

            <x-select name="hari" label="Hari" required="true">
                <option value="senin">Senin</option>
                <option value="selasa">Selasa</option>
                <option value="rabu">Rabu</option>
                <option value="kamis">Kamis</option>
                <option value="jumat">Jumat</option>
                <option value="sabtu">Sabtu</option>
                <option value="minggu">Minggu</option>
            </x-select>
            
            <x-input-type type="time" name="jam_mulai" label="Jam Mulai" required="true"/>
            <x-input-type type="time" name="jam_selesai" label="Jam Selesai" required="true"/>
        </x-tambah-data>
    </div>

    <x-card title="Data Jadwal Dokter">
        <x-table>
            <thead>
                <th>No</th>
                <th>Dokter</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($jadwal as $j)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$j->dokter->user->name}}</td>
                        <td>{{$j->hari}}</td>
                        <td>{{$j->jam_mulai}}</td>
                        <td>{{$j->jam_selesai}}</td>
                        <td>
                            <x-actions id="{{$j->id}}" routeDelete="{{route('admin.jadwal-dokter.delete', encryptStr($j->id))}}" routeEdit="{{route('admin.jadwal-dokter.update')}}">
                                <input type="hidden" name="id" value="{{encryptStr($j->id)}}">
                                
                                <x-select name="id_dokter" label="Dokter" required="true">
                                    @foreach($dokter as $d)
                                        <option value="{{$d->id}}" {{$j->id_dokter == $d->id ? 'selected' : ''}}>{{$d->user->name}}</option>
                                    @endforeach
                                </x-select>
                    
                                <x-select name="hari" label="Hari" required="true">
                                    <option value="senin" {{$j->hari == 'senin' ? 'selected' : ''}}>Senin</option>
                                    <option value="selasa" {{$j->hari == 'selasa' ? 'selected' : ''}}>Selasa</option>
                                    <option value="rabu" {{$j->hari == 'rabu' ? 'selected' : ''}}>Rabu</option>
                                    <option value="kamis" {{$j->hari == 'kamis' ? 'selected' : ''}}>Kamis</option>
                                    <option value="jumat" {{$j->hari == 'jumat' ? 'selected' : ''}}>Jumat</option>
                                    <option value="sabtu" {{$j->hari == 'sabtu' ? 'selected' : ''}}>Sabtu</option>
                                    <option value="minggu" {{$j->hari == 'minggu' ? 'selected' : ''}}>Minggu</option>
                                </x-select>

                                <x-input-type-value value="{{$j->hari}}" type="text" name="hari" label="Hari" required="true"/>
                                <x-input-type-value value="{{$j->jam_mulai}}" type="time" name="jam_mulai" label="Jam Mulai" required="true"/>
                                <x-input-type-value value="{{$j->jam_selesai}}" type="time" name="jam_selesai" label="Jam Selesai" required="true"/>
                            </x-actions>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection