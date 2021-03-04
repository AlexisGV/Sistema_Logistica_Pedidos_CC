<?php

    require_once "conexion.php";

    Class ModeloIngreso{

        static public function mdlIngreso($tabla, $item, $item2, $valor){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1 WHERE $item=:$item OR $item2=:$item");

            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;

        }

        static public function mdlSeleccionarUsuario( $tabla, $item, $valor ) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla INNER JOIN tipo_usuario ON Id_Tipo_User=Id_Tipo_User1 WHERE $item=:$item");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

            $stmt->execute();

            return $stmt->fetch();

            $stmt->closeCursor();
            $stmt = null;

        }

    }

?>