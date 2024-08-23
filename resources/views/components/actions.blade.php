<div class="row">
    <div class="col-auto p-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{$id}}">
            <i class="fa fa-edit"></i>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="editModal{{$id}}" tabindex="-1" aria-labelledby="editModal{{$id}}Label" aria-hidden="true">
            <div class="modal-dialog">
            <form action="{{$routeEdit}}" class="form-group" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="modal-title fs-5" id="editModal{{$id}}Label">Edit Data</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                    {{$slot}}
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    @if($routeDelete)
        <div class="col-auto p-2">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$id}}">
                <i class="fa fa-trash"></i>
            </button>

            <div class="modal fade" id="deleteModal{{$id}}" tabindex="-1" aria-labelledby="deleteModal{{$id}}Label" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h3 class="modal-title fs-5" id="deleteModal{{$id}}Label">Hapus Data</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong>Apakah anda Yakin?</strong>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete{{$id}}').submit();">YA</button>
                    </div>
                </div>
                </div>
            </div>
            <form id="delete{{$id}}" action="{{$routeDelete}}" method="POST" class="d-none">
                @csrf
                @method('delete')
            </form>
        </div>
    @endif
</div>