<?php
declare(strict_types=1);
namespace Controller;

use Forms\SignUpForm;
use Model\DataSources\DataBaseProvider;
class SignUpController extends Controller
{
    public function get(): void
    {
        if ($this->isUserLoggedIn()) {
            $this->redirectTo("/");
        }

        $this->render('signup', ['form' => new SignUpForm("/signup")]);
    }
    public function post(): void
    {
        $dbp = new DataBaseProvider();
        $error = null;
        if ($dbp->inscription($_POST['identifiant'], $_POST['prenom'], $_POST['nom'], $_POST['password'])) {
            $this->redirectTo("/login");
        } else {
            $error = "Erreur lors de l'inscription";
            $this->render('signup', ['form' => new SignUpForm("/signup"), 'error' => $error]);
        }
    }
}