<?php

namespace App\Service\Survey;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\RequestSurveyLoader;

class SurveyServiceInterface implements SurveyInterface
{
    private $requestSurveyLoader;
    private $surveyFileStorage;

    public function __construct()
    {
        $this->requestSurveyLoader = new RequestSurveyLoader();
        $this->surveyFileStorage = new SurveyFileStorage();
    }

    public function saveData(): array
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        SurveyFileStorage::saveSurveyToFile($survey);
        return
            [
                'firstName' => $survey->getFirstName(),
                'lastName' => $survey->getLastName(),
                'age' => $survey->getAge(),
                'email' => $survey->getEmail(),
            ];
    }

    public function viewData(): array
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        $surveyFromFile = $this->surveyFileStorage->loadSurveyFromFile($survey->getEmail());
        return
            [
                'fileEmail' => $surveyFromFile->getEmail(),
                'fileFirstName' => $surveyFromFile->getFirstName(),
                'fileLastName' => $surveyFromFile->getLastName(),
                'fileAge' => $surveyFromFile->getAge()
            ];
    }
}