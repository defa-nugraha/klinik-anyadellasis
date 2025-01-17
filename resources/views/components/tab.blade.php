<div class="d-none d-md-block">
    <ul class="nav nav-tabs mt-4 flex-column flex-md-row">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" aria-current="page" href="{{route('pasien.dashboard')}}">Informasi Pasien</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('riwayat/pendaftaran*') ? 'active' : '' }}" href="{{route('pasien.pendaftaran')}}">Riwayat Pendaftaran</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('riwayat/rekam-medis*') ? 'active' : '' }}" href="{{route('pasien.rekam-medis')}}">Riwayat Rekam Medis</a>
        </li>
    </ul>
</div>

<div class="d-md-none">
    <h3>Informasi Pasien</h3>
</div>