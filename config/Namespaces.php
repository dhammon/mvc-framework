<?php
namespace Config;

class Namespaces
{
    static $namespaces = [
        'Core' => 'src/',
        'App' => 'app/',
        'App\Controller' => 'app/controllers/',
        'App\Entity' => 'app/models/entities/',
        'App\Service' => 'app/models/services/',
        'App\Mapper' => 'app/models/mappers/',
        'App\View' => 'app/views/',
        'App\Exceptions' => 'app/exceptions/',
        'Config' => 'config/',
        'Test\Unit' => 'test/unit/',
        'Test\Integration' => 'test/integration/',
        'Test\Functional' => 'test/functional/',
    ];
}
