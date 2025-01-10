<?php
namespace Model\Quiz;
use Model\Quiz\Question;
class Radio extends Question
{
    public function renderQuestion(): string
    {
        $html = "<h3>" . $this->label . "</h3>";
        foreach ($this->choices as $i => $choice) {
            $html .= "<input type='radio' name='$this->name' value='$this->name-$i' id='$this->name-$i'" . ($i == 0 ? "checked='checked'" : "") . ">";
            $html .= "<label for='$this->name-$i'>$choice</label>";
        }
        return $html;
    }
    public function renderAnswer(): string
    {
        return "";
    }
}