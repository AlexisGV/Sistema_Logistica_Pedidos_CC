<?php

require_once "conexion.php";

class ModeloCorte
{

    /*=============================================
    OBTENER TODOS LOS ACABADOS
    =============================================*/
    static public function mdlTraerCorte($tabla, $item, $valor)
    {
        if ($valor == null) {
            # Consulta general
            $consulta = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item != 'Otro corte' ORDER BY $item");
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
    VERIFICAR LA EXISTENCIA DE UN ACABADO
    =============================================*/
    static public function mdlVerificarCorte($tabla, $datos, $bandera)
    {

        if ( $bandera ){
            #Verificar existencia al ingresar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                     WHERE REPLACE(REPLACE(REPLACE(Corte,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','') OR REPLACE(REPLACE(REPLACE(Abreviacion_Corte,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:abreviacion,' ',''),'-',''),'_','')"
            );
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":abreviacion", $datos["abreviacion"], PDO::PARAM_STR);
        } else {
            #Verificar existencia al actualizar
            $stmt = Conexion::conectar()->prepare(
                "SELECT * FROM $tabla
                WHERE (REPLACE(REPLACE(REPLACE(Corte,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:nombre,' ',''),'-',''),'_','') OR REPLACE(REPLACE(REPLACE(Abreviacion_Corte,' ',''),'-',''),'_','')=REPLACE(REPLACE(REPLACE(:abreviacion,' ',''),'-',''),'_','')) AND Id_Corte!=:idCorte"
            );
            $stmt->bindParam(":idCorte", $datos["idCorte"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":abreviacion", $datos["abreviacion"], PDO::PARAM_STR);
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
    CREAR UN NUEVO TIPO DE ACABADO
    =============================================*/
    static public function mdlCrearCorte($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (Foto_Corte, Corte, Abreviacion_Corte) VALUES (:foto ,:nombre, :abreviacion)");
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":abreviacion", $datos["abreviacion"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;
    }

    /*=============================================
    ACTUALIZAR ACABADO
    =============================================*/
    static public function mdlActualizarCorte($tabla, $datos){
        
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET Foto_Corte=:foto,
                Corte=:nombre,
                Abreviacion_Corte=:abreviacion
            WHERE Id_Corte=:idCorte"
        );
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":abreviacion", $datos["abreviacion"], PDO::PARAM_STR);
        $stmt->bindParam(":idCorte", $datos["idCorte"], PDO::PARAM_INT);

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
    BORRAR USAURIO
    =============================================*/
    static public function mdlEliminarCorte($tabla, $item, $valor){

        $stmt =  Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item=:$item");
        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

        if ( $stmt->execute() ){
            return "ok";
        }else{
            return "error";
        }

        $stmt->closeCursor();
        $stmt = null;

    }
}
