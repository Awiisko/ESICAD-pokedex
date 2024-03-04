<!-- 
    Ce fichier représente la page de liste par type de pokémon du site.
-->
<?php
require_once("head.php");
require_once("database-connection.php");

$queryTypes = $databaseConnection->query("SELECT DISTINCT libelleType FROM typepokemon ORDER BY libelleType");

if (!$queryTypes) {
    echo "Erreur SQL : " . $databaseConnection->error;
} else {
    while ($type = $queryTypes->fetch_assoc()) {
        echo '<h2>' . $type['libelleType'] . '</h2>';
        echo '<table>';

        $queryPokemon = $databaseConnection->query("SELECT pokemon.IdPokemon, pokemon.NomPokemon, pokemon.urlPhoto FROM pokemon INNER JOIN typepokemon ON pokemon.IdTypePokemon = typepokemon.IdType WHERE typepokemon.libelleType = '" . $type['libelleType'] . "' ORDER BY pokemon.IdPokemon");

        if (!$queryPokemon) {
            echo "Erreur SQL : " . $databaseConnection->error;
        } else {
            while ($pokemon = $queryPokemon->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $pokemon['IdPokemon'] . '</td>';
                echo '<td><a href="pokemon_details.php?id=' . $pokemon['IdPokemon'] . '"><img src="' . $pokemon['urlPhoto'] . '" alt="' . $pokemon['NomPokemon'] . '"></a></td>';
                echo '<td><a href="pokemon_details.php?id=' . $pokemon['IdPokemon'] . '">' . $pokemon['NomPokemon'] . '</a></td>';
                echo '</tr>';
            }
        }

        echo '</table>';
    }
}

require_once("footer.php");
?>