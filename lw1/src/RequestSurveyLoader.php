<?php

class RequestSurveyLoader
{
    private const GET_FIRST_NAME = "first_name";
    private const GET_LAST_NAME = "last_name";
    private const GET_EMAIL = "email";
    private const GET_AGE = "age";

    public function createSurveyInfo(): Survey
    {
        if (!$_GET[self::GET_EMAIL]) 
        {
            echo "<br>Impossible email (for create Survey)<br><br>";
            return new Survey(null, null, null, null);
        }
        $email = $_GET[self::GET_EMAIL];
        $firstName = $_GET[self::GET_FIRST_NAME] ?? null;
        $lastName = $_GET[self::GET_LAST_NAME] ?? null;   
        $age = $_GET[self::GET_AGE] ?? null;

        return new Survey($email, $firstName, $lastName, $age);
    }
}