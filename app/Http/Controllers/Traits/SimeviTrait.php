<?php

namespace App\Http\Controllers\Traits;

use App\Jobs\getdesa;
use App\Jobs\getdesakec;
use App\Jobs\getdesakode;
use \SpreadsheetReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Jobs\getprovinsi;
use App\Jobs\getkabupaten;
use App\Jobs\getkabprop;
use App\Jobs\getkabkode;
use App\Jobs\getkecamatan;
use App\Jobs\getkeckab;
use App\Jobs\getkeckode;
use Illuminate\Support\Facades\Log;

trait SimeviTrait
{

    public function getAPIProvinsiAll(){
        $filepath = 'master/provinsi.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getprovinsi();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIKabupatenAll(){
        $filepath = 'master/kabupaten.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getkabupaten();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIKabupatenProp($provinsi){
        $filepath = 'master/kabprov_'.$provinsi.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getkabprop($provinsi);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIKabupaten($kode){
        $filepath = 'master/kabkode_'.$kode.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getkabkode($kode);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIKecamatanAll(){
        $filepath = 'master/kecamatan.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getkecamatan();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;

        
        
    }

    public function getAPIKecamatanKab($kabupaten){

        // Log::debug("Kecamatan kab :" . $kabupaten);
        $filepath = 'master/keckab_'.$kabupaten.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            // Log::debug("Call getkeckab");
            $job = new getkeckab($kabupaten);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;

        
    }

    public function getAPIKecamatan($kode){
        $filepath = 'master/keckode_'.$kode.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getkeckode($kode);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;

        
    }

    public function getAPIDesaAll(){
        $filepath = 'master/desa.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getdesa();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIDesaKec($kecamatan){

        $filepath = 'master/desakec_'.$kecamatan.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {

            $job = new getdesakec($kecamatan);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;
    }

    public function getAPIDesa ($kode){
        $filepath = 'master/desakode_'.$kode.'.json';
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $response = json_decode(file_get_contents($pathjson), true);
        } else {
            $job = new getdesakode($kode);
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $response = json_decode(file_get_contents($pathjson), true);
            }
        }

        return $response;

        
    }

    public function pull($npwp, $nomor)
    {   
        try {
            $pathjson = Storage::disk('public')->url('uploads/'.$npwp);
            $res = json_decode(file_get_contents($pathjson . '/'.$nomor.'.json'), true);
        } catch (\Exception $e) {
            Log::error('Load JSON Exception: ' . $e->getMessage());
            throw new \Exception('Problem with json file');
        }
        return $res;
    }

    public function chekFromItem($items,$keyToSearch)
    {
        $check = 0;
        if (count($items) > 0)
        {
            foreach($items as $item)
            {   
                
                foreach($item as $key)
                {
                    if($key == $keyToSearch)
                    {
                        $check = 1;
                    }
                }

                if($check == 1)
                {
                    break;
                }
            }
        }
        
        return $check;
    }

}