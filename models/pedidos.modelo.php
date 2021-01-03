<?php

    require_once "conexion.php";

    class ModeloPedidos{

        /*=========================================================
        TREAR TODOS LOS REGISTROS DE (MARCA, FORMA, ACABADO, CORTE)
        =========================================================*/
        static public function mdlTraerRegistros($tabla, $item, $excepcion){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item != :$item ORDER BY $item ASC");
            $stmt->bindParam(":".$item, $excepcion, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

            $stmt->closeCursor();
            $stmt = null;

        }

    }

?>