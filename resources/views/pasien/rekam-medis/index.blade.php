@extends('layouts.dashboard-pasien')
@section('dashboard-content')
<x-table>
    <thead>
        <th>No</th>
        <th>Tanggal Periksa</th>
        @if($profil->status_menikah == 'menikah')
            <th>Riwayat Persalinan</th>
        @endif
        <th style="min-width: 170px">Ammanesia (S)</th>
        <th style="min-width: 170px">Pemeriksaan (O)</th>
        <th style="min-width: 170px">Diagnosa (A)</th>
        <th style="min-width: 170px">Tindakan (P)</th>
        <th></th>
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
                <td>{{ $item->ammanesia }}</td>
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
                <td>
                    @if($item->status != 'selesai')
                        <div class="row">
                            <div class="col-auto p-2">
                                <button class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#modalPemeriksaan{{$item->id}}">
                                    <i class="fa fa-pencil"></i> Objeck
                                </button>
                                <!-- Modal untuk isi pemeriksaan -->
                                <div class="modal fade" id="modalPemeriksaan{{$item->id}}" tabindex="-1" aria-labelledby="modalPemeriksaan{{$item->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalPemeriksaan{{$item->id}}Label">Pemeriksaan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.pemeriksaan.createOrUpdate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="rekam_medis" value="{{encryptStr($item->id)}}">
                                                    <label for="pemeriksaan" class="form-label">Pemeriksaan*</label>
                                                    <textarea id="editor" name="pemeriksaan" class="form-control mb-3">{{($item->pemeriksaan) ? $item->pemeriksaan->deskripsi : ''}}</textarea>
                                                    <div class="mt-3">
                                                        <x-input-type type="file" name="file_pemeriksaan" label="File (optional)" required=""/>
                                                    </div>

                                                    <button class="btn btn-primary mt-3">SIMPAN</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto p-2">
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDiagnosa{{$item->id}}">
                                    <i class="fa fa-pencil"></i> Assessment
                                </button>

                                <!-- Modal untuk isi diagnosa -->
                                <div class="modal fade" id="modalDiagnosa{{$item->id}}" tabindex="-1" aria-labelledby="modalDiagnosa{{$item->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalDiagnosa{{$item->id}}Label">Diagnosa</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.diagnosa.createOrUpdate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="rekam_medis" value="{{encryptStr($item->id)}}">
                                                    <label for="diagnosa" class="form-label">Diagnosa*</label>
                                                    <textarea id="diagnosa-editor" name="diagnosa" class="form-control mb-3">{{($item->diagnosa) ? $item->diagnosa->deskripsi : ''}}</textarea>
                                                    <div class="mt-3">
                                                        <x-input-type type="file" name="file_diagnosa" label="File (optional)" required=""/>
                                                    </div>

                                                    <button class="btn btn-primary mt-3">SIMPAN</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto p-2">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTindakan{{$item->id}}">
                                    <i class="fa fa-pencil"></i> Plan
                                </button>

                                <!-- Modal untuk isi tindakan -->
                                <div class="modal fade" id="modalTindakan{{$item->id}}" tabindex="-1" aria-labelledby="modalTindakan{{$item->id}}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTindakan{{$item->id}}Label">Tindakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.tindakan.createOrUpdate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="rekam_medis" value="{{encryptStr($item->id)}}">
                                                    <label for="tindakan" class="form-label">Tindakan*</label>
                                                    <textarea id="tindakan-editor" name="tindakan" class="form-control mb-3">{{($item->tindakan) ? $item->tindakan->deskripsi : ''}}</textarea>
                                                    <div class="mt-3">
                                                        <x-input-type type="file" name="file_tindakan" label="File (optional)" required=""/>
                                                    </div>

                                                    <button class="btn btn-primary mt-3">SIMPAN</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else  
                        <a href="{{route('admin.obat-keluar.detail', encryptStr($item->id))}}" class="btn btn-sm btn-success">
                            <i class="fa fa-eye"></i> Obat
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table>
@endsection