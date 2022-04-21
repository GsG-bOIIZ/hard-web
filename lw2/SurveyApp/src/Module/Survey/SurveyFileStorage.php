<?php

namespace App\Module\Survey;

class SurveyFileStorage
{
    private const FOLDER_DATA = './data/';
    private const FILE_FIRST_NAME = "First Name";
    private const FILE_LAST_NAME = "Last Name";
    private const FILE_EMAIL = "Email";
    private const FILE_AGE = "Age";
    private const DELIMETER_PARAMETERS = ": ";

    private static function createFileName(?string $email): string
    {
        return self::FOLDER_DATA . $email . '.txt';
    }

    public static function loadSurveyFromFile(?string $email): Survey
    {
        $fileName = self::createFileName($email);
        if ((!$email || $email !== ''))
        {
            if (file_exists($fileName))
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
            echo "File not found";
            return new Survey(null, null, null, null);             
        }  

        echo "Impossible email (for load Survey from file)";
        return new Survey(null, null, null, null);         
    }

    public static function saveSurveyToFile(Survey $survey): void
    {        
        if (!$survey->getEmail())
        {
            echo "Impossible email (for save Survey to file) ";
            echo "Survey don't saved";
            return;
        }

        $fileName = self::createFileName($survey->getEmail());
        $tempEmail = self::FILE_EMAIL . self::DELIMETER_PARAMETERS;
        $tempFirstName = self::FILE_FIRST_NAME . self::DELIMETER_PARAMETERS;
        $tempLastName = self::FILE_LAST_NAME . self::DELIMETER_PARAMETERS;        
        $tempAge = self::FILE_AGE . self::DELIMETER_PARAMETERS;

        if (file_exists($fileName))
        {
            $tempArray = file($fileName);
            if ($survey->getFirstName() !== null)
            {
                $tempArray[1] = $tempFirstName . $survey->getFirstName();
            }
            if ($survey->getLastName() !== null)
            {
                $tempArray[2] = $tempLastName . $survey->getLastName();
            }
            if ($survey->getAge() !== null)
            {
                $tempArray[3] = $tempAge . $survey->getAge();
            }
            file_put_contents($fileName, $tempArray);
            echo "Survey updated";
        }
        else
        {
            if (!file_exists(self::FOLDER_DATA))
            {
                mkdir(self::FOLDER_DATA);
            }
            $surveyTxt = fopen($fileName, "w");
            fwrite($surveyTxt, $tempEmail . $survey->getEmail() . PHP_EOL);
            fwrite($surveyTxt, $tempFirstName . $survey->getFirstName() . PHP_EOL);
            fwrite($surveyTxt, $tempLastName . $survey->getLastName() . PHP_EOL);            
            fwrite($surveyTxt, $tempAge . $survey->getAge());
            fclose($surveyTxt);
            echo "Survey saved"; 
        }
        
    }   
}