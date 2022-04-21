<?php

class SurveyPrinter
{
    public static function viewData(Survey $survey): void
    {
        if (!$survey->getEmail() || $survey->getEmail() === '')
        {
            echo PHP_EOL . "Unable to output data" . PHP_EOL;
            return;
        }
        echo
            'Email: ' . $survey->getEmail() . PHP_EOL .
            'First Name: ' . $survey->getFirstName() . PHP_EOL .
            'Last Name: ' . $survey->getLastName() . PHP_EOL .
            'Age: ' . $survey->getAge() . PHP_EOL;
    }
}
