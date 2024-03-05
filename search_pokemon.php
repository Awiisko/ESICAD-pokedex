<?php
require_once("head.php");
require_once("database-connection.php");

if (isset($_GET['q'])) {
    $NomPoke = $_GET['q'];

     $query = $databaseConnection->query("SELECT * FROM pokemon WHERE NomPokemon LIKE '" . $NomPoke . "%' ORDER BY NomPokemon");

    if (!$query) {
        echo "Erreur SQL : " . $databaseConnection->error;
    } else {
        echo '<table>';
        while ($pokemon = $query->fetch_assoc()) {
            echo '<tr>';
            echo '<td><a href="pokemon_details.php?id=' . $pokemon['IdPokemon'] . '"><img src="' . $pokemon['urlPhoto'] . '" alt="' . $pokemon['NomPokemon'] . '"></a></td>';
            echo '<td><a href="pokemon_details.php?id=' . $pokemon['IdPokemon'] . '">' . $pokemon['NomPokemon'] . '</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
} else {
    echo "Aucun terme de recherche fourni.";
}

require_once("footer.php");
?>