<?php
declare(strict_types=1);
use Model\DataSources\JsonProvider;
use Model\Quiz\Checkbox;
use Model\Quiz\Quiz;
use Model\Quiz\Radio;
use Model\Quiz\Text;
spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';
    require_once('_inc/classes/' . $path);
});
$jsonProvider = new JsonProvider("questions.json");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderAnswer();
} else {
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderQuestion();
}