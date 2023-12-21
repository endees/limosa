<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelgianCompanyValidateRequest;
use App\Http\Requests\DataFormRequest;
use App\Http\Requests\DataInitRequest;
use App\Http\Requests\NipValidateRequest;
use App\Jobs\ProcessLimosaGeneration;
use App\Mail\Lead;
use App\Models\BelgianCompany;
use App\Models\Form\DataHandler;
use Carbon\Carbon;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormController extends BaseController
{
    protected array $parameters;

    public function register(DataFormRequest $request)
    {
        $formData = $request->all();
        Log::channel('registration')->info('Start registering ip address: ' . request()->server('SERVER_ADDR'));

        /** @var DataHandler $dataHandler */
        $dataHandler = App::make(DataHandler::class);
        $formData['date_of_birth'] = $dataHandler->getBirthDateFromPesel($formData['pesel']);
        $formData['gender'] = $dataHandler->getGenderFromPesel($formData['pesel']);

        $translitRules = 'Latin-ASCII';
        $formData['firstname'] = transliterator_transliterate($translitRules, $formData['firstname']);
        $formData['lastname'] = transliterator_transliterate($translitRules, $formData['lastname']);
        $formData['street'] = transliterator_transliterate($translitRules, $formData['street']);
        $formData['city'] = transliterator_transliterate($translitRules, $formData['city']);

        $formData['start_date'] = Carbon::createFromFormat('Y-m-d', $formData['start_date'])->format('d/m/Y');
        $formData['end_date'] = Carbon::createFromFormat('Y-m-d', $formData['end_date'])->format('d/m/Y');

        /** @var BelgianCompany $existingCompany */
        $existingCompany = BelgianCompany::firstWhere('identifier' ,'=' , 'BE' . $formData['belgian_nip']);
        $payload = json_decode($existingCompany->payload, 1);
        $formData['business_name'] = $payload['company_name'];

        /** @var \App\Models\Lead $leadModel */
        $leadModel = $existingCompany->lead()->create([
            'firstname' => $formData['firstname'],
            'lastname' => $formData['lastname'],
            'email' => $formData['customer_email'],
            'telephone' => $formData['customer_telephone'],
        ]);

        $formData['username'] = config('limosa.limosa_username');
        $formData['password'] = config('limosa.limosa_password');

        $recipients = config('limosa.registration_data_recipients');
        $lead = new Lead($leadModel);
        Mail::to($recipients)->send($lead);
        //      no account creation this time
        //      ProcessAccountCreation::dispatch($formData);
        ProcessLimosaGeneration::dispatch($formData);
        return view('success', []);
    }

    public function init(DataInitRequest $request) {
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function company(NipValidateRequest $request)
    {
        return response()->json([
            "message" => "Success"
        ]);
    }

    public function belgianCompany(BelgianCompanyValidateRequest $request)
    {
        return response()->json([
            "message" => "Success"
        ]);
    }
}
