<?php

namespace iut;

interface EtatService
{
    /**
     * Permet d'alerter l'État du manque critique d'eau sur votre commune
     */
    public function sendAlerteEau();
}

?>