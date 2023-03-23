<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use Mockery\Adapter\Phpunit\MockeryTestCase;

/* php ./vendor/phpunit/phpunit/phpunit tests/GestionEauServiceTest.php

Commande pour lancer les tests (ne fonctionne pas chez moi sans le 'php' devant) 

*/

require __DIR__ . '/../vendor/autoload.php';

class GestionEauServiceTest extends MockeryTestCase {

    public function test_() {

        $this->assertSame(3, 2 + 1);
    }

}
