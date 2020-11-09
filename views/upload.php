<?php
    require '../controllers/apiEscuelas.php';

    $api = new ApiEscuelas();
    
    $nombre_recurso = '';
    $ruta  = '';
    $ext_recurso  = '';
    $institucionesid_institucion  = '';

    if(isset($_POST['nombre_recurso']) && isset($_FILES['ruta']) 
       && isset($_POST['ext_recurso']) && isset($_POST['institucionesid_institucion'])){
        if($api->subirArchivo($_FILES['ruta'])){  
            $item = array(
                'nombre_recurso' => $_POST['nombre_recurso'],
                'ruta' => $api->getFiles(),
                'ext_recurso' => $_POST['ext_recurso'],
                'institucionesid_institucion' => $_POST['institucionesid_institucion']
            );
            $api->addRecurso($item);
        }
        else{
            $api->error('Error con el archivo: ' .$api->getError());
        }
    }
    else{
        $api->error('Error al llamar la API');
    }

?>