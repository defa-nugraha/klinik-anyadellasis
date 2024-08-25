@extends('layouts.admin')

@section('content')
    <div class="mb-3">
        <x-tambah-data action="{{route('admin.poli.create')}}" >
            <x-input-type type="text" name="name" label="Nama Poli" required="true"/>
        </x-tambah-data>
    </div>

    <x-card title="Data Poli">
        <x-table>
            <thead>
                <th>No</th>
                <th>Poli</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($poli as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->name }}</td>
                        <td>
                            <x-actions id="{{$p->id}}" routeDelete="{{route('admin.poli.delete', encryptStr($p->id))}}" routeEdit="{{route('admin.poli.update')}}">
                                <input type="hidden" name="id" value="{{encryptStr($p->id)}}">
                                <x-input-type-value value="{{$p->name}}" type="text" name="name" label="Nama Poli" required="true"/>
                            </x-actions>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection