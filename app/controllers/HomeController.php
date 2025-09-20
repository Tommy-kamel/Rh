<?php

namespace app\controllers;
use Flight;
class HomeController{

    public function __construct()
    {

    }

    public function home(){
        Flight::render('home');
    }
}