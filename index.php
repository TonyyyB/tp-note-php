<?php
declare(strict_types=1);
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Checkbox;
use Model\Quiz\Quiz;
use Model\Quiz\Radio;
use Model\Quiz\Text;
spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';
    require_once('_inc/classes/' . $path);
});
session_start();
/*$jsonProvider = new JsonProvider("questions.json");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderAnswer($_POST);
} else {
    $quiz = new Quiz("Mon quizz", $jsonProvider->getQuestions());
    echo $quiz->renderQuestion();
}*/
$db = new DataBaseProvider();
$db->ajouterJoueur("toto", "nini");
print_r($db->getJoueur("toto", "nini"));
print_r($db->getJoueur("toto", "nana"));
$db->ajouterScore("toto", "nini", 20);
print_r($db->getScore("toto", "nana"));
print_r($db->getScore("toto", "nini"));