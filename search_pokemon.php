<?php
require_once("database-connection.php");
$Nom_Pokemon = '';
$Nom_Pokemon = $_POST['NomPokemon'] ?? 0;

$sql = "SELECT * FROM pokemon WHERE NomPokemon LIKE '%$Nom_Pokemon%'";

$resultat = $databaseConnection->query($sql);

if ($resultat->num_rows > 0) {
    while ($pokemon = $resultat->fetch_assoc()) {
        echo '<h1>' . $pokemon['NomPokemon'] . '</h1>';
        echo '<img src="' . $pokemon['urlPhoto'] . '" alt="' . $pokemon['NomPokemon'] . '">';
        echo '<p>PV: ' . $pokemon['PV'] . '</p>';
        echo '<p>Attaque: ' . $pokemon['Attaque'] . '</p>';
        echo '<p>Défense: ' . $pokemon['Defense'] . '</p>';
        echo '<p>Vitesse: ' . $pokemon['Vitesse'] . '</p>';
        echo '<p>Spécial: ' . $pokemon['Special'] . '</p>';

        $sqlEvolution = $databaseConnection->query("SELECT idEvolution FROM evolutionpokemon WHERE idPokemon = " . $pokemon['IdPokemon']);
        if ($sqlEvolution->num_rows > 0) {
            $evolution = $sqlEvolution->fetch_assoc();
            $sqlEvolutionDetails = $databaseConnection->query("SELECT * FROM pokemon WHERE IdPokemon = " . $evolution['idEvolution']);
            if ($sqlEvolutionDetails->num_rows > 0) {
                $evolutionDetails = $sqlEvolutionDetails->fetch_assoc();
                echo '<h2>Évolution : ' . $evolutionDetails['NomPokemon'] . '</h2>';
                echo '<img src="' . $evolutionDetails['urlPhoto'] . '" alt="' . $evolutionDetails['NomPokemon'] . '">';
                echo '<p>PV: ' . $evolutionDetails['PV'] . '</p>';
                echo '<p>Attaque: ' . $evolutionDetails['Attaque'] . '</p>';
                echo '<p>Défense: ' . $evolutionDetails['Defense'] . '</p>';
                echo '<p>Vitesse: ' . $evolutionDetails['Vitesse'] . '</p>';
                echo '<p>Spécial: ' . $evolutionDetails['Special'] . '</p>';
            }
        }
    }
} else {
    echo "Aucun Pokémon trouvé avec ce nom.";
}

$databaseConnection->close();
?>
