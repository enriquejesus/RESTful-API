<?php
    require '../controllers/apiEscuelas.php';

    $api = new ApiEscuelas();
    
    $id = '';

    if(isset($_POST['id_multimedia'])  ){
        $item =  $_POST['id_multimedia']; 
        $api->deleteFile($item);
    }else{
        $api->error('Error al llamar la API');
    }
?>