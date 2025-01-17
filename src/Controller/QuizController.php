<?php
declare(strict_types=1);
namespace Controller;
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Quiz;
class QuizController extends Controller
{
    public function get(): void
    {
        $jsonProvider = new JsonProvider(__DIR__ . "/../../data/questions.json");
        $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
        echo $quiz->renderQuestion();
    }
}