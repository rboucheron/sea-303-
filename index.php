<?php


session_start();
require('./model/Model.php');
include('./controllers/home.php');
include('./controllers/connexion.php');
include('./controllers/inscription.php');
include('./controllers/profil.php');
include('./controllers/meteo.php');
include('./controllers/Admin.php'); 
include('./controllers/reservation.php'); 
include('./controllers/addplane.php'); 




if (isset($_GET['connexion'])) {
    connexion();
} elseif (isset($_GET['inscription'])) {
    inscription();
} elseif (isset($_GET['profil'])) {
    profil();
} elseif (isset($_GET['meteo'])) {
    LaMeteo();
}elseif (isset($_GET['admin'])){
    Admin(); 
}elseif (isset($_GET['plane'])){
    reservation(); 
}elseif (isset($_GET['newplane'])){
    addplane(); 
}elseif (isset($_GET['modify'])){
    addplane(); 
} else {
    home();
}
