<?php

class DB{
    /**
     * Se define las variables privadas las cuales son 
     * para tener los accesos con las variables siguientes
     */
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        /*
         * Se declaran los datos del servidor, base de datos,
         *  caracteres y usuarios
         */
        $this->host     = 'localhost';
        $this->db       = 'plataforma_det';
        $this->user     = 'root';
        $this->password = '';
        $this->charset  = 'utf8mb4';
    }

    

    function connect(){ //Inicia la función connect, donde se hace el query de conexión
    
        try{ //Inicio del método try para asegurar la conexión al servidor

            /*
             *De la linea 35 - 40 se declara el query de conexión con el servidor, pasando los parametros
             *Y variables antes asignados 
             */
            $connection = "mysql:host=".$this->host.";dbname=" . $this->db . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
           
            $pdo = new PDO($connection,$this->user,$this->password); //Pasa la conexión, user y password mediante PDO
            
            return $pdo; //retorna PDO, Que es la conexión hacia el servidor


        }//Fin de la funcion Try
        catch(PDOException $e){//Inicia catch 
             //En caso de que el servidor no se encuentre, no este disponible  marca el error de conexión
            print_r('Error connection: ' . $e->getMessage());
        }   //Termina catch
    } //Termina la función connect
}
?>