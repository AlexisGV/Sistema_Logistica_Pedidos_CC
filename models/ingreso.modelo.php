<?php

    require_once "conexion.php";

    Class ModeloIngreso{

        static public function mdlIngreso($tabla, $item, $item2, $valor){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item OR $item2=:$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;

        }

    }

?>