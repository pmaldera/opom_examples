<?php

// Le echo d'un bool affiche '' pour false et 1 pour true, on règle ça ici
function _bool($b){
    return $b ? 'true' : 'false';
}

?>