<?php

namespace App\Controller;

use App\Service\Survey\SurveyServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class SurveyController extends AbstractController
{
    public function saveSurvey(SurveyServiceInterface $surveyServices): Response
    {
        $tempArray = $surveyServices->saveData();
        return $this->render('upload.html.twig',
            [
                'alert' => $tempArray['alert'],
                'firstName' => $tempArray['firstName'],
                'lastName' => $tempArray['lastName'],
                'age' => $tempArray['age'],
                'email' => $tempArray['email']
            ]
        );
    }

    public function viewSurvey(SurveyServiceInterface $surveyServices): Response
    {
        $tempArray = $surveyServices->viewData();
        return $this->render('load.html.twig',
            [
                'fileFirstName' => $tempArray['fileFirstName'],
                'fileLastName' => $tempArray['fileLastName'],
                'fileAge' => $tempArray['fileAge'],
                'fileEmail' => $tempArray['fileEmail']
            ]
        );
    }
}