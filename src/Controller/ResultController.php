<?php
declare(strict_types=1);
namespace Controller;
use Model\DataSources\DataBaseProvider;
use Model\DataSources\JsonProvider;
use Model\Quiz\Quiz;
class ResultController extends Controller
{
    public function get(): void
    {
        if (!$this->isUserLoggedIn()) {
            $this->redirectTo("/");
        }

        $db = new DataBaseProvider();
        $this->render('result', ["scores" => $db->getScore($_SESSION['user'])]);
    }
}