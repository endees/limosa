<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Generation\AddBelgianClient;
use App\Models\Strategy\Pages\Generation\AddSiteBuilding;
use App\Models\Strategy\Pages\Generation\BuildingAsPlaceOfEmploymentFound;
use App\Models\Strategy\Pages\Generation\ByName\PlaceOfWorkCompanySearch;
use App\Models\Strategy\Pages\Generation\ByVat\PlaceOfWorkCompanySearchByVat;
use App\Models\Strategy\Pages\Generation\EndStepBelgianClient;
use App\Models\Strategy\Pages\Generation\LimosaFirstPage;
use App\Models\Strategy\Pages\Generation\LimosaTypesPage;
use App\Models\Strategy\Pages\Generation\LoginPage;
use App\Models\Strategy\Pages\Generation\OverviewPrint;
use App\Models\Strategy\Pages\Generation\AddCompanySite;
use App\Models\Strategy\Pages\Generation\PlaceOfEmploymentSelected;
use App\Models\Strategy\Pages\Generation\CompanyAsPlaceOfEmploymentFound;
use App\Models\Strategy\Pages\Generation\StepAssignmentData;
use App\Models\Strategy\Pages\Generation\StepBelgianClient;
use App\Models\Strategy\Pages\Generation\StepEmployer;
use App\Models\Strategy\Pages\Generation\StepOverview;
use App\Models\Strategy\Pages\Registration\FrontPage;
use App\Models\Strategy\Pages\Registration\IntroPage;
use App\Models\Strategy\Pages\Registration\Languages;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class GenerationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly IntroPage                        $introPage,
        public readonly FrontPage                        $frontPage,
        public readonly Languages                        $languages,
        public readonly LoginPage                        $loginPage,
        public readonly LimosaTypesPage                  $limosaTypesPage,
        public readonly LimosaFirstPage                  $limosaFirstPage,
        public readonly StepEmployer                     $stepEmployer,
        public readonly AddCompanySite                   $addCompanySite,
        public readonly PlaceOfWorkCompanySearch         $placeOfWorkCompanySearch,
        public readonly CompanyAsPlaceOfEmploymentFound  $companyAsPlaceOfEmploymentFound,
        public readonly BuildingAsPlaceOfEmploymentFound $buildingAsPlaceOfEmploymentFound,
        public readonly PlaceOfWorkCompanySearchByVat    $placeOfWorkCompanySearchByVat,
        public readonly PlaceOfEmploymentSelected        $placeOfEmploymentSelected,
        public readonly AddBelgianClient                 $addBelgianClient,
        public readonly StepBelgianClient                $stepBelgianClient,
        public readonly EndStepBelgianClient             $endStepBelgianClient,
        public readonly StepAssignmentData               $stepAssignmentData,
        public readonly StepOverview                     $stepOverview,
        public readonly OverviewPrint                    $overviewPrint,
        public readonly AddSiteBuilding                  $addSiteBuilding
    ) {
        $this->pageHandlersFirst = [
            $this->introPage,
            $this->frontPage,
            $this->languages,
            $this->loginPage,
            $this->limosaTypesPage,
            $this->limosaFirstPage,
            $this->stepEmployer,
        ];
        $this->pageHandlersSecond = [
            $this->placeOfEmploymentSelected,
            $this->addBelgianClient,
            $this->stepBelgianClient,
            $this->endStepBelgianClient,
            $this->stepAssignmentData,
            $this->stepOverview,
            $this->overviewPrint
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        $sequence = 0;
        foreach ($this->pageHandlersFirst as $pageHandler) {
            $data['sequence'] = $sequence++;
            $pageHandler->resolve($driver, $data);
        }

        foreach ($data['nips'] as $nip) {
            $data['sequence'] = $sequence++;
            $this->addCompanySite->resolve($driver, $data);
            $data['sequence'] = $sequence++;
            $data['belgian_company_nip'] = $nip['title'];
            $this->placeOfWorkCompanySearchByVat->resolve($driver, $data);
            $data['sequence'] = $sequence++;
            $this->companyAsPlaceOfEmploymentFound->resolve($driver, $nip);
        }

        foreach ($data['addresses'] as $address) {
            $data['sequence'] = $sequence++;
            $this->addSiteBuilding->resolve($driver, $data);
            $data['sequence'] = $sequence++;
            $data['site_name'] = $address['name'];
            $data['site_street'] = $address['street'];
            $data['site_house_number'] = $address['house_number'];
            $data['site_apartment_number'] = $address['apartment_number'];
            $data['site_post_code'] = $address['site_post_code'];
            $this->buildingAsPlaceOfEmploymentFound->resolve($driver, $address);
        }

        foreach ($this->pageHandlersSecond as $pageHandler3) {
            $data['sequence'] = $sequence++;
            $pageHandler3->resolve($driver, $data);
        }
    }
}
