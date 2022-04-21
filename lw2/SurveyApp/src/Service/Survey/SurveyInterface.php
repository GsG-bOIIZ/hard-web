<?php

namespace App\Service\Survey;

interface SurveyInterface
{
    public function saveData(): array;
    public function viewData(): array;
}