<?php

use App\Http\Controllers\admin\AntrianAdminController;
use App\Http\Controllers\admin\DashboardAdminController;
use App\Http\Controllers\admin\DiagnosaAdminController;
use App\Http\Controllers\admin\DokterAdminController;
use App\Http\Controllers\admin\IstriAdminController;
use App\Http\Controllers\admin\JadwalDokterAdminController;
use App\Http\Controllers\admin\ObatAdminController;
use App\Http\Controllers\admin\ObatKeluarAdminController;
use App\Http\Controllers\admin\PasienAdminController;
use App\Http\Controllers\admin\PemeriksaanAdminController;
use App\Http\Controllers\admin\PendaftaranAdminController;
use App\Http\Controllers\admin\PetugasAdminController;
use App\Http\Controllers\admin\PoliAdminController;
use App\Http\Controllers\admin\RekamMedisAdminController;
use App\Http\Controllers\admin\RekamMedisKandunganAdminController;
use App\Http\Controllers\admin\SuamiAdminController;
use App\Http\Controllers\admin\TindakanAdminController;
use App\Http\Controllers\apotek\DashboardApotekController;
use App\Http\Controllers\apotek\ObatApotekController;
use App\Http\Controllers\apotek\ObatKeluarApotekController;
use App\Http\Controllers\dokter\DashboardDokterController;
use App\Http\Controllers\dokter\ObatDokterController;
use App\Http\Controllers\dokter\ObatKeluarDokterController;
use App\Http\Controllers\dokter\RekamMedisDokterController;
use App\Http\Controllers\dokter\RekamMedisKandunganDokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\nurse\AntrianNurseController;
use App\Http\Controllers\nurse\DashboardNurseController;
use App\Http\Controllers\nurse\ObatKeluarNurseController;
use App\Http\Controllers\nurse\ObatNurseController;
use App\Http\Controllers\nurse\PasienNurseController;
use App\Http\Controllers\nurse\RekamMedisNurseController;
use App\Models\PendaftaranModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::middleware('admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
            Route::get('/profil', [DashboardAdminController::class, 'index'])->name('admin.profil');

            Route::prefix('pasien')->group(function () {
                Route::get('/', [PasienAdminController::class, 'index'])->name('admin.pasien');
                Route::get('/create', [PasienAdminController::class, 'create'])->name('admin.pasien.create');
                Route::post('/store', [PasienAdminController::class, 'store'])->name('admin.pasien.store');
                Route::get('/{id}', [PasienAdminController::class, 'edit'])->name('admin.pasien.edit');
                Route::post('/update', [PasienAdminController::class, 'update'])->name('admin.pasien.update');
                Route::delete('/delete/{id}', [PasienAdminController::class, 'delete'])->name('admin.pasien.delete');
            });

            // pemeriksaan
            Route::prefix('pemeriksaan')->group(function () {
                Route::get('/', [PemeriksaanAdminController::class, 'index'])->name('admin.pemeriksaan');
                Route::post('/createOrUpdate', [PemeriksaanAdminController::class, 'createOrUpdate'])->name('admin.pemeriksaan.createOrUpdate');
                Route::post('/update', [PemeriksaanAdminController::class, 'update'])->name('admin.pemeriksaan.update');
                Route::delete('/delete/{id}', [PemeriksaanAdminController::class, 'delete'])->name('admin.pemeriksaan.delete');
            });

            // diagnosa
            Route::prefix('diagnosa')->group(function () {
                Route::get('/', [DiagnosaAdminController::class, 'index'])->name('admin.diagnosa');
                Route::post('/createOrUpdate', [DiagnosaAdminController::class, 'createOrUpdate'])->name('admin.diagnosa.createOrUpdate');
                Route::post('/update', [DiagnosaAdminController::class, 'update'])->name('admin.diagnosa.update');
                Route::delete('/delete/{id}', [DiagnosaAdminController::class, 'delete'])->name('admin.diagnosa.delete');
            });

            // dokter
            Route::prefix('dokter')->group(function () {
                Route::get('/', [DokterAdminController::class, 'index'])->name('admin.dokter');
                Route::post('/create', [DokterAdminController::class, 'create'])->name('admin.dokter.create');
                Route::post('/update', [DokterAdminController::class, 'update'])->name('admin.dokter.update');
                Route::delete('/delete/{id}', [DokterAdminController::class, 'delete'])->name('admin.dokter.delete');
            });

            // istri
            Route::prefix('istri')->group(function () {
                Route::get('/', [IstriAdminController::class, 'index'])->name('admin.istri');
                Route::post('/create', [IstriAdminController::class, 'create'])->name('admin.istri.create');
                Route::post('/update', [IstriAdminController::class, 'update'])->name('admin.istri.update');
                Route::delete('/delete/{id}', [IstriAdminController::class, 'delete'])->name('admin.istri.delete');
            });

            // suami
            Route::prefix('suami')->group(function () {
                Route::get('/', [SuamiAdminController::class, 'index'])->name('admin.suami');
                Route::post('/create', [SuamiAdminController::class, 'create'])->name('admin.suami.create');
                Route::post('/update', [SuamiAdminController::class, 'update'])->name('admin.suami.update');
                Route::delete('/delete/{id}', [SuamiAdminController::class, 'delete'])->name('admin.suami.delete');
            });

            // pendaftaran
            Route::prefix('pendaftaran')->group(function () {
                Route::get('/', [PendaftaranAdminController::class, 'index'])->name('admin.pendaftaran');
                Route::post('/create', [PendaftaranAdminController::class, 'create'])->name('admin.pendaftaran.create');
                Route::post('/update', [PendaftaranAdminController::class, 'update'])->name('admin.pendaftaran.update');
                Route::delete('/delete/{id}', [PendaftaranAdminController::class, 'delete'])->name('admin.pendaftaran.delete');
            });

            // poli
            Route::prefix('poli')->group(function () {
                Route::get('/', [PoliAdminController::class, 'index'])->name('admin.poli');
                Route::post('/create', [PoliAdminController::class, 'create'])->name('admin.poli.create');
                Route::post('/update', [PoliAdminController::class, 'update'])->name('admin.poli.update');
                Route::delete('/delete/{id}', [PoliAdminController::class, 'delete'])->name('admin.poli.delete');
            });

            // rekam_medis
            Route::prefix('rekam_medis')->group(function () {
                Route::get('/', [RekamMedisAdminController::class, 'index'])->name('admin.rekam_medis');
                Route::get('/create', [RekamMedisAdminController::class, 'create'])->name('admin.rekam_medis.create');
                Route::get('/create/{id_antrian}', [RekamMedisAdminController::class, 'createFromAntrian'])->name('admin.rekam_medis.createFromAntrian');
                Route::post('/store', [RekamMedisAdminController::class, 'store'])->name('admin.rekam_medis.store');
                Route::get('/edit', [RekamMedisAdminController::class, 'edit'])->name('admin.rekam_medis.edit');
                Route::post('/update', [RekamMedisAdminController::class, 'update'])->name('admin.rekam_medis.update');
                Route::get('/detail/{id}', [RekamMedisAdminController::class, 'detail'])->name('admin.rekam_medis.detail');
                Route::delete('/delete/{id}', [RekamMedisAdminController::class, 'delete'])->name('admin.rekam_medis.delete');
                Route::get('/update-status', [RekamMedisAdminController::class, 'updateStatus'])->name('admin.rekam_medis.update-status');
            });

            // rekam_medis_kandungan
            Route::prefix('rekam_medis_kandungan')->group(function () {
                Route::get('/', [RekamMedisKandunganAdminController::class, 'index'])->name('admin.rekam_medis_kandungan');
                Route::post('/create', [RekamMedisKandunganAdminController::class, 'create'])->name('admin.rekam_medis_kandungan.create');
                Route::post('/update', [RekamMedisKandunganAdminController::class, 'update'])->name('admin.rekam_medis_kandungan.update');
                Route::delete('/delete/{id}', [RekamMedisKandunganAdminController::class, 'delete'])->name('admin.rekam_medis_kandungan.delete');
            });

            // tindakan
            Route::prefix('tindakan')->group(function () {
                Route::get('/', [TindakanAdminController::class, 'index'])->name('admin.tindakan');
                Route::post('/createOrUpdate', [TindakanAdminController::class, 'createOrUpdate'])->name('admin.tindakan.createOrUpdate');
                Route::post('/update', [TindakanAdminController::class, 'update'])->name('admin.tindakan.update');
                Route::delete('/delete/{id}', [TindakanAdminController::class, 'delete'])->name('admin.tindakan.delete');
            });

            // jadwal-dokter
            Route::prefix('jadwal-dokter')->group(function () {
                Route::get('/', [JadwalDokterAdminController::class, 'index'])->name('admin.jadwal-dokter');
                Route::post('/create', [JadwalDokterAdminController::class, 'create'])->name('admin.jadwal-dokter.create');
                Route::post('/update', [JadwalDokterAdminController::class, 'update'])->name('admin.jadwal-dokter.update');
                Route::delete('/delete/{id}', [JadwalDokterAdminController::class, 'delete'])->name('admin.jadwal-dokter.delete');
            });

            // obat
            Route::prefix('obat')->group(function () {
                Route::get('/', [ObatAdminController::class, 'index'])->name('admin.obat');
                Route::post('/create', [ObatAdminController::class, 'create'])->name('admin.obat.create');
                Route::post('/update', [ObatAdminController::class, 'update'])->name('admin.obat.update');
                Route::delete('/delete/{id}', [ObatAdminController::class, 'delete'])->name('admin.obat.delete');
                Route::get('/resep/{id}', [ObatAdminController::class, 'createResep'])->name('admin.obat.resep.create');
                Route::get('/resep', [ObatAdminController::class, 'resep'])->name('admin.obat.resep');
                Route::post('/resep/store', [ObatAdminController::class, 'storeResep'])->name('admin.obat.storeResep');
            });

            // obat-keluar
            Route::prefix('obat-keluar')->group(function () {
                Route::get('/', [ObatKeluarAdminController::class, 'index'])->name('admin.obat-keluar');
                Route::post('/create', [ObatKeluarAdminController::class, 'create'])->name('admin.obat-keluar.create');
                Route::post('/update', [ObatKeluarAdminController::class, 'update'])->name('admin.obat-keluar.update');
                Route::delete('/delete/{id}', [ObatKeluarAdminController::class, 'delete'])->name('admin.obat-keluar.delete');
                Route::get('/detail/{id}', [ObatKeluarAdminController::class, 'detail'])->name('admin.obat-keluar.detail');
            });

            // petugas
            Route::prefix('petugas')->group(function () {
                Route::get('/', [PetugasAdminController::class, 'index'])->name('admin.petugas');
                Route::post('/create', [PetugasAdminController::class, 'create'])->name('admin.petugas.create');
                Route::post('/update', [PetugasAdminController::class, 'update'])->name('admin.petugas.update');
                Route::delete('/delete/{id}', [PetugasAdminController::class, 'delete'])->name('admin.petugas.delete');
            });

            // antrian
            Route::prefix('antrian')->group(function () {
                Route::get('/', [AntrianAdminController::class, 'index'])->name('admin.antrian');
                Route::post('/create', [AntrianAdminController::class, 'create'])->name('admin.antrian.create');
                Route::post('/update', [AntrianAdminController::class, 'update'])->name('admin.antrian.update');
                Route::delete('/delete/{id}', [AntrianAdminController::class, 'delete'])->name('admin.antrian.delete');
                Route::get('/proses/{id}', [AntrianAdminController::class, 'proses'])->name('admin.antrian.proses');
            });
        });


        Route::prefix('dokter')->group(function () {
            Route::get('/', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
            Route::get('/profil', [DashboardAdminController::class, 'index'])->name('dokter.profil');

            // pemeriksaan
            Route::prefix('pemeriksaan')->group(function () {
                Route::get('/', [PemeriksaanAdminController::class, 'index'])->name('dokter.pemeriksaan');
                Route::post('/createOrUpdate', [PemeriksaanAdminController::class, 'createOrUpdate'])->name('dokter.pemeriksaan.createOrUpdate');
                Route::post('/update', [PemeriksaanAdminController::class, 'update'])->name('dokter.pemeriksaan.update');
                Route::delete('/delete/{id}', [PemeriksaanAdminController::class, 'delete'])->name('dokter.pemeriksaan.delete');
            });

            // diagnosa
            Route::prefix('diagnosa')->group(function () {
                Route::get('/', [DiagnosaAdminController::class, 'index'])->name('dokter.diagnosa');
                Route::post('/createOrUpdate', [DiagnosaAdminController::class, 'createOrUpdate'])->name('dokter.diagnosa.createOrUpdate');
                Route::post('/update', [DiagnosaAdminController::class, 'update'])->name('dokter.diagnosa.update');
                Route::delete('/delete/{id}', [DiagnosaAdminController::class, 'delete'])->name('dokter.diagnosa.delete');
            });

            // rekam_medis
            Route::prefix('rekam_medis')->group(function () {
                Route::get('/', [RekamMedisDokterController::class, 'index'])->name('dokter.rekam_medis');
                Route::get('/create', [RekamMedisDokterController::class, 'create'])->name('dokter.rekam_medis.create');
                Route::get('/create/{id_antrian}', [RekamMedisDokterController::class, 'createFromAntrian'])->name('dokter.rekam_medis.createFromAntrian');
                Route::post('/store', [RekamMedisDokterController::class, 'store'])->name('dokter.rekam_medis.store');
                Route::get('/edit', [RekamMedisDokterController::class, 'edit'])->name('dokter.rekam_medis.edit');
                Route::post('/update', [RekamMedisDokterController::class, 'update'])->name('dokter.rekam_medis.update');
                Route::get('/detail/{id}', [RekamMedisDokterController::class, 'detail'])->name('dokter.rekam_medis.detail');
                Route::delete('/delete/{id}', [RekamMedisDokterController::class, 'delete'])->name('dokter.rekam_medis.delete');
                Route::get('/update-status', [RekamMedisDokterController::class, 'updateStatus'])->name('dokter.rekam_medis.update-status');
            });

            // rekam_medis_kandungan
            Route::prefix('rekam_medis_kandungan')->group(function () {
                Route::get('/', [RekamMedisKandunganDokterController::class, 'index'])->name('dokter.rekam_medis_kandungan');
                Route::post('/create', [RekamMedisKandunganDokterController::class, 'create'])->name('dokter.rekam_medis_kandungan.create');
                Route::post('/update', [RekamMedisKandunganDokterController::class, 'update'])->name('dokter.rekam_medis_kandungan.update');
                Route::delete('/delete/{id}', [RekamMedisKandunganDokterController::class, 'delete'])->name('dokter.rekam_medis_kandungan.delete');
            });

            // tindakan
            Route::prefix('tindakan')->group(function () {
                Route::get('/', [TindakanAdminController::class, 'index'])->name('dokter.tindakan');
                Route::post('/createOrUpdate', [TindakanAdminController::class, 'createOrUpdate'])->name('dokter.tindakan.createOrUpdate');
                Route::post('/update', [TindakanAdminController::class, 'update'])->name('dokter.tindakan.update');
                Route::delete('/delete/{id}', [TindakanAdminController::class, 'delete'])->name('dokter.tindakan.delete');
            });

            // obat
            Route::prefix('obat')->group(function () {
                Route::get('/', [ObatDokterController::class, 'index'])->name('dokter.obat');
                Route::post('/create', [ObatDokterController::class, 'create'])->name('dokter.obat.create');
                Route::post('/update', [ObatDokterController::class, 'update'])->name('dokter.obat.update');
                Route::delete('/delete/{id}', [ObatDokterController::class, 'delete'])->name('dokter.obat.delete');
                Route::get('/resep/{id}', [ObatDokterController::class, 'createResep'])->name('dokter.obat.resep.create');
                Route::get('/resep', [ObatDokterController::class, 'resep'])->name('dokter.obat.resep');
                Route::post('/resep/store', [ObatDokterController::class, 'storeResep'])->name('dokter.obat.storeResep');
            });

            // obat-keluar
            Route::prefix('obat-keluar')->group(function () {
                Route::get('/', [ObatKeluarDokterController::class, 'index'])->name('dokter.obat-keluar');
                Route::post('/create', [ObatKeluarDokterController::class, 'create'])->name('dokter.obat-keluar.create');
                Route::post('/update', [ObatKeluarDokterController::class, 'update'])->name('dokter.obat-keluar.update');
                Route::delete('/delete/{id}', [ObatKeluarDokterController::class, 'delete'])->name('dokter.obat-keluar.delete');
                Route::get('/detail/{id}', [ObatKeluarDokterController::class, 'detail'])->name('dokter.obat-keluar.detail');
            });
        });

        Route::prefix('nurse')->group(function () {
            Route::get('/', [DashboardNurseController::class, 'index'])->name('nurse.dashboard');
            Route::get('/profil', [DashboardNurseController::class, 'profil'])->name('nurse.profil');

            Route::prefix('pasien')->group(function () {
                Route::get('/', [PasienNurseController::class, 'index'])->name('nurse.pasien');
                Route::get('/create', [PasienNurseController::class, 'create'])->name('nurse.pasien.create');
                Route::post('/store', [PasienNurseController::class, 'store'])->name('nurse.pasien.store');
                Route::get('/{id}', [PasienNurseController::class, 'edit'])->name('nurse.pasien.edit');
                Route::post('/update', [PasienNurseController::class, 'update'])->name('nurse.pasien.update');
                Route::delete('/delete/{id}', [PasienNurseController::class, 'delete'])->name('nurse.pasien.delete');
            });

            // pemeriksaan
            Route::prefix('pemeriksaan')->group(function () {
                Route::get('/', [PemeriksaanAdminController::class, 'index'])->name('nurse.pemeriksaan');
                Route::post('/createOrUpdate', [PemeriksaanAdminController::class, 'createOrUpdate'])->name('nurse.pemeriksaan.createOrUpdate');
                Route::post('/update', [PemeriksaanAdminController::class, 'update'])->name('nurse.pemeriksaan.update');
                Route::delete('/delete/{id}', [PemeriksaanAdminController::class, 'delete'])->name('nurse.pemeriksaan.delete');
            });

            // diagnosa
            Route::prefix('diagnosa')->group(function () {
                Route::get('/', [DiagnosaAdminController::class, 'index'])->name('nurse.diagnosa');
                Route::post('/createOrUpdate', [DiagnosaAdminController::class, 'createOrUpdate'])->name('nurse.diagnosa.createOrUpdate');
                Route::post('/update', [DiagnosaAdminController::class, 'update'])->name('nurse.diagnosa.update');
                Route::delete('/delete/{id}', [DiagnosaAdminController::class, 'delete'])->name('nurse.diagnosa.delete');
            });

            // pendaftaran
            Route::prefix('pendaftaran')->group(function () {
                Route::get('/', [PendaftaranAdminController::class, 'index'])->name('nurse.pendaftaran');
                Route::post('/create', [PendaftaranAdminController::class, 'create'])->name('nurse.pendaftaran.create');
                Route::post('/update', [PendaftaranAdminController::class, 'update'])->name('nurse.pendaftaran.update');
                Route::delete('/delete/{id}', [PendaftaranAdminController::class, 'delete'])->name('nurse.pendaftaran.delete');
            });


            // rekam_medis
            Route::prefix('rekam_medis')->group(function () {
                Route::get('/', [RekamMedisNurseController::class, 'index'])->name('nurse.rekam_medis');
                Route::get('/create', [RekamMedisNurseController::class, 'create'])->name('nurse.rekam_medis.create');
                Route::get('/create/{id_antrian}', [RekamMedisNurseController::class, 'createFromAntrian'])->name('nurse.rekam_medis.createFromAntrian');
                Route::post('/store', [RekamMedisNurseController::class, 'store'])->name('nurse.rekam_medis.store');
                Route::get('/edit', [RekamMedisNurseController::class, 'edit'])->name('nurse.rekam_medis.edit');
                Route::post('/update', [RekamMedisNurseController::class, 'update'])->name('nurse.rekam_medis.update');
                Route::get('/detail/{id}', [RekamMedisNurseController::class, 'detail'])->name('nurse.rekam_medis.detail');
                Route::delete('/delete/{id}', [RekamMedisNurseController::class, 'delete'])->name('nurse.rekam_medis.delete');
                Route::get('/update-status', [RekamMedisNurseController::class, 'updateStatus'])->name('nurse.rekam_medis.update-status');
            });

            // rekam_medis_kandungan
            Route::prefix('rekam_medis_kandungan')->group(function () {
                Route::get('/', [RekamMedisKandunganAdminController::class, 'index'])->name('nurse.rekam_medis_kandungan');
                Route::post('/create', [RekamMedisKandunganAdminController::class, 'create'])->name('nurse.rekam_medis_kandungan.create');
                Route::post('/update', [RekamMedisKandunganAdminController::class, 'update'])->name('nurse.rekam_medis_kandungan.update');
                Route::delete('/delete/{id}', [RekamMedisKandunganAdminController::class, 'delete'])->name('nurse.rekam_medis_kandungan.delete');
            });

            // tindakan
            Route::prefix('tindakan')->group(function () {
                Route::get('/', [TindakanAdminController::class, 'index'])->name('nurse.tindakan');
                Route::post('/createOrUpdate', [TindakanAdminController::class, 'createOrUpdate'])->name('nurse.tindakan.createOrUpdate');
                Route::post('/update', [TindakanAdminController::class, 'update'])->name('nurse.tindakan.update');
                Route::delete('/delete/{id}', [TindakanAdminController::class, 'delete'])->name('nurse.tindakan.delete');
            });


            // obat
            Route::prefix('obat')->group(function () {
                Route::get('/', [ObatNurseController::class, 'index'])->name('nurse.obat');
                Route::post('/create', [ObatNurseController::class, 'create'])->name('nurse.obat.create');
                Route::post('/update', [ObatNurseController::class, 'update'])->name('nurse.obat.update');
                Route::delete('/delete/{id}', [ObatNurseController::class, 'delete'])->name('nurse.obat.delete');
                Route::get('/resep/{id}', [ObatNurseController::class, 'createResep'])->name('nurse.obat.resep.create');
                Route::get('/resep', [ObatNurseController::class, 'resep'])->name('nurse.obat.resep');
                Route::post('/resep/store', [ObatNurseController::class, 'storeResep'])->name('nurse.obat.storeResep');
            });

            // obat-keluar
            Route::prefix('obat-keluar')->group(function () {
                Route::get('/', [ObatKeluarNurseController::class, 'index'])->name('nurse.obat-keluar');
                Route::post('/create', [ObatKeluarNurseController::class, 'create'])->name('nurse.obat-keluar.create');
                Route::post('/update', [ObatKeluarNurseController::class, 'update'])->name('nurse.obat-keluar.update');
                Route::delete('/delete/{id}', [ObatKeluarNurseController::class, 'delete'])->name('nurse.obat-keluar.delete');
                Route::get('/detail/{id}', [ObatKeluarNurseController::class, 'detail'])->name('nurse.obat-keluar.detail');
            });

            // antrian
            Route::prefix('antrian')->group(function () {
                Route::get('/', [AntrianNurseController::class, 'index'])->name('nurse.antrian');
                Route::post('/create', [AntrianNurseController::class, 'create'])->name('nurse.antrian.create');
                Route::post('/update', [AntrianNurseController::class, 'update'])->name('nurse.antrian.update');
                Route::delete('/delete/{id}', [AntrianNurseController::class, 'delete'])->name('nurse.antrian.delete');
                Route::get('/proses/{id}', [AntrianNurseController::class, 'proses'])->name('nurse.antrian.proses');
            });
        });


        Route::prefix('apotek')->group(function () {
            Route::get('/', [DashboardApotekController::class, 'index'])->name('apotek.dashboard');
            Route::get('/profil', [DashboardApotekController::class, 'profil'])->name('apotek.profil');

            // obat
            Route::prefix('obat')->group(function () {
                Route::get('/', [ObatApotekController::class, 'index'])->name('apotek.obat');
                Route::post('/create', [ObatApotekController::class, 'create'])->name('apotek.obat.create');
                Route::post('/update', [ObatApotekController::class, 'update'])->name('apotek.obat.update');
                Route::delete('/delete/{id}', [ObatApotekController::class, 'delete'])->name('apotek.obat.delete');
                Route::get('/resep/{id}', [ObatApotekController::class, 'createResep'])->name('apotek.obat.resep.create');
                Route::get('/resep', [ObatApotekController::class, 'resep'])->name('apotek.obat.resep');
                Route::post('/resep/store', [ObatApotekController::class, 'storeResep'])->name('apotek.obat.storeResep');
            });

            // obat-keluar
            Route::prefix('obat-keluar')->group(function () {
                Route::get('/', [ObatKeluarApotekController::class, 'index'])->name('apotek.obat-keluar');
                Route::post('/create', [ObatKeluarApotekController::class, 'create'])->name('apotek.obat-keluar.create');
                Route::post('/update', [ObatKeluarApotekController::class, 'update'])->name('apotek.obat-keluar.update');
                Route::delete('/delete/{id}', [ObatKeluarApotekController::class, 'delete'])->name('apotek.obat-keluar.delete');
                Route::get('/detail/{id}', [ObatKeluarApotekController::class, 'detail'])->name('apotek.obat-keluar.detail');
            });
        });
    });

    Route::middleware('user')->group(function () {
        Route::prefix('client')->group(function () {});
    });
});

Auth::routes();
