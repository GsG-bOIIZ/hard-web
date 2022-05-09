<?php

namespace App\Controller;

use App\Service\Survey\SurveyServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends AbstractController
{
    private SurveyServiceInterface $action;

    public function __construct(SurveyServiceInterface $action)
    {
        $this->action = $action;
    }    

    public function saveSurvey(): Response
    {
        return $this->render('save.html.twig', [ 'data' => $this->action->saveData() ]);
    }

    public function viewSurvey(): Response
    {
        return $this->render('view.html.twig', [ 'survey' => $this->action->viewData() ]);
    }
}