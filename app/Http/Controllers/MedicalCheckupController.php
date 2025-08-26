<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MedicalCheckupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $id_kso = Auth::user()->id_penjamin;

        $response = Http::timeout(10)->withBasicAuth(
            env('BASIC_AUTH_USER'),
            env('BASIC_AUTH_PASS')
        )->get("https://rsudbangil.pasuruankab.go.id/toolbox/mcu_api.php", [
            'get' => 'data',
            'id'  => $id_kso
        ]);

        $json = json_decode($response->body(), true);

        if (is_array($json) && isset($json['status']) && strtolower($json['status']) === 'success') {
            $data = [
                'status' => 'success',
                'data'   => $json['data'] ?? [],
            ];
            return view('pages.medical-checkup', compact('data'));
        }

        $pesan = $json['message'] ?? 'Respon API tidak valid.';
        return view('pages.medical-checkup', [
            'data'  => [],
            'error' => "Status gagal ({$response->status()}): $pesan"
        ]);
    }
    // Laravel Controller
    public function getKunjungan(Request $request)
    {
        $token = $request->get('token');
         $id_kso = Auth::user()->id_penjamin;

        $response = Http::withBasicAuth(
            env('BASIC_AUTH_USER'),
            env('BASIC_AUTH_PASS')
        )->get("https://rsudbangil.pasuruankab.go.id/toolbox/mcu_api.php", [
            'get'   => 'kunjungan',
            'kso' => $id_kso,
            'token' => $token
        ]);

        return $response->json();
    }
    public function getTindakan(Request $request)
    {
        $id = $request->get('id');

        $response = Http::withBasicAuth(
            env('BASIC_AUTH_USER'),
            env('BASIC_AUTH_PASS')
        )->get("https://rsudbangil.pasuruankab.go.id/toolbox/mcu_api.php", [
            'get'   => 'tindakan',
            'id' => $id
        ]);

        return $response->json();
    }
}
