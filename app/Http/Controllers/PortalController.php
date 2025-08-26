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
            'token' => $token,
            'no_rm' => $no_rm
        ]);
        // return json_encode($no_rm);
    }
    public function submit(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'no_rm' => 'required|string|max:255',
        ]);

        $key = env('AES256_KEY');
        $iv  = env('AES256_IV');

        // Dekripsi token
        $decrypted = openssl_decrypt($request->token, 'AES-256-CBC', $key, 0, $iv);
        $data = json_decode($decrypted, true);

        if (!$data || !isset($data['no_rm'], $data['pelayanan_id'])) {
            return redirect()->back()->withErrors(['token' => 'No RM tidak valid.']);
        }

        $no_rm_token = $data['no_rm'];
        $pelayanan_id = $data['pelayanan_id'];
        $no_rm_input = $request->no_rm;

        // Validasi no_rm
        if ($no_rm_input === $no_rm_token) {
            // ✅ Sama → redirect ke aplikasi LIS
            $lisUrl = "https://lis-rs.example.com/hasil-lab?no_rm={$no_rm_token}&pelayanan_id={$pelayanan_id}";
            return redirect()->away($lisUrl);
        } else {
            // ❌ Tidak sama → kembali dengan error
            return redirect()->back()
                ->withErrors(['no_rm' => 'Nomor rekam medis tidak sesuai dengan token.'])
                ->withInput();
        }
    }
}
