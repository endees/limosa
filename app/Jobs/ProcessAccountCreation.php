<?php

namespace App\Jobs;

use App\Models\FakeMail\EmailAdapter;
use App\Models\DriverHandler;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class ProcessAccountCreation implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private DriverHandler $driverHandler;
    private EmailAdapter $mailApi;
    private Log $logger;

    public function __construct(
        private readonly array $formData
    ) {
        $this->driverHandler = App::make(DriverHandler::class);
        $this->mailApi = App::make(EmailAdapter::class);
    }

    public function handle(): void
    {
        if (true === false) {
            Log::channel('registration')->info('The user already exist: ' . json_encode($this->formData['customer_email']));
//            $json = '{
//                  "address":"ydroqtwd@guerrillamailblock.com",
//                  "customer_address": "materazzi5@gmail.com",
//                  "telephone": "792651641",
//                  "username": "ydroqtwd",
//                  "gender": "male",
//                  "password": "UmRXBgA1@",
//                  "lastname": "Klepuszewski",
//                  "firstname": "Tomasz",
//                  "pesel":"80052724677",
//                  "date_of_birth":"05/27/1980",
//                  "street": "Rapackiego" ,
//                  "house_number":"2",
//                  "flat_number":"1",
//                  "postcode": "71-467",
//                  "city": "Szczecin",
//                  "nip": "8511459011",
//                  "token":"q2sep7rmdja8jdmiv8ol651hi3",
//                  "email_timestamp":1700952647,
//                  "alias":"te0gwl+33jndmhuw3t2w"
//                  "business_name":"Knauf Montaj SPRL"
//                  "date_start":"05/27/2023"
//                  "date_end":"12/27/2023"
//                  }';
//            $data = json_decode($json, true);
            ProcessLimosaGeneration::dispatch($this->formData);
        } else {
            $emailData = $this->mailApi->register();
            $username = explode('@', $emailData['address'])[0];
            $emailData['username'] = $username;
            Log::channel('registration')->info('Start registering a new client with data: ' . json_encode($emailData));
            $allData = array_merge($emailData, $this->formData);
            $this->driverHandler->register($allData);
            ActivateAccount::dispatch($allData)->delay(Carbon::now()->addMinutes(5));
        }


    }
}
