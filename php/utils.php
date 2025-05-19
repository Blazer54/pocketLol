<?php

require_once("constantes.php");

function connexionBdd(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $dsn = 'mysql:host=' . BDD_HOTE . ';dbname=' . BDD_NOM . ';charset=' . BDD_CHARSET;
        $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, BDD_UTILISATEUR, BDD_MOT_DE_PASSE, $options);
    }
    return $pdo;
}

function envoyerDonnees(array $donnees, int $statutHttp = 200) : void
{
    // On spécifie que tout s'est bien déroulé
    http_response_code($statutHttp);
    // Spécifie le type de fichier transmis et son jeu de caractères
    header('Content-type: application/json; charset=utf-8');
    // Affiche les données fournies (normalement un tableau) en json
    echo json_encode($donnees);
    // Stoppe l'exécution de l'application
    die();
}

function recupererDonnees() : array
{
$contenu = file_get_contents("php://input"); // Récupère les données brutes
if ($contenu === false) { // Si les données n'ont pas pu être lues
return [];
}
$donnees = json_decode($contenu, true); // Décodage des données
if (!is_array($donnees)) { // Si les données n'ont pas pu être décodées
return [];
}
return $donnees; // On retourne le tableau de données
}

function recupererJeton(): string|false
{
    $entetes = getallheaders(); // 1.
    if (!array_key_exists('Authorization', $entetes)) { // 2.
        return false;
    }
    $bearer = explode(' ', $entetes['Authorization']); // 3.
    if ($bearer[0] === 'Bearer') { // 3.
        return $bearer[1];
    }
    return false;
}