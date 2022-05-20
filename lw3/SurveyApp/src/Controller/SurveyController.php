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
        return $this->render('form.html.twig');
    }

    public function saveForm(): Response
    {
        return $this->render('save_form.html.twig', [ 'data' => $this->action->saveData() ]);

    }

    public function viewUser(): Response
    {
        return $this->render('view_user.html.twig', 
            [ 
                'survey' => $this->action->viewData(), 
                'avatar' =>  $this->action->viewAvatar() 
            ]);
    }

    public function getUser(): Response
    {
        return $this->render('view.html.twig');
    }
}