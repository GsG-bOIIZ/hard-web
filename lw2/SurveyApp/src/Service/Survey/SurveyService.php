<?php

namespace App\Service\Survey;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Survey;

class SurveyService implements SurveyServiceInterface
{
    private RequestSurveyLoader $requestSurveyLoader;
    private SurveyFileStorage $surveyFileStorage;

    public function __construct(RequestSurveyLoader $requestSurveyLoader, surveyFileStorage $surveyFileStorage)
    {
        $this->requestSurveyLoader = $requestSurveyLoader;
        $this->surveyFileStorage = $surveyFileStorage;
    }

    public function saveData(): array
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        $alert = SurveyFileStorage::saveSurveyToFile($survey);
        $surveyFromFile = $this->surveyFileStorage->loadSurveyFromFile($survey->getEmail());
        return [
            'alert' => $alert, 
            'survey' => $surveyFromFile
        ];
    }

    public function viewData(): Survey
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        return $this->surveyFileStorage->loadSurveyFromFile($survey->getEmail());
    }
}