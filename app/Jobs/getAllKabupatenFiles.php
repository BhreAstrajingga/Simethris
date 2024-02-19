<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Jobs\getprovinsi;
use App\Jobs\getkabupaten;
use App\Jobs\getkabprop;
use App\Jobs\getkabkode;

class getAllKabupatenFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filepath = 'master/token.json';
	while (!Storage::disk('local')->exists($filepath))
        {
            //Log::debug('get-token');
            $response = Http::asForm()->post(config('app.simevi_url').'getToken', [
                'username' => config('app.simevi_user'),
                'password' => config('app.simevi_pwd')
            ]);
            //Log::debug($response->json());
            $filepath = 'master/token.json';
            if (Storage::disk('local')->exists($filepath)) 
                Storage::disk('local')->delete($filepath); 
            Storage::disk('local')->put($filepath, json_encode($response->json()));
            // $job = new gettoken();
            // $this->dispatch($job);
            // if (Storage::disk('local')->exists($filepath)) {
            //     $pathjson = Storage::disk('local')->path($filepath);
            //     $token = json_decode(file_get_contents($pathjson), true);
            // }
            
        }

        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $token = json_decode(file_get_contents($pathjson), true);
        } 

        $filepath = 'master/kabupaten.json';
        $kabjson = [];
        if (Storage::disk('local')->exists($filepath)) {
            $pathjson = Storage::disk('local')->path($filepath);
            $kabjson = json_decode(file_get_contents($pathjson), true);
        } 
        else {
            $job = new getkabupaten();
            $this->dispatch($job);
            if (Storage::disk('local')->exists($filepath)) {
                $pathjson = Storage::disk('local')->path($filepath);
                $kabjson = json_decode(file_get_contents($pathjson), true);
            }
        }
        if ($kabjson['data']){
            $lastprop_id = '';
            foreach ($kabjson['data'] as $kab){
                $kd_prop_id = $kab['kd_prop_id'];
                
                
                if ($lastprop_id != $kd_prop_id){
                    $lastprop_id = $kd_prop_id;
                    print_r('.');
                    $response = Http::withToken($token['access_token'])->withHeaders([
                        'Accept' => 'application/json'
                    ])->get(config('app.simevi_url').'kabupatenwithprop/'.$lastprop_id);
            
                    $filepath = 'master/kabprov_'.$lastprop_id.'.json';
                    if (Storage::disk('local')->exists($filepath)) 
                        Storage::disk('local')->delete($filepath); 
                    Storage::disk('local')->put($filepath, json_encode($response->json()));
                    sleep(1);
                }
            }
            // print_r("\n\n");
            // $lastkd_kab = '';
            // foreach ($kabjson['data'] as $kab){
            //     $kd_kab = $kab['kd_kab'];
                
                
            //     if ($lastkd_kab != $kd_kab){
            //         $lastkd_kab = $kd_kab;
            //         print_r('.');
            //         $response = Http::withToken($token['access_token'])->withHeaders([
            //             'Accept' => 'application/json'
            //         ])->get(config('app.simevi_url').'kabupatens/'.$lastkd_kab);
            
            //         $filepath = 'master/kabkode_'.$lastkd_kab.'.json';
            //         if (Storage::disk('local')->exists($filepath)) 
            //             Storage::disk('local')->delete($filepath); 
            //         Storage::disk('local')->put($filepath, json_encode($response->json()));
            //         sleep(1);
            //     }
            // }
            
        }
    }
}
