<?php
namespace App\Entity;

require_once __DIR__ . "/../../../src/Entity.php";

class Base implements \Core\Entity
{
    private $view;
    private $errorMessage;
    private $errorDisplay;

    function setView($view)
    {
        $this->view = $view;
    }

    function setErrorMessageAndDisplay()
    {
        if(isset($_SESSION['errorMessage']))
        {
            $this->errorMessage = $_SESSION['errorMessage'];
            $this->errorDisplay = "error_on";
        }
        else
        {
            $this->errorMessage = null;
            $this->errorDisplay = "error_off";
        }

        $_SESSION['errorMessage'] = null;
    }

    function getView()
    {
        return $this->view;
    }

    function getErrorMessage()
    {
        return $this->errorMessage;
    }

    function getErrorDisplay()
    {
        return $this->errorDisplay;
    }
}