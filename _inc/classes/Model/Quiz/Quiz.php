<?php
namespace Model\Quiz;
class Quiz
{
    private string $title;
    private array $questions;
    public function __construct(string $title, array $questions)
    {
        $this->title = $title;
        $this->questions = $questions;
    }

    public function renderQuestion(): string
    {
        $html = "<form method='POST' action='index.php'><ol>";
        foreach ($this->questions as $q) {
            $html .= "<li>";
            $html .= $q->renderQuestion();
            $html .= "</li>";
        }
        $html .= "</ol><input type='submit' value='Envoyer'></form>";
        return $html;
    }
    public function renderAnswer(): string
    {
        return "";
    }
}