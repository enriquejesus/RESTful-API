<?php
$nombre_fichero = '../multimedia/196W0006 OVH.pdf';

if (file_exists($nombre_fichero)) {
    echo "El fichero $nombre_fichero existe";
} else {
    echo "El fichero $nombre_fichero no existe";
}
?>