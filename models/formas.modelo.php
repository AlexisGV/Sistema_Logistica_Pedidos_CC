<?php

require_once "conexion.php";

class ModeloForma
{

    /*=============================================
    OBTENER LAS FORMAS
    =============================================*/
    static public function mdlTraerForma($tabla, $item, $valor)
    {
        if ($valor == null) {
            # Consulta general
            $consulta = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item != 'Otra forma' ORDER BY $item");
            $consulta->execute();

            return $consulta->fetchAll();

            $consulta->closeCursor();
            $consulta = null;
        } else {
            # Busqueda especifica
            $busqueda = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item=:$item");
            $busqueda->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $busqueda->execute();

            return $busqueda->fetch();

            $busqueda->closeCursor();
            $busqueda = null;
        }
    }

    /*=============================================
    VERIFICAR LA EXISTENCIA DE UNA FORMA
    =============================================*/
    static public function mdlVerificarForma($tabla, $datos, $bandera)
    {

        if ( $bandera ){
            #Verificar existencia al ingresar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                     WHERE REPLACE(REPLACE(REPLACE(Forma,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','')"
            );
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        } else {
            #Verificar existencia al actualizar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                WHERE REPLACE(REPLACE(REPLACE(Forma,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','') AND Id_Forma!=:idForma"
            );
            $stmt->bindParam(":idForma", $datos["idForma"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        }


        # Ejecutar la consulta
        $stmt->execute();

        # Regresa el resultado de la consulta
        return $stmt->fetch();

        # Cerrar la conexión
        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    CREAR UNA NUEVA FORMA
    =============================================*/
    static public function mdlCrearForma($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Foto_Forma, Forma) VALUES (:foto ,:nombre)");
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR FORMA
    =============================================*/
    static public function mdlActualizarForma($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET Foto_Forma=:foto,
                Forma=:nombre
            WHERE Id_Forma=:idForma"
        );
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":idForma", $datos["idForma"], PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        } else{
            $stmt->errorInfo();
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;

    }

    /*=============================================
    BORRAR FORMA
    =============================================*/
    static public function mdlEliminarForma($tabla, $item, $valor){

        $stmt =  Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        }else{
            $error = $stmt->errorInfo();
            if ($error[0] == "23000") {
                return "errorPadres";
            } else {
                return "error";
            }
        }

        $stmt->closeCursor();
        $stmt = null;

    }
}
