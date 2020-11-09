<?php
    //Se incluye el archivo escuelasModel.php 
    require '../models/escuelasModels.php';

    class apiEscuelas {

        function error($mensaje){ //inició función error
            echo '<code>' . json_encode(array('mensaje' => $mensaje,JSON_UNESCAPED_UNICODE)) . '</code>'; //mensaje de error
        } //fin de función error 
    
        function exito($mensaje){//inició función error
            echo '<code>' . json_encode(array('mensaje' => $mensaje,JSON_UNESCAPED_UNICODE)) . '</code>'; //mensaje de exito
        }//fin de función error 
    
        function printJSON($array){//inició función error
            echo '<code>' . json_encode($array,JSON_UNESCAPED_UNICODE) . '</code>'; //mensaje de printJSON
         }//fin de función error 


        function addRecurso($item){
            $escuela = new EscuelasModel();
    
            $res = $escuela->nuevoRecurso($item);
            $this->exito('Nuevo registro exitoso');
        }

        function subirArchivo($file){
            $directorio = "../multimedia/";
    
            $this->archivo = basename($file["name"]);
            $archivo = $directorio . basename($file["name"]);
    
            $tipoArchivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
        
            // valida que es un archivo
            $checarSiArchivo = filesize($file["tmp_name"]);
    
            if($checarSiArchivo != false){
                //validando tamaño del archivo
                $size = $file["size"];
    
                if($size > 2000000){
                    $this->error = "El archivo tiene que ser menor a 2mb";
                    return false;
                }else{
    
                    //validar tipo de archivo
                    if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" 
                       || $tipoArchivo == "pdf" || $tipoArchivo == "doc"
                       || $tipoArchivo == "xlsx" || $tipoArchivo == "png"
                       || $tipoArchivo == "docx" || $tipoArchivo == "pptx"
                       || $tipoArchivo == "doc"){

                        // se validó el archivo correctamente
                        if(move_uploaded_file($file["tmp_name"], $archivo)){
                            //echo "El archivo se subió correctamente";
                            return true;
                        }else{
                            $this->error = "Hubo un error en la subida del archivo";
                            return false;
                        }
                    }else{
                        $this->error = "Solo se admiten archivos tipo WORD, EXCEL, PDF, IMAGENES JPG/JPEG/PNG";
                        return false;
                    }
                }
            }else{
                $this->error = "El documento no es un archivo valido";
                return false;
            }
        }

        function deleteFile($id_multimedia){
            $escuela = new EscuelasModel();
            
            $res = $escuela->eliminarRecurso($id_multimedia);
    
            if($res->rowCount() > 0){
                if(isset($_GET['ruta'])){
                $archivo = $_GET['ruta'];
                if(file_exists("../multimedia/".$archivo) ){
                unlink("../multimedia/".$archivo);
                $this->exito('Eliminado...');
                }
    
            }
                else{
                    $this->error('No se puedo eliminar archivo');
                }
            }else{
                //echo json_encode(array('mensaje' => 'No hay elementos'));
                $this->error('No hay elementos relacionados con la busqueda');
            }
        }

        function getFiles(){
            return $this->archivo;
        } 

        function getError(){
            return $this->error;
        }

    }

?>