<?php
require_once "utils.php";

$pdo = connexionBdd();
$typeRequete = $_SERVER['REQUEST_METHOD'];

switch ($typeRequete) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM joueur");
        $joueurs = $stmt->fetchAll();

        foreach ($joueurs as &$joueur) {
            $joueur['image'] = $joueur['image'] ? base64_encode($joueur['image']) : null;
        }

        envoyerDonnees($joueurs);
        break;

    case 'POST':
        $data = recupererDonnees();

        if (!isset($data['pseudo'], $data['role'], $data['rarete'], $data['image'])) {
            envoyerDonnees(["erreur" => "Champs manquants"], 400);
        }

        $stmt = $pdo->prepare("INSERT INTO joueur (pseudo, role, rarete, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $data['pseudo'],
            $data['role'],
            $data['rarete'],
            base64_decode($data['image'])
        ]);

        envoyerDonnees(["message" => "Joueur ajouté avec succès."]);
        break;

    case 'PUT':
        $data = recupererDonnees();

        if (!isset($data['idJoueur'], $data['pseudo'], $data['role'], $data['rarete'], $data['image'])) {
            envoyerDonnees(["erreur" => "Champs manquants"], 400);
        }

        $stmt = $pdo->prepare("UPDATE joueur SET pseudo=?, role=?, rarete=?, image=? WHERE idJoueur=?");
        $stmt->execute([
            $data['pseudo'],
            $data['role'],
            $data['rarete'],
            base64_decode($data['image']),
            $data['idJoueur']
        ]);

        envoyerDonnees(["message" => "Joueur mis à jour avec succès."]);
        break;

    case 'DELETE':
        $data = recupererDonnees();

        if (!isset($data['idJoueur'])) {
            envoyerDonnees(["erreur" => "idJoueur requis"], 400);
        }

        $stmt = $pdo->prepare("DELETE FROM joueur WHERE idJoueur = ?");
        $stmt->execute([$data['idJoueur']]);

        envoyerDonnees(["message" => "Joueur supprimé avec succès."]);
        break;

    default:
        envoyerDonnees(["erreur" => "Méthode non autorisée."], 405);
        break;
}
