<?php
declare(strict_types=1);
namespace Controller;

use Forms\LoginForm;
use Model\DataSources\DataBaseProvider;
class LoginController extends Controller
{
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            $this->redirectTo("/quiz");
        }
        $this->render('login', ["form" => new LoginForm("/login")]);
    }
    public function post(): void
    {
        $dbp = new DataBaseProvider();
        if ($dbp->verifConnexion($_POST['identifiant'], $_POST['password'])) {
            $_SESSION['user'] = $_POST['identifiant'];
            $this->redirectTo("/quiz");
        } else {
            $this->render('login', ["form" => new LoginForm("/login"), "error" => "Identifiant ou mot de passe incorrect"]);
        }
    }
}