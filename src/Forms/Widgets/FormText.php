<?php
declare(strict_types=1);
namespace Forms\Widgets;
use Forms\Widgets\FormWidget;
class FormText implements FormWidget
{
    private string $id;
    private string $label;
    private string|int|float $value;

    public function __construct(string $id, string $label, string|int|float $value)
    {
        $this->id = $id;
        $this->label = $label;
        $this->value = $value;
    }
    public function render(): string
    {
        $html = "<td>";
        $html .= "<label for='{$this->id}' class='form-label'>{$this->label}:</label>";
        $html .= "</td><td>";
        $html .= "<input type='text' id='{$this->id}' name='{$this->id}' value='{$this->value}' class='form-input form-input-text'>";
        $html .= "</td>";
        return $html;
    }
}