<?php

namespace App\Models\Strategy;

use App\Models\Strategy\Pages\Generation\LimosaFirstPage;
use App\Models\Strategy\Pages\Generation\LimosaTypesPage;
use App\Models\Strategy\Pages\Generation\OverviewPrint;
use App\Models\Strategy\Pages\Generation\PlaceOfEmployment;
use App\Models\Strategy\Pages\Generation\PlaceOfEmployment2;
use App\Models\Strategy\Pages\Generation\PlaceOfWorkCompanyDetail;
use App\Models\Strategy\Pages\Generation\PlaceOfWorkCompanySearch;
use App\Models\Strategy\Pages\Generation\StepAssignmentData;
use App\Models\Strategy\Pages\Generation\StepBelgianClient;
use App\Models\Strategy\Pages\Generation\StepEmployer;
use App\Models\Strategy\Pages\Generation\StepOverview;
use App\Models\Strategy\Pages\Registration\FrontPage;
use App\Models\Strategy\Pages\Registration\IntroPage;
use App\Models\Strategy\Pages\Registration\Languages;
use App\Models\Strategy\Pages\Generation\LoginPage;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class GenerationStrategy
{
    protected $pageHandlersFirst = [];

    public function __construct(
        public readonly IntroPage $introPage,
        public readonly FrontPage $frontPage,
        public readonly Languages $languages,
        public readonly LoginPage $loginPage,
        public readonly LimosaTypesPage          $limosaTypesPage,
        public readonly LimosaFirstPage          $limosaFirstPage,
        public readonly StepEmployer             $stepEmployer,
        public readonly PlaceOfEmployment        $placeOfEmployment,
        public readonly PlaceOfWorkCompanySearch $placeOfWorkCompanySearch,
        public readonly PlaceOfWorkCompanyDetail $placeOfWorkCompanyDetail,
        public readonly PlaceOfEmployment2       $placeOfEmployment2,
        public readonly StepBelgianClient        $stepBelgianClient,
        public readonly StepAssignmentData       $stepAssignmentData,
        public readonly StepOverview             $stepOverview,
        public readonly OverviewPrint            $overviewPrint,
    ) {
        $this->pageHandlersFirst = [
            $this->introPage,
            $this->frontPage,
            $this->languages,
            $this->loginPage,
            $this->limosaTypesPage,
            $this->limosaFirstPage,
            $this->stepEmployer,
            $this->placeOfEmployment,
            $this->placeOfWorkCompanySearch,
            $this->placeOfWorkCompanyDetail,
            $this->placeOfEmployment2,
            $this->stepBelgianClient,
            $this->stepAssignmentData,
            $this->stepOverview,
            $this->overviewPrint
        ];
    }

    public function execute(RemoteWebDriver $driver, array $data)
    {
        foreach ($this->pageHandlersFirst as $key => $pageHandler) {
            $data['sequence'] = $key;
            $pageHandler->resolve($driver, $data);
        }
    }
}
