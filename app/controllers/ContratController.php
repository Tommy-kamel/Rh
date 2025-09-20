<?php

namespace app\controllers;
use app\models\AnnonceModel;
use Flight;
class ContratEssaiController{

    public function __construct()
    {

    }
    
    public function showForm() {
        Flight::render('FormContratEssai');
    }

}