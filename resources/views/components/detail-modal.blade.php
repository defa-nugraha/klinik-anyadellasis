  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{$id}}">
    <i class="fa fa-eye"></i>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="detailModal{{$id}}" tabindex="-1" aria-labelledby="detailModal{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="detailModal{{$id}}Label">Detail</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{$slot}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
        </div>
      </div>
    </div>
  </div>