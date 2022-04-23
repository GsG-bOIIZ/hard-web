<?php

namespace App\Module\Survey;

class SurveyFileStorage
{
    private const FOLDER_DATA = './data/';
    private const FILE_FIRST_NAME = 'First Name';
    private const FILE_LAST_NAME = 'Last Name';
    private const FILE_EMAIL = 'Email';
    private const FILE_AGE = 'Age';
    private const DELIMETER_PARAMETERS = ': ';

    private static function createFileName(?string $email): string
    {
        return self::FOLDER_DATA . $email . '.txt';
    }

    public static function loadSurveyFromFile(?string $email): Survey
    {
        $fileName = self::createFileName($email);
        if ((!$email || $email !== '') && file_exists($fileName))
        {
            $tempArray = file($fileName);
            $arrayData = [];
            foreach ($tempArray as $line)
            {
                $tempString = explode(self::DELIMETER_PARAMETERS, $line);
                $arrayData[$tempString[0]] = trim($tempString[1]) ?? null;
            }
            return new Survey(
                $arrayData[self::FILE_EMAIL], 
                $arrayData[self::FILE_FIRST_NAME], 
                $arrayData[self::FILE_LAST_NAME], 
                $arrayData[self::FILE_AGE]
            );
        }
        return new Survey(null, null, null, null);         
    }

    public static function saveSurveyToFile(Survey $survey): string
    {        
        if (!$survey->getEmail())
        {
            return "Survey don't saved";
        }

        $fileName = self::createFileName($survey->getEmail());
        $tempEmail = self::FILE_EMAIL . self::DELIMETER_PARAMETERS;
        $tempFirstName = self::FILE_FIRST_NAME . self::DELIMETER_PARAMETERS;
        $tempLastName = self::FILE_LAST_NAME . self::DELIMETER_PARAMETERS;        
        $tempAge = self::FILE_AGE . self::DELIMETER_PARAMETERS;

        if (file_exists($fileName))
        {
            $tempArray = file($fileName);
            if (!($survey->getFirstName() === null))
            {
                $tempArray[1] = $tempFirstName . $survey->getFirstName() . "\n";
            }
            if (!($survey->getLastName() === null))
            {
                $tempArray[2] = $tempLastName . $survey->getLastName() . "\n";
            }
            if (!($survey->getAge() === null))
            {
                $tempArray[3] = $tempAge . $survey->getAge();
            }
            file_put_contents($fileName, $tempArray);
            return 'Survey updated';
        }
        else
        {
            if (!file_exists(self::FOLDER_DATA))
            {
                mkdir(self::FOLDER_DATA);
            }
            $surveyTxt = fopen($fileName, "w");
            fwrite($surveyTxt, $tempEmail . $survey->getEmail() . "\n");
            fwrite($surveyTxt, $tempFirstName . $survey->getFirstName() . "\n");
            fwrite($surveyTxt, $tempLastName . $survey->getLastName() . "\n");            
            fwrite($surveyTxt, $tempAge . $survey->getAge());
            fclose($surveyTxt);
            return 'Survey saved'; 
        }
        
    }   
}