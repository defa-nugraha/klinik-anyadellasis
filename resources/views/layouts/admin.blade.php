<x-loader/>
<!doctype html>
<html lang="en">
  
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>REKAM MEDIS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="https://klinikanyadellasis.com/logo-klinik-anyadellasis.png" />
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}" />
  <link href="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <style>
      body{
        background-color: aliceblue
      }
    </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="" class="text-nowrap logo-img">
            <img src="{{asset('img/logo.png')}}" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Pelayanan</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/pasien*') ? 'active' : '' }}" href="{{route('admin.pasien')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-user-injured"></i>
                </span>
                <span class="hide-menu">Pasien</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/antrian*') ? 'active' : '' }}" href="{{route('admin.antrian')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-user-clock"></i>
                </span>
                <span class="hide-menu">Antrian</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/rekam_medis*') ? 'active' : '' }}" href="{{route('admin.rekam_medis')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-file-medical"></i>
                </span>
                <span class="hide-menu">Rekam Medis</span>
              </a>
            </li>
            

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Apotek</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/obat') ? 'active' : '' }}" href="{{route('admin.obat')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-pills"></i>
                </span>
                <span class="hide-menu">Data Obat</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/obat/resep*') ? 'active' : '' }}" href="{{route('admin.obat.resep')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-prescription-bottle-alt"></i>
                </span>
                <span class="hide-menu">Resep & Pemberian Obat</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/obat-keluar*') ? 'active' : '' }}" href="{{route('admin.obat-keluar')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-prescription-bottle-alt"></i>
                </span>
                <span class="hide-menu">Riwayat Keluar Obat</span>
              </a>
            </li>


            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Master Data</span>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/petugas*') ? 'active' : '' }}" href="{{route('admin.petugas')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-users"></i>
                </span>
                <span class="hide-menu">Petugas</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/dokter*') ? 'active' : '' }}" href="{{route('admin.dokter')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-stethoscope"></i>
                </span>
                <span class="hide-menu">Dokter</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/jadwal-dokter*') ? 'active' : '' }}" href="{{route('admin.jadwal-dokter')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-calendar-check"></i>
                </span>
                <span class="hide-menu">Jadwal Dokter</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/poli*') ? 'active' : '' }}" href="{{route('admin.poli')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-hospital-user"></i>
                </span>
                <span class="hide-menu">Poli</span>
              </a>
            </li>

            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/icd*') ? 'active' : '' }}" href="{{route('admin.icd')}}" aria-expanded="false">
                <span>
                  <i class="fa fa-book-medical"></i>
                </span>
                <span class="hide-menu">ICD</span>
              </a>
            </li>

            
            
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item">
                <span>Hai, <strong>{{ Auth::user()->name }}</strong></span>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('img/profil/'.Auth::user()->foto) }}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="{{route('admin.profil')}}" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </div>
                </div>
              </li>

              
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <x-alert/>
        @yield('content')
      </div>
    </div>
  </div>
  <script src="{{asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{asset('assets/js/sidebarmenu.js') }}"></script>
  <script src="{{asset('assets/js/app.min.js') }}"></script>
  <script src="{{asset('assets/libs/simplebar/dist/simplebar.js') }}"></script>
  <script src="https://cdn.datatables.net/v/dt/dt-2.1.3/datatables.min.js"></script>
  @include('sweetalert::alert')
  <script>
    // datatables
    $(document).ready(function () {
      $('#table').DataTable();
    });
  </script>
</body>

</html>