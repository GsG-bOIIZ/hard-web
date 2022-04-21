<?php
header('Content-Type: text/plain');
require_once('./src/common.inc.php'); 

$requestSurveyLoader = new RequestSurveyLoader();
$surveyFileStorage = new SurveyFileStorage();

$survey = $requestSurveyLoader->createSurveyInfo();
echo 'Входящие параметры' . PHP_EOL . PHP_EOL;
SurveyPrinter::viewData($survey);
echo PHP_EOL;

SurveyFileStorage::saveSurveyToFile($survey);

echo 'Пользователь, взятый из файла' . PHP_EOL . PHP_EOL;
$surveyFile = $surveyFileStorage->loadSurveyFromFile($survey->getEmail());
SurveyPrinter::viewData($surveyFile);