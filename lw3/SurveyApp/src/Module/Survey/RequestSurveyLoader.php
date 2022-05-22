<?php

namespace App\Module\Survey;
use Symfony\Component\HttpFoundation\Request;

class RequestSurveyLoader
{
    private const POST_FIRST_NAME = "first_name";
    private const POST_LAST_NAME = "last_name";
    private const POST_EMAIL = "email";
    private const POST_AGE = "age";

    private Request $request;

    public function __construct()
    {
        $this->request = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER
        );
    }

    public function createSurveyInfo(): Survey
    {
        if ($this->request->request->get(self::POST_EMAIL) == null)
        {
            return new Survey(null, null, null, null);
        }
        $email = $this->request->request->get(self::POST_EMAIL);
        $firstName = $this->request->request->get(self::POST_FIRST_NAME) ?? null;
        $lastName = $this->request->request->get(self::POST_LAST_NAME) ?? null;   
        $age = $this->request->request->get(self::POST_AGE) ?? null;

        return new Survey($email, $firstName, $lastName, $age);
    }
}