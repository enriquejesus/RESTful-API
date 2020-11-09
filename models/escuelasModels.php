<?php
    require 'db.php';

    class EscuelasModel extends DB{
        

        function nuevoRecurso($recurso){
            $query = $this->connect()->prepare('INSERT INTO multimedia ( nombre_recurso , ruta , ext_recurso ,institucionesid_institucion)
             VALUES ( :nombre_recurso, :ruta, :ext_recurso , :institucionesid_institucion)'); 
             $query->execute([ 
                'nombre_recurso' => $recurso['nombre_recurso'],
                'ruta' => $recurso['ruta'],
                'ext_recurso' => $recurso['ext_recurso'],
                'institucionesid_institucion' => $recurso['institucionesid_institucion']
                ]);
        }

        function eliminarRecurso($id_multimedia){
            $query = $this->connect()->prepare('DELETE  FROM multimedia  WHERE id_multimedia= :id_multimedia');
            $query->execute(['id_multimedia' => $id_multimedia]);
    
            return $query;
        }
    

    }
?>