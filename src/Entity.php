<?php
namespace Core;

interface Entity
{
    function setView($view);
    function setErrorMessageAndDisplay();
    function getView();
    function getErrorMessage();
    function getErrorDisplay();
}