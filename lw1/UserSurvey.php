<?php
//header('Content-Type: text/plain');
require_once('./src/common.inc.php'); 

$requestSurveyLoader = new RequestSurveyLoader();
$surveyFileStorage = new SurveyFileStorage();

$survey = $requestSurveyLoader->createSurveyInfo();
echo 'Входящие параметры<br><br>';
SurveyPrinter::viewData($survey);
echo '<br>';

SurveyFileStorage::saveSurveyToFile($survey);

echo 'Пользователь, взятый из файла<br><br>';
$surveyFile = $surveyFileStorage->loadSurveyFromFile($survey->getEmail());
SurveyPrinter::viewData($surveyFile);