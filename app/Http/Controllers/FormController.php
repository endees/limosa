<?php

namespace App\Http\Controllers;

use App\Http\Requests\BelgianCompanyValidateRequest;
use App\Http\Requests\DataFormRequest;
use App\Http\Requests\DataInitRequest;
use App\Http\Requests\NipValidateRequest;
use App\Http\Requests\WorkSiteValidateRequest;
use App\Jobs\ProcessLimosaGeneration;
use App\Mail\Lead;
use App\Models\BelgianCompany;
use App\Models\BelgianCompany as BelgianCompanyModel;
use App\Models\Form\DataHandler;
use App\Models\Lead as LeadModel;
use App\Models\Postcodes;
use App\Models\Validator\ViesChecker;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
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
        $existingCompany = BelgianCompany::firstWhere('identifier' ,'=' , $formData['belgian_nip']);
        $existingCompany->company_email = $formData['belgian_company_email'];
        $existingCompany->company_telephone = $formData['belgian_company_telephone'];
        $existingCompany->save();

        $formData['business_name'] = $existingCompany->business_name;

        $formData['username'] = config('limosa.limosa_username');
        $formData['password'] = config('limosa.limosa_password');
        $formData['ceidg']['company_name'] = transliterator_transliterate(
            $translitRules,
            $request->session()->get('ceidg.nazwa')
        );

        $recipients = config('limosa.registration_data_recipients');

        ProcessLimosaGeneration::dispatch($formData);

        /** @var LeadModel $leadModel */
        $leadModel = $existingCompany->lead()->create([
            'firstname' => $formData['firstname'],
            'lastname' => $formData['lastname'],
            'sector' => $formData['sector'],
            'sector_construction' => $formData['sector_construction'],
            'email' => $formData['customer_email'],
            'telephone' => $formData['customer_telephone'],
        ]);

        $lead = new Lead($leadModel);
        Mail::to($recipients)->send($lead);
    }

    public function init(DataInitRequest $request): JsonResponse
    {
        return response()->json(["message" => "Success"]);
    }

    public function company(NipValidateRequest $request): JsonResponse
    {
        return response()->json(["message" => "Success"]);
    }

    public function belgianCompany(BelgianCompanyValidateRequest $request): JsonResponse
    {
        $nipBe = $request->get('belgian_nip');
        $response = Http::post(
            "https://ec.europa.eu/taxation_customs/vies/rest-api/check-vat-number",
            [
                "countryCode" => "BE",
                "vatNumber" => $nipBe
            ]
        );

        $company = BelgianCompanyModel::firstOrCreate(['identifier' => $nipBe]);

        $company->business_name = $response->collect()->get('name');
        $company->valid = $response->collect()->get('valid');
        $company->save();
        return response()->json(["message" => "Success"]);
    }

    public function workSite(WorkSiteValidateRequest $request): JsonResponse
    {
        return response()->json(["message" => "Success"]);
    }

    public function success(Request $request) {
        return view('success', []);
    }

    public function welcome(Request $request)
    {
        $postcodes = App::make(Postcodes::class)->getPostCodes();
        return view('welcome', ['postcodes' => $postcodes]);
    }

    public function viesCheck(Request $request, string $nip): JsonResponse
    {
        /**
         * @var ViesChecker $viesChecker
         */
        $viesChecker = App::make(ViesChecker::class);
        $response = $viesChecker->check($nip) === true ? "Success" : "Failure";
        return response()->json(["message" => $response]);
    }
}
