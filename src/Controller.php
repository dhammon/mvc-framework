<?php
namespace Core;

interface Controller
{
    function __construct();
    function render(\Core\Entity $entity);
    function default();
}