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

    public function form(): Response
    {
        return $this->render('form_save.html.twig');
    }

    public function saveForm(): Response
    {
        return $this->render('save.html.twig', [ 'data' => $this->action->saveData() ]);

    }

    public function viewForm(): Response
    {
        return $this->render('form_view.html.twig', [ 'survey' => $this->action->viewData(), 'avatar' =>  $this->action->viewAvatar() ]);
    }

    public function getForm(): Response
    {
        return $this->render('view.html.twig');
    }
}