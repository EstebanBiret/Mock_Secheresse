<?php

namespace iut;

interface InfoSecheresseService {
    /**
     * retourne une prévision du nombre de jours sans pluie à venir
     */
    public function previsionDureeSecheresse() : int;

    /**
     * retourne l'état des réserves d'eau potable du village (en m3)
     */
    public function reserveEauMunicipale() : float;
}

?>