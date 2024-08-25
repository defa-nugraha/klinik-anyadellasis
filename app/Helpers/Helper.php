<?php

use App\Models\AngsuranModel;
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

function encryptStr($string)
{
    return Crypt::encryptString($string);
}

function decryptStr($string)
{
    return Crypt::decryptString($string);
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
