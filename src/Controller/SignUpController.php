<?php
declare(strict_types=1);
namespace Controller;
class SignUpController extends Controller
{
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            $this->redirectTo("/");
        }

        $this->render('home', []);
    }

    private function isUserLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}