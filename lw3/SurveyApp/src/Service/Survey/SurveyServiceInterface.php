<?php

namespace App\Service\Survey;

use App\Module\Survey\Survey;

interface SurveyServiceInterface
{
    public function saveData(): array;
    public function viewData(): Survey;
    public function viewAvatar(): ?string;
}