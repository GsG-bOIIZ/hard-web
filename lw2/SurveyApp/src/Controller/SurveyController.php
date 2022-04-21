<?php

namespace App\Controller;

use App\Service\Survey\SurveyInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends AbstractController
{
    public function saveSurvey(SurveyInterface $surveyServices): Response
    {
        $values = $surveyServices->saveData();
        return $this->render('upload.html.twig',
            [
                'firstName' => $values['firstName'],
                'lastName' => $values['lastName'],
                'age' => $values['age'],
                'email' => $values['email'],
            ]
        );
    }

    public function viewSurvey(SurveyInterface $surveyServices): Response
    {
        $values = $surveyServices->viewData();
        return $this->render('load.html.twig',
            [
                'fileFirstName' => $values['fileFirstName'],
                'fileLastName' => $values['fileLastName'],
                'fileAge' => $values['fileAge'],
                'fileEmail' => $values['fileEmail']
            ]
        );
    }
}