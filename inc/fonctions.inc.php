<?php

// fonction de debug

function debug($var, $mode = 1) 
{
    echo '<div style="background-color: pink; padding: 5px;" >';
    if ($mode === 1) {
        echo '<pre>'; print_r($var); echo '</pre>';
    } else {
        echo '<pre>'; var_dump($var); echo '</pre>';
    }

    echo '</div>';
}

// fonction exec_req pour exécuter une requête plus simplement
function exec_req($req) 
{
    global $pdo;
    $resultat = $pdo->query($req);
    return $resultat;
}

?>