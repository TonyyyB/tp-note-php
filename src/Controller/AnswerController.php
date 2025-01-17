<?php
declare(strict_types=1);
namespace Controller;
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Quiz;
class AnswerController
{
    public function index()
    {
        $jsonProvider = new JsonProvider($_SERVER['DOCUMENT_ROOT'] . "/../data/questions.json");
        $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
        echo $quiz->renderAnswer($_POST);
        $db = new DataBaseProvider();
        $db->ajouterScore($_POST['lastname'], $_POST['firstname'], $_SESSION['score']);
    }
}