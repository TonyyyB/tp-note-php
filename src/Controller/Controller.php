<?php
declare(strict_types=1);
namespace Controller;
abstract class Controller
{
    protected string $redirect;
    public function __construct(string $redirect)
    {
        $this->redirect = $redirect;
    }
    abstract public function index();
    protected function redirect(): void
    {
        header("Location: " . $this->redirect);
        exit();
    }
}