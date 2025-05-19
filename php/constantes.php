<?php
// COnstantes liées à la base de données
define('BDD_HOTE', 'localhost');
define('BDD_NOM', 'NexusShop');
define('BDD_UTILISATEUR', 'root');
define('BDD_MOT_DE_PASSE', 'Super');
define('BDD_CHARSET', 'utf8mb4');

// Constantes liées au code HTTP
define('STATUT_HTTP_OK', 200);
define('STATUT_HTTP_CREATED', 201);
define('STATUT_HTTP_MAUVAISE_REQUETE', 400);
define('STATUT_HTTP_NON_AUTORISE', 401);
define('STATUT_HTTP_INTERDIT', 403);
define('STATUT_HTTP_NON_TROUVE', 404);
define('STATUT_HTTP_METHODE_NON_AUTORISEE', 405);
define('STATUT_HTTP_ERREUR_DU_SERVEUR', 500);
