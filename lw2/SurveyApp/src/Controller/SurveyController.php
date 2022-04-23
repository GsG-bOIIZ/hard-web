<?php

namespace App\Controller;

use App\Service\Survey\SurveyServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends AbstractController
{
    public function saveSurvey(SurveyServiceInterface $action): Response
    {
        return $this->render('save.html.twig', [ 'data' => $action->saveData() ]);
    }

    public function viewSurvey(SurveyServiceInterface $action): Response
    {
        return $this->render('view.html.twig', [ 'survey' => $action->viewData() ]);
    }
}