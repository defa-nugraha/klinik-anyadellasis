@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <x-tambah-data action="{{route('admin.petugas.create')}}" >
        <x-input-type type="text" name="name" label="Nama" required="true"/>
        <x-input-type type="email" name="email" label="Email" required="true"/>
        <x-input-type type="text" name="no_hp" label="No HP" required="true"/>
        <x-select name="role" label="Role" required="true">
            <option value="admin">Admin</option>
            <option value="doctor">Dokter</option>
            <option value="nurse">Nurse</option>
            <option value="patien">Pasien</option>
        </x-select>
        <label for="alamat">Alamat</label>
        <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required></textarea>
    </x-tambah-data>
</div>

<x-card title="Data Petugas">
    <x-table>
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No Hp</th>
            <th>Role</th>
            <th>Alamat</th>
            <th></th>
        </thead>
        
        <tbody>
            @foreach($petugas as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>
                        @if($p->role == 'admin')
                            <span class="badge bg-danger">{{ $p->role }}</span>
                        @elseif($p->role == 'doctor')
                            <span class="badge bg-success">{{ $p->role }}</span>
                        @elseif($p->role == 'nurse')
                            <span class="badge bg-primary">{{ $p->role }}</span>
                        @elseif($p->role == 'patient')
                            <span class="badge bg-muted">pasien</span>
                        @endif
                    </td>
                    <td>{{ $p->alamat }}</td>
                    <td>
                        <x-actions id="{{ $p->id }}" routeDelete="{{route('admin.petugas.delete', encryptStr($p->id))}}" routeEdit="{{route('admin.petugas.update')}}">
                            <input type="hidden" value="{{encryptStr($p->id)}}" name="id">
                            <x-input-type-value value="{{$p->name}}" type="text" name="name" label="Nama" required="true"/>
                            <x-input-type-value value="{{$p->email}}" type="email" name="email" label="Email" required="true"/>
                            <x-input-type-value value="{{$p->no_hp}}" type="text" name="no_hp" label="No HP" required="true"/>
                            <x-select name="role" label="Role" required="true">
                                <option value="admin" {{$p->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                <option value="doctor" {{$p->role == 'doctor' ? 'selected' : ''}}>Dokter</option>
                                <option value="nurse" {{$p->role == 'nurse' ? 'selected' : ''}}>Nurse</option>
                                <option value="patient" {{$p->role == 'patient' ? 'selected' : ''}}>Pasien</option>
                            </x-select>
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="3" class="form-control" required>{{$p->alamat}}</textarea>
                        </x-actions>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-table>
</x-card>
@endsection