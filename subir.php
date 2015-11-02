<?php

require 'clases/Request.php';
require 'clases/FileUpload.php';
require 'clases/Session.php';
require 'clases/Server.php';

$sesion=new Session();
$user = $sesion->get("usuario");
$usuario=Request::post("usuario1");
$categoria=  Request::post("categoria1");
$cancion = new FileUpload("cancion");
$cancion->setDestino("canciones/");
$cancion->setNombre($user."_".$categoria."_".$cancion->getNombre());
$cancion->setPolitica(FileUpload::RENOMBRAR);
$cancion->upload();
  









$imagen=new FileUpload("imagen");
$imagen->setDestino("canciones/");
    
$imagen->setNombre($cancion->getNombre());
 $imagen->setPolitica(FileUpload::RENOMBRAR);


$imagen->upload();

        
header("Location:index.php");
          