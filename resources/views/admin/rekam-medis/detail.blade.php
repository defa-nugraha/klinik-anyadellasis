@extends('layouts.admin')
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.css">
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">Detail Pasien</h4>
                    <span class="text-muted">RM# {{$pasien->no_rm}}</span>
                </div>
                <hr>
                
                <!-- Responsive Grid -->
                <div class="row">
                    <!-- Detail Pasien -->
                    <div class="col-md-4">
                        <h5><i class="fas fa-user"></i> Detail Pasien</h5>
                        <dl>
                            <dt><i class="fas fa-user"></i> Nama</dt>
                            <dd>{{$pasien->user->name}}, {{$pasien->gender}} ({{$pasien->status_menikah}})</dd>
                            <dt><i class="fas fa-calendar-alt"></i> Tempat, Tanggal Lahir</dt>
                            <dd>{{$pasien->tempat_lahir}}, {{$pasien->tanggal_lahir}}</dd>
                            <dt><i class="fas fa-briefcase"></i> Pekerjaan, Pendidikan</dt>
                            <dd>{{$pasien->pekerjaan}}, {{$pasien->pendidikan}}</dd>
                            <dt><i class="fas fa-map-marker-alt"></i> Alamat</dt>
                            <dd>{{$pasien->alamat}}</dd>
                        </dl>
                    </div>
                    
                    <!-- Info Pasien -->
                    <div class="col-md-4">
                        <h5><i class="fas fa-info-circle"></i> Info Pasien</h5>
                        <dl>
                            <dt><i class="fas fa-phone-alt"></i> No HP</dt>
                            <dd>{{$pasien->no_hp}}</dd>
                            <dt><i class="fas fa-id-card"></i> No BPJS/KTP</dt>
                            <dd>{{$pasien->no_bpjs}}</dd>
                            <dt><i class="fas fa-credit-card"></i> Pembayaran</dt>
                            <dd>{{$pasien->jenis_pembayaran}}</dd>
                            <dt><i class="fas fa-exclamation-triangle"></i> Alergi</dt>
                            <dd>{{$pasien->alergi}}</dd>
                        </dl>
                    </div>

                    <!-- Detail Suami/Istri (Jika Menikah) -->
                    @if ($pasien->status_menikah == 'menikah')
                        <div class="col-md-4">
                            <h5><i class="fas fa-heart"></i> Detail {{$pasien->gender == 'laki-laki' ? 'Istri' : 'Suami'}}</h5>
                            <dl>
                                <dt><i class="fas fa-user"></i> Nama</dt>
                                <dd>{{$suamiIstri->nama}}</dd>
                                <dt><i class="fas fa-phone-alt"></i> No HP</dt>
                                <dd>{{$suamiIstri->no_hp}}</dd>
                                <dt><i class="fas fa-id-card"></i> No BPJS/KTP</dt>
                                <dd>{{$suamiIstri->no_bpjs}}</dd>
                                <dt><i class="fas fa-calendar-alt"></i> Tempat, Tanggal Lahir</dt>
                                <dd>{{$suamiIstri->tempat_lahir}}, {{$suamiIstri->tanggal_lahir}}</dd>
                                <dt><i class="fas fa-briefcase"></i> Pekerjaan, Pendidikan</dt>
                                <dd>{{$suamiIstri->pekerjaan}}, {{$suamiIstri->pendidikan}}</dd>
                            </dl>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Rekam Medis Pasien</h4>
                @if($statusRekamMedis)
                    @if($statusRekamMedis->status == 'antrian')
                        <a href="{{route('admin.rekam_medis.update-status').'?rekam_medis='.encryptStr($statusRekamMedis->id).'&status=pemeriksaan'}}" class="btn btn-primary">Lanjutkan ke dokter <i class="fas fa-chevron-right"></i></a>
                    @elseif($statusRekamMedis->status == 'pemeriksaan')
                        <a href="{{route('admin.rekam_medis.update-status').'?rekam_medis='.encryptStr($statusRekamMedis->id).'&status=di apotek'}}" class="btn btn-primary">Selesaikan pemeriksaan & perawatan <i class="fas fa-chevron-right"></i></a>
                    @elseif($statusRekamMedis->status == 'di apotek')
                        <a href="{{route('admin.rekam_medis.update-status').'?rekam_medis='.encryptStr($statusRekamMedis->id).'&status=selesai'}}" class="btn btn-primary">Selesaikan rekam medis ini <i class="fas fa-chevron-right"></i></a>
                    @endif
                @endif
            </div>
            <x-table>
                <thead>
                    <th>No</th>
                    <th>Tanggal Periksa</th>
                    @if($pasien->status_menikah == 'menikah')
                        <th>Riwayat Persalinan</th>
                    @endif
                    <th style="min-width: 170px">Anamnesa (S)</th>
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
                            @if($pasien->status_menikah == 'menikah')
                            
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
                                    <dd>
                                        {{ getDiagnosa($item->id_diagnosa)?:'-' }}
                                    </dd>
                                    <dt>Catatan</dt>
                                    <dd>
                                        {!! $item->diagnosa->deskripsi?:'-' !!}
                                    </dd>
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
                                            <!-- Tombol untuk membuka modal Diagnosa -->
                                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalDiagnosa{{$item->id}}">
                                                <i class="fa fa-pencil"></i> Assessment
                                            </button>

                                            <!-- Modal Diagnosa -->
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
                                                                <div class="mb-3">
                                                                    <label for="diagnosa" class="form-label">ICD</label>
                                                                    <input type="text" class="form-control" placeholder="Pilih ICD" id="diagnosa" data-bs-toggle="modal" data-bs-target="#modalICD{{$item->id}}" data-bs-dismiss="modal">
                                                                    <div id="icd" class="row mt-2">

                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="diagnosa-editor" class="form-label">Catatan</label>
                                                                    <textarea id="diagnosa-editor" name="diagnosa" class="form-control mb-3">{{($item->diagnosa) ? $item->diagnosa->deskripsi : ''}}</textarea>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <x-input-type type="file" name="file_diagnosa" label="File (optional)" required=""/>
                                                                </div>
                                                                <button class="btn btn-primary mt-3">SIMPAN</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal ICD -->
                                            <div class="modal fade" id="modalICD{{$item->id}}" tabindex="-1" aria-labelledby="modalICDLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalICDLabel">Pilih ICD</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <x-table>
                                                                <thead>
                                                                    <th>Pilih</th>
                                                                    <th>KODE</th>
                                                                    <th>KATEGORI</th>
                                                                    <th>DESKRIPSI</th>
                                                                    <th>TYPE</th>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($icd as $i)
                                                                        <tr>
                                                                            <td>
                                                                                <button onclick="pilihICD(this)" data-id="{{encryptStr($i->id)}}" data-name="{{$i->code}} - {{$i->category}}" class="btn btn-primary" data-bs-target="#modalDiagnosa{{$item->id}}" data-bs-toggle="modal" data-bs-dismiss="modal">Pilih</button>
                                                                            </td>
                                                                            <td>{{$i->code}}</td>
                                                                            <td>{{$i->category}}</td>
                                                                            <td>{{$i->description}}</td>
                                                                            <td>{{$i->type}}</td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </x-table>
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
        </div>
    </div>

    
@endsection


<script>
    function pilihICD(e){
        let data = $(e).data();
        let id = data.id;
        let name = data.name;
        
        let icd = $('#icd');
        icd.append(
            `
                <div class="col-3">
                    <input type="text" class="form-control bg-primary text-white" value="${name}" readonly> 
                    <input type="hidden" name="icd[]" class="form-control bg-primary text-white" value="${id}" readonly> 
                </div>
            `
        );
    }
</script>

<!-- Page Specific JS File -->
<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.0.0/"
        }
    }
</script>
<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font, Image ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
    } );
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#diagnosa-editor' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font, Image ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
    } );
</script>

<script type="module">
    import {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } from 'ckeditor5';
    ClassicEditor
        .create( document.querySelector( '#tindakan-editor' ), {
            plugins: [ Essentials, Paragraph, Bold, Italic, Font, Image ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
    } );
</script>

<!-- A friendly reminder to run on a server, remove this during the integration. -->
<script>
    window.onload = function() {
        if ( window.location.protocol === 'file:' ) {
            alert( 'This sample requires an HTTP server. Please serve this file with a web server.' );
        }
    };
</script>
