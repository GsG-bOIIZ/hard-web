<?php

class SurveyPrinter
{
    public static function viewData(Survey $survey): void
    {
        if (!$survey->getEmail())
        {
            echo"<br>Unable to output data<br>";
            return;
        }
        echo
            'Email: ' . $survey->getEmail() . "<br>" .
            'First Name: ' . $survey->getFirstName() . "<br>" .
            'Last Name: ' . $survey->getLastName() . "<br>" .
            'Age: ' . $survey->getAge() . "<br>";
    }
}
