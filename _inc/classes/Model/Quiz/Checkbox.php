<?php
declare(strict_types=1);
namespace Model\Quiz;
use Model\Quiz\Question;
class Checkbox extends Question
{
    public function renderQuestion(): string
    {
        $html = "<h3>" . $this->label . "</h3>";
        foreach ($this->choices as $i => $c) {
            $html .= "<input type='checkbox' name='$this->name[]' value='$c' id='$this->name-$i'>";
            $html .= "<label for='$this->name-$i'>$c</label>";
        }
        return $html;
    }
    public function renderAnswer(string|array $answer): string
    {
        $html = "<h3>" . $this->label . "</h3>";
        foreach ($this->choices as $i => $c) {
            $html .= "<input type='checkbox' name='$this->name' disabled='disabled' value='$this->name-$i' id='$this->name-$i' " . (in_array($c, $this->answer) ? "checked='checked'" : "") . ">";
            $html .= "<label for='$this->name-$i'>$c</label>";
        }
        return $html;
    }
}