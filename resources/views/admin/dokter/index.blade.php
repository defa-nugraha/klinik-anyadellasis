@extends('layouts.admin')
@section('content')
    <div class="mb-3">
        <x-tambah-data action="{{route('admin.dokter.create')}}">
            <x-select name="user" label="Petugas">
                @foreach($users as $u)
                    <option value="{{encryptStr($u->id)}}">{{$u->name}}</option>
                @endforeach
            </x-select>
            <x-select name="poli" label="Poli">
                @foreach($poli as $p)
                    <option value="{{encryptStr($p->id)}}}">{{$p->name}}</option>
                @endforeach
            </x-select>

            <x-input-type type="text" name="spesialis" label="Spesialisasi" required="true"/>
        </x-tambah-data>
    </div>

    <x-card title="Data Dokter">
        <x-table>
            <thead>
                <th>No</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Spesialis</th>
                <th>Foto</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($dokter as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <dl>
                                <dt>Nama</dt>
                                <dd>{{ $d->user->name }}</dd>
                                <dt>No Hp</dt>
                                <dd>{{ $d->user->no_hp }}</dd>
                                <dt>Alamat</dt>
                                <dd>{{ $d->user->alamat }}</dd>
                            </dl>
                        </td>
                        <td>{{ $d->poli->name }}</td>
                        <td>{{ $d->spesialis }}</td>
                        <td>
                            <img src="{{asset('img/profil/'.$d->user->foto)}}" class="rounded" width="100px" alt="">
                        </td>
                        <td>
                            <x-actions id="{{$d->id}}" routeDelete="{{route('admin.dokter.delete', encryptStr($d->id))}}" routeEdit="{{route('admin.dokter.update')}}">
                                <input type="hidden" name="id" value="{{encryptStr($d->id)}}">
                                <x-select name="user" label="Petugas">
                                    @foreach($users as $u)
                                        <option value="{{encryptStr($u->id)}}" {{$d->id_user == $u->id ? 'selected' : ''}}>{{$u->name}}</option>
                                    @endforeach
                                </x-select>
                                <x-select name="poli" label="Poli">
                                    @foreach($poli as $p)
                                        <option value="{{encryptStr($p->id)}}" {{$d->id_poli == $p->id ? 'selected' : ''}}>{{$p->name}}</option>
                                    @endforeach
                                </x-select>
                    
                                <x-input-type-value value="{{$d->spesialis}}" type="text" name="spesialis" label="Spesialisasi" required="true"/>
                            </x-actions>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection