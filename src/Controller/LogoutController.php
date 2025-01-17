<?php
declare(strict_types=1);
namespace Controller;
class LogoutController extends Controller
{
    public function get(): void
    {
        unset($_SESSION['user']);
        $this->redirectTo("/");
    }
    public function post(): void
    {
        $this->get();
    }

    private function isUserLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}