<?php
declare(strict_types=1);
namespace Controller;
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Quiz;
class AnswerController extends Controller
{
    public function post(): void
    {
        $jsonProvider = new JsonProvider($_SERVER['DOCUMENT_ROOT'] . "/../data/questions.json");
        $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
        $db = new DataBaseProvider();
        $this->render('answer', ["quiz" => $quiz]);
        $db->ajouterScore($_SESSION['user'], $_SESSION['score']);
    }
}