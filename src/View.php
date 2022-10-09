<?php
namespace Core;

interface View
{
    function __construct(Renderer $renderer, Entity $entity);
    function render();
}