<?php
declare(strict_types=1);
namespace Controller;
class HomeController extends Controller
{
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            $this->redirectTo("/quiz");
        }

        $this->render('home', []);
    }
}