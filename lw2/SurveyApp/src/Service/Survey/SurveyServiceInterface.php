<?php

namespace App\Service\Survey;

interface SurveyServiceInterface
{
    public function saveData(): array;
    public function viewData(): array;
}