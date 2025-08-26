<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    public function index(Request $request, $token)
    {
        // Dekripsi token AES-256 jika ada
        $no_rm = null;
        if ($token) {
            $key = env('AES256_KEY'); // Pastikan kunci AES-256 disimpan di .env
            $iv = env('AES256_IV');   // Pastikan IV disimpan di .env
            $no_rm = openssl_decrypt($token, 'AES-256-CBC', $key, 0, $iv);
        }
        $has_no_rm = isset($no_rm) && $no_rm !== false && $no_rm !== null && $no_rm !== '';

        // dd($no_rm);

        // return json_encode($has_no_rm.' - '.$no_rm);
        return view('pages.portal', [
            'has_no_rm' => $has_no_rm,
            'no_rm' => $no_rm
        ]);
        // return json_encode($no_rm);
    }
    public function submit(Request $request, $token)
    {

        // Dekripsi token menjadi no_rm dengan AES-256-CBC
        $key = env('AES256_KEY'); // Kunci AES-256 dari .env
        $iv = env('AES256_IV');   // IV dari .env
        $no_rm = openssl_decrypt($token, 'AES-256-CBC', $key, 0, $iv);

        // Lakukan validasi atau proses lainnya dengan $no_rm di sini
        // Misalnya, simpan ke database atau kirim ke API

        // Setelah proses selesai, Anda bisa mengembalikan respon atau redirect
        return redirect()->back()->with('success', 'No RM berhasil dikirim: ' . $no_rm);
    }
}
