<?php

namespace App\Jobs;

use App\Http\Controllers\Traits\SimeviTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class getprovinsi implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
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

        $response = Http::withToken($token['access_token'])->withHeaders([
            'Accept' => 'application/json'
        ])->get(config('app.simevi_url').'provinsis');
        
        $filepath = 'master/provinsi.json';
        if (Storage::disk('local')->exists($filepath)) 
            Storage::disk('local')->delete($filepath); 
        Storage::disk('local')->put($filepath, json_encode($response->json()));
    }
}
