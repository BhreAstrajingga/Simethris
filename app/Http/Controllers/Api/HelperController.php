<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\SimeviTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

class HelperController extends Controller
{
    use SimeviTrait;

    public function getprovinsi(Request $request){
        $response = $this->getAPIProvinsiAll();
        
        return $response;
    }

    public function getkabupaten(Request $request){
        $response = $this->getAPIKabupatenAll();
        
        return $response;
    }

    public function getKabupatenProp(Request $request){
        $response = $this->getAPIKabupatenProp($request->provinsi);
        
        return $response;
        
    }

    public function getkecamatan(Request $request){

        $response = $this->getAPIKecamatanAll();
        
        return $response;

    }

    public function getKecamatanKode(Request $request){

        $response = $this->getAPIKecamatan($request->kecamatan);
        
        return $response;

    }

    public function getKecamatanKab(Request $request){

        $response = $this->getAPIKecamatanKab($request->kabupaten);
        
        return $response;
        
    }

    public function getdesa(Request $request){
        $response = $this->getAPIDesaAll();
        
        return $response;
        
    }

    public function getDesaKec(Request $request){

        $response = $this->getAPIDesaKec($request->kecamatan);
        
        return $response;
    
    }

    public function getDesaKode(Request $request){

        $response = $this->getAPIDesa($request->desa);
        
        return $response;
    
    }


}
