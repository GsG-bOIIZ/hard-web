<?php

namespace App\Service\Survey;

use App\Module\Survey\SurveyFileStorage;
use App\Module\Survey\RequestSurveyLoader;
use App\Module\Survey\Survey;
use App\Module\PhotoStorage\PhotoStorage;


class SurveyService implements SurveyServiceInterface
{
    private RequestSurveyLoader $requestSurveyLoader;
    private SurveyFileStorage $surveyFileStorage;
    private PhotoStorage $photoStorage;

    public function __construct(RequestSurveyLoader $requestSurveyLoader, surveyFileStorage $surveyFileStorage, PhotoStorage $photoStorage)
    {
        $this->requestSurveyLoader = $requestSurveyLoader;
        $this->surveyFileStorage = $surveyFileStorage;
        $this->photoStorage = $photoStorage;
    }

    public function saveData(): array
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        $alert = SurveyFileStorage::saveSurveyToFile($survey);
        if ($survey->getEmail())
        {
            return [ 'alert' => $alert . $this->photoStorage->saveAvatar('avatar', $survey->getEmail()) ];
        }
        return [ 'alert' => $alert ];
    }

    public function viewData(): Survey
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        return $this->surveyFileStorage->loadSurveyFromFile($survey->getEmail());
    }

    public function viewAvatar(): ?string
    {
        $survey = $this->requestSurveyLoader->createSurveyInfo();
        if ($survey->getEmail())
        {
            return $this->photoStorage->getAvatar($survey->getEmail());
        }
        return null;        
    }
}