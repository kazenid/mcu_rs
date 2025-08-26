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
        $id_kso = urlencode(Auth::user()->id_penjamin);

        $response = Http::withBasicAuth('N79J3213901hj80DFa5sdgfA', 'HJSA98sa36sksd23GDwadfs')
            ->get("https://rsudbangil.pasuruankab.go.id/toolbox/mcu_api.php?id=$id_kso");

            if ($response->successful()) {
                $json = $response->json();
                // dd($json);
        
                // Validasi status dari JSON
                if (isset($json['status']) && $json['status'] === 'success') {
                    $data = $json; // berisi 'status' dan 'data'
                    return view('pages.medical-checkup', compact('data'));
                } else {
                    $pesan = $json['message'] ?? 'Respon API tidak valid.';
                    return view('pages.medical-checkup')->with('error', "Status gagal: $pesan");
                }
            } else {
                Log::error('API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
        
                return view('pages.medical-checkup')->with('error', 'Gagal mengambil data dari API.');
            }
    }
}
