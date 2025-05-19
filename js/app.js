fetch("php/random_player.php")
  .then(res => res.json())
  .then(players => {
    console.log("Joueurs aléatoires :", players);
    // Tu peux maintenant les afficher dans le DOM
  })
  .catch(error => {
    console.error("Erreur côté frontend :", error);
  });
