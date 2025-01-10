<?php
declare(strict_types=1);
namespace Model\Quiz;
use Model\Quiz\Question;
class Checkbox extends Question
{
    public function renderQuestion(): string
    {
        $html = "<h2>" . $this->label . "</h2>";
        $i = 0;
        foreach ($this->choices as $c) {
            $i += 1;
            $html .= "<input type='checkbox' name='$this->name' value='$this->name-$i' id='$this->name-$i'>";
            $html .= "<label for='$this->name-$i'>$c</label>";
        }
        return $html;
    }
    public function renderAnswer(): string
    {
        return "";
    }
}