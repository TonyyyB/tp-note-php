<?php
declare(strict_types=1);
require $_SERVER['DOCUMENT_ROOT'] . '/../src/autoloader.php';
Autoloader::register();
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Quiz;
session_start();
$jsonProvider = new JsonProvider($_SERVER['DOCUMENT_ROOT'] . "/../data/questions.json");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderAnswer($_POST);
    $db = new DataBaseProvider();
    $db->ajouterScore($_POST['lastname'], $_POST['firstname'], $_SESSION['score']);
} else {
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderQuestion();
}
