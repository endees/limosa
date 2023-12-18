<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelgianCompanyValidateRequest;
use App\Http\Requests\DataFormRequest;
use App\Http\Requests\DataInitRequest;
use App\Http\Requests\NipValidateRequest;
use App\Jobs\ProcessAccountCreation;
use App\Mail\LimosaGenerated;
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

        ProcessAccountCreation::dispatch($formData);
        return view('success', []);
    }

    public function init(DataInitRequest $request) {
        Mail::to('daniel.materka@gmail.com')->send(new LimosaGenerated());
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
