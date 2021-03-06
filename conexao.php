<?php

class Conexao
{
    private static $connection;

    private function __construct(){}

    public static function getConnection() {

        switch (DB_DRIVER){
            case 'sqlsrv':
                $pdoConfig  = DB_DRIVER . ":". "Server=" . DB_HOST . ";";
                $pdoConfig .= "Database=".DB_NAME.";";
            break;
            case 'mysql' :
                $pdoConfig  = DB_DRIVER . ":". "host=" . DB_HOST . ";";
                $pdoConfig .= "dbname=".DB_NAME.";";
            break;
            }

        try {
            if(!isset($connection)){
                $connection =  new PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
                return $connection;
            } catch (PDOException $e) {
                $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
                $mensagem .= "\nErro: " . $e->getMessage();
                throw new Exception($mensagem);
         }
     }
}
?>