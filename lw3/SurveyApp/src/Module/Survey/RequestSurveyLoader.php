<?php

namespace App\Module\Survey;
use Symfony\Component\HttpFoundation\Request;

class RequestSurveyLoader
{
    private const POST_FIRST_NAME = "first_name";
    private const POST_LAST_NAME = "last_name";
    private const POST_EMAIL = "email";
    private const POST_AGE = "age";


    public function createSurveyInfo(): Survey
    {
        $request = Request::createFromGlobals();

        if ($request->request->get(self::POST_EMAIL) == null)
        {
            return new Survey(null, null, null, null);
        }
        $email = $request->request->get(self::POST_EMAIL);
        $firstName = $request->request->get(self::POST_FIRST_NAME) ?? null;
        $lastName = $request->request->get(self::POST_LAST_NAME) ?? null;   
        $age = $request->request->get(self::POST_AGE) ?? null;

        return new Survey($email, $firstName, $lastName, $age);
    }
}