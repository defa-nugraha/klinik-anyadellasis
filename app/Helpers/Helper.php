<?php

use App\Models\AngsuranModel;
use App\Models\SubDiagnosaModel;
use Illuminate\Support\Facades\Crypt;

function formatRupiah($nilai, $rp = true)
{
    if ($rp) {
        $rupiah = "Rp " . number_format($nilai, 0, ',', '.');
    } else {
        $rupiah = number_format($nilai, 0, ',', '.');
    }
    return $rupiah;
}

function clearDot($string)
{
    return str_replace('.', '', $string);
}

function salt()
{
    return md5('digitalpelajar.com-');
}

function encryptStr($string)
{
    try {
        return Crypt::encryptString(salt() . $string);
    } catch (\Throwable $th) {
        //throw $th;
        return 0;
    }
}

function decryptStr($string)
{
    try {
        // Dekripsi string terlebih dahulu
        $decrypted = Crypt::decryptString($string);

        // Hapus salt dari hasil dekripsi
        if (substr($decrypted, 0, strlen(salt())) === salt()) {
            return substr($decrypted, strlen(salt()));
        } else {
            return 0; // Salt tidak cocok
        }
    } catch (\Throwable $th) {
        //throw $th;
        return 0;
    }
}


function convertTime($timestamp)
{
    // Menggunakan fungsi date() untuk mengkonversi timestamp menjadi format waktu yang dapat dibaca
    return date('Y-m-d H:i:s', $timestamp);
}

function namaRole($id)
{

    switch ($id) {
        case 1:
            return 'SUPERADMIN';
            break;
        case 2:
            return 'ADMIN';
            break;
        default:
            return 'CUSTOMER';
            break;
    }
}

// generate random string
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function tanggalIndonesia($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 => 'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $split = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}

function namaHariIndonesia($tanggal)
{
    $hari = [
        'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    ];

    $timestamp = strtotime($tanggal);

    $indexHari = date('w', $timestamp);

    return $hari[$indexHari];
}

function getDiagnosa($id_diagnosa, $code = false)
{
    $data = SubDiagnosaModel::where('id_diagnosa', $id_diagnosa)->get();
    $diagnosa = '';
    foreach ($data as $d) {
        $diagnosa .= ($code) ? $d->icd->code . ', ' : $d->icd->category . ', ';
    }

    return $diagnosa;
}
