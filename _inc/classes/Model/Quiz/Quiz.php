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

    private function renderUsername(): string
    {
        $html = "<h3>Merci de renseigner votre nom et votre prénom</h3>";
        $html .= "<table>";
        $html .= "<tr>";
        $html .= "<td><label for='lastname'>Nom</label></td>";
        $html .= "<td><input type='text' name='lastname' required></label></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><label for='firstname'>Prénom</label></td>";
        $html .= "<td><input type='text' name='firstname' required></label></td>";
        $html .= "</tr>";
        $html .= "<tr>";
        $html .= "<td><input type='submit' value='Envoyer'></td>";
        $html .= "</table>";
        return $html;
    }

    public function renderQuestion(): string
    {
        $html = "<h2>Bienvenue sur notre Quiz !</h2>";
        $html .= "<form method='POST' action='index.php'><ol>";
        foreach ($this->questions as $q) {
            $html .= "<li>";
            $html .= $q->renderQuestion();
            $html .= "</li>";
        }
        $html .= "</ol>";
        $html .= $this->renderUsername();
        return $html;
    }
    public function renderAnswer(): string
    {
        $finalScore = 0;
        $html = "<h2>Voici les répéonses: </h2><ol>";
        foreach ($this->questions as $i => $q) {
            $html .= "<li>";
            $html .= $q->renderAnswer([]);
            $html .= "</li>";
        }
        $html .= "</ol>";
        $html .= "<h3>Merci de votre participation</h3>";
        return $html;
    }
}