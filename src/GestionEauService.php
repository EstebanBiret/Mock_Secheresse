<?php

namespace iut;
use iut\InfoSecheresseService;
use iut\EtatService;
use iut\MunicipalServices;

class GestionEauService {

    private $infoSecheresse;
    private $serviceEtat;
    private $servicesMunicipaux;

    function __construct(InfoSecheresseService $infoSecheresse, EtatService $serviceEtat, MunicipalServices $servicesMunicipaux) {
        $this->infoSecheresse = $infoSecheresse; 
        $this->serviceEtat = $serviceEtat;
        $this->servicesMunicipaux = $servicesMunicipaux;
    }

    public function checkEtatSecheresse() {
        $previsionSecheresse = $this->infoSecheresse->previsionDureeSecheresse(); // Récupération de la prévision de la durée de la sécheresse
        $reserveEau = $this->infoSecheresse->reserveEauMunicipale(); // Récupération de l'état des réserves d'eau potable du village

        if ($previsionSecheresse > 10) {

            //On envoie un bulletin municipal de restriction d'eau aux habitants filous
            $this->servicesMunicipaux->sendRestrictionEauInformation();
        }

        if ($previsionSecheresse > 20 && $reserveEau < 100) {
            // Appelle un service de livraison d'eau par camion citernes
            //try {
                $this->servicesMunicipaux->callLivraisonCiterneEau();
            /*} catch (CiterneVideException $e) {
                // Si les citernes ne peuvent plus livrer d'eau, envoie un message d'alerte aux habitants
                $this->servicesMunicipaux->sendRestrictionEauInformation();
            }*/

        } 
    
    }

}

?>
