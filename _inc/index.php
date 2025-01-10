<?php
declare(strict_types=1);
use Model\Quiz\Quiz;
use Model\Quiz\Radio;
use Model\Quiz\Text;
spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';
    require_once('_inc/classes/' . $path);
});
$radio = new Radio("maradio", "Ceci est un test", "rep1", 10, [
    array(
        "name" => "rep1",
        "text" => "Réponse 1"
    ),
    array(
        "name" => "rep2",
        "text" => "Réponse 2"
    ),
]);
$text = new Text("montexte", "Vas-y réponds", "cmoua", 50);
$quiz = new Quiz("Mon quizz", [$radio, $text]);
echo $quiz->renderQuestion();