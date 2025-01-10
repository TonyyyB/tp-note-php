<?php
namespace Model\Quiz;
use Model\Quiz\Question;
class Text extends Question
{

    public function renderQuestion(): string
    {
        return "<h3>" . $this->label . "</h3><input type='text' name='$this->name'>";
    }
    public function renderAnswer(string|array $answer): string
    {
        return "<h3>" . $this->label . "</h3><input type='text' disabled='disabled' name='$this->name' value='$this->answer'>";
        ;
    }
}