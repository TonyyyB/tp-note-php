<?php
declare(strict_types=1);
namespace Model\DataSources;
use Model\Quiz\Quiz;
use Model\Quiz\Radio;
use Model\Quiz\Text;
use Model\Quiz\Checkbox;
class JsonProvider
{
    private $jsonFile;
    private $questions;
    public function __construct(string $jsonFile)
    {
        $this->jsonFile = $jsonFile;
        $this->readQuestions();
    }

    private function readQuestions(): void
    {
        $json = json_decode(file_get_contents($this->jsonFile), true);
        foreach ($json as $question) {
            switch ($question['type']) {
                case 'text':
                    $this->questions[] = $this->createText($question);
                    break;
                case 'radio':
                    $this->questions[] = $this->createRadio($question);
                    break;
                case 'checkbox':
                    $this->questions[] = $this->createCheckbox($question);
                    break;
                default:
                    # code...
                    break;
            }
        }
    }

    public function getQuestions(): array
    {
        return $this->questions;
    }

    private function createText(array $json): Text
    {
        return new Text($json['name'], $json['text'], null, $json['answer'], intval($json['score']));
    }

    private function createRadio(array $json): Radio
    {
        return new Radio($json['name'], $json['text'], $json['choices'], $json['answer'], intval($json['score']));
    }

    private function createCheckbox(array $json): Checkbox
    {
        return new Checkbox($json['name'], $json['text'], $json['choices'], $json['answer'], intval($json['score']));
    }
}