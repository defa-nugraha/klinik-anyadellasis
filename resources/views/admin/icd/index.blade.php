@extends('layouts.admin')
@section('content')
    <div class="mt-2 mb-3">
        <x-tambah-data action="{{route('admin.icd.create')}}" >
            <x-input-type type="text" name="code" label="Kode ICD" required="true"/>
            <x-input-type type="text" name="description" label="Deksripsi ICD" required="true"/>
            <x-input-type type="text" name="category" label="Kategori ICD (ex. Neoplasms)" required="true"/>
            <x-input-type type="text" name="type" label="Type ICD (ex. ICD-10)" required="true"/>
        </x-tambah-data>
    </div>

    <x-card title="Data ICD">
        <x-table>
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th>Type</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($icd as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->category }}</td>
                        <td>{{ $item->type }}</td>
                        <td>
                            <x-actions id="{{ $item->id }}" routeEdit="{{ route('admin.icd.update') }}" routeDelete="{{ route('admin.icd.delete', encryptStr($item->id)) }}">
                                <input type="hidden" name="id" value="{{encryptStr($item->id)}}">
                                <x-input-type-value value="{{$item->code}}" type="text" name="code" label="Kode ICD" required="true"/>
                                <x-input-type-value value="{{$item->description}}" type="text" name="description" label="Deksripsi ICD" required="true"/>
                                <x-input-type-value value="{{$item->category}}" type="text" name="category" label="Kategori ICD (ex. Neoplasms)" required="true"/>
                                <x-input-type-value value="{{$item->type}}" type="text" name="type" label="Type ICD (ex. ICD-10)" required="true"/>
                            </x-actions>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection