<?php

namespace Tests;

namespace iut;

use PHPUnit\Framework\TestCase;

use iut\GestionEauService;
use iut\InfoSecheresseService;
use iut\MunicipalServices;
use iut\EtatService;

use Mockery\Adapter\Phpunit\MockeryTestCase;

/* php ./vendor/phpunit/phpunit/phpunit tests/GestionEauServiceTest.php

Commande pour lancer les tests (ne fonctionne pas chez moi sans le 'php' devant) 

*/

require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/dependencies/InfoSecheresseService.php';
require_once __DIR__ . '/../src/dependencies/MunicipalServices.php';
require_once __DIR__ . '/../src/dependencies/EtatService.php';
require_once __DIR__ . '/../src/GestionEauService.php';

class GestionEauServiceTest extends MockeryTestCase {

    public function test_() {

        $this->assertSame(3.0, 2 + 1 - 2 + (1 + 0.5 + 0.5)); //Oui, vous ne rêvez pas !
    }

    public function testSendRestrictionEauInformation() {

        //GIVEN --------------------

        // Création des doubles de test pour les services d'info sécheresse, de l'état et municipaux
        $etatServiceMock = $this->createMock(EtatService::class);
        $infoSecheresseMock = $this->createMock(InfoSecheresseService::class);
        $municipalServicesMock = $this->createMock(MunicipalServices::class);

        // On crée une instance de GestionEauService avec les doubles de test
        $gestionEauService = new GestionEauService($infoSecheresseMock, $etatServiceMock, $municipalServicesMock);

        //WHEN --------------------

        // On simule un sécheresse de plus de 10 jours
        $infoSecheresseMock->method('previsionDureeSecheresse')->willReturn(11);

        //THEN --------------------

        // On s'attend à ce que la méthode sendRestrictionEauInformation() soit appelée
        $municipalServicesMock->expects($this->once())->method('sendRestrictionEauInformation');

        // On appelle la méthode checkEtatSecheresse() de GestionEauService
        $gestionEauService->checkEtatSecheresse();
    }

    public function testcallLivraisonCiterneEau() {

        
        //GIVEN --------------------
        
        // Création des doubles de test pour les services d'info sécheresse, de l'état et municipaux
        $etatServiceMock = $this->createMock(EtatService::class);
        $infoSecheresseMock = $this->createMock(InfoSecheresseService::class);
        $municipalServicesMock = $this->createMock(MunicipalServices::class);

        // On crée une instance de GestionEauService avec les doubles de test
        $gestionEauService = new GestionEauService($infoSecheresseMock, $etatServiceMock, $municipalServicesMock);

        //WHEN --------------------

        // On simule un sécheresse de plus de 20 jours
        $infoSecheresseMock->method('previsionDureeSecheresse')->willReturn(21);

        // On simule une réserve d'eau inférieure à 100m3
        $infoSecheresseMock->method('reserveEauMunicipale')->willReturn(69.5);

        //THEN --------------------

        // On s'attend à ce que la méthode callLivraisonCiterneEau() soit appelée
        $municipalServicesMock->expects($this->once())->method('callLivraisonCiterneEau');

        /*    
        // Et bien évidemment, on s'attend à ce que la méthode sendRestrictionEauInformation() soit également appelée
        $municipalServicesMock->expects($this->once())->method('sendRestrictionEauInformation');
        */

        // On appelle la méthode checkEtatSecheresse() de GestionEauService
        $gestionEauService->checkEtatSecheresse();

    }

}
