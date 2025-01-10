<?php
namespace Model\Quiz;
abstract class Question
{
    protected string $name;
    protected string $type;
    protected string $label;
    protected string|array $answer;
    protected int $score;
    public function __construct(string $name, string $label, string|array $answer, int $score)
    {
        $this->name = $name;
        $this->label = $label;
        $this->answer = $answer;
        $this->score = $score;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function getLabel(): string
    {
        return $this->label;
    }
    public function getAnswer(): string
    {
        return $this->answer;
    }
    public function getScore(): int
    {
        return $this->score;
    }
    public abstract function renderQuestion(): string;
    public abstract function renderAnswer(): string;
}