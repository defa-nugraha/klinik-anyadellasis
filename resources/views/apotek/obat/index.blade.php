@extends('layouts.apotek')
@section('content')
    <div class="mb-3">
        <x-tambah-data action="{{route('apotek.obat.create')}}" >
            <x-input-type type="text" name="kode" label="Kode Obat" required="true"/>
            <x-input-type type="text" name="nama" label="Nama Obat" required="true"/>
            <x-input-type type="text" name="satuan" label="Satuan" required="true"/>
            <x-input-type type="number" name="stok" label="Stok" required="true"/>
            <x-input-rupiah type="text" value="" name="harga" label="Harga" required="true"/>
            <x-select name="bpjs" label="Untk BPJS">
                <option value="1">Ya</option>
                <option value="0">Tidak</option>
            </x-select>
        </x-tambah-data>
    </div>

    <x-card title="Data Obat">
        <x-table>
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Obat</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Untuk BPJS</th>
                <th></th>
            </thead>

            <tbody>
                @foreach($obat as $o)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><span class="badge bg-warning">{{ $o->kode }}</span></td>
                        <td>{{ $o->nama }}</td>
                        <td>{{ $o->satuan }}</td>
                        <td>{{ $o->stok }}</td>
                        <td>{{ formatRupiah($o->harga) }}</td>
                        <td>{{ ($o->bpjs) ? 'Ya':'Tidak' }}</td>
                        <td>
                            <x-actions id="{{$o->id}}" routeDelete="{{route('apotek.obat.delete', encryptStr($o->id))}}" routeEdit="{{route('apotek.obat.update')}}">
                                <input type="hidden" name="id" value="{{encryptStr($o->id)}}">
                                <x-input-type-value value="{{$o->kode}}" type="text" name="kode" label="Kode Obat" required="true"/>
                                <x-input-type-value value="{{$o->nama}}" type="text" name="nama" label="Nama Obat" required="true"/>
                                <x-input-type-value value="{{$o->satuan}}" type="text" name="satuan" label="Satuan" required="true"/>
                                <x-input-type-value value="{{$o->stok}}" type="number" name="stok" label="Stok" required="true"/>
                                <x-input-rupiah type="text" value="{{formatRupiah($o->harga, false)}}" name="harga" label="Harga" required="true"/>
                                <x-select name="bpjs" label="Untk BPJS">
                                    <option value="1" {{($o->bpjs) ? 'selected' : ''}}>Ya</option>
                                    <option value="0" {{($o->bpjs) ? '' : 'selected'}}>Tidak</option>
                                </x-select>
                            </x-actions>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-table>
    </x-card>
@endsection