<!DOCTYPE>
<?php
   require './clases/AutoCarga.php';
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="main.css">
        <title></title>
    </head>
    <body>
        <div id="titulo"><p>Podcast</p>
        <?php
          
                $sesion=new Session();
                if(!$sesion->get("usuario")){
                    
                    ?><div id="login"><form action="phplogin.php" method="post" enctype="multipart/form-data"/>
                <input type="text" name="usuario1" placeholder="Usuario"/>
                <input type="submit" value="Login"/>
                </form></div>
                <?php
                }
                 else{
           ?></div>
        <div id="principal">
            <div id="izquierda">
            <div id="formularioInsercion">
                
                 <form action="subir.php" method="post" enctype="multipart/form-data">
                     <fieldset><legend><b>Inserta tus canciones</b></legend>
                 Categoría: <input type="text" name="categoria1" placeholder="categoria" size="30"/><br/>
                 Canción: <input type="file" name="cancion" /><br/>
                 Imagen: <input type="file" name="imagen" />
                 </fieldset>
                 <input type="submit" value="Subir archivo"/>
                </form>
          
            </div>
                <form action="phplogout.php"><fieldset><legend><b>Sesión activa</b></legend>
                <?php
                
                echo $sesion->get("usuario")."<br/>";
                echo '<input type="submit" value="Cerrar sesión">';
                
                ?>
                 </fieldset>
                    </form>
                <?php
                }
                ?>
                <div id="primeTabla"><table id="tabla1" class="tabla" border="0"><tr><td><b>Imagen</b></td><td><b>Usuario</b></td><td><b>Categoría</b></td><td><b>Título canción</b></td><td><b>Reproducir</b></td></tr>
        <?php
       
        
        $canciones=new FiltrarLista();
        
        foreach($canciones->getLista('canciones/') as $key=>$value){
            if($value!="." && $value!=".." && strpos($value, "mp3")>0){      
           echo "<tr><td><img src='canciones/".$canciones->getUsuario($value)."_".$canciones->getCategoria($value)."_".$canciones->getNombre($value).".jpg' /></td><td>".$canciones->getUsuario($value)."</td><td>".$canciones->getCategoria($value)."</td><td>".$canciones->getNombre($value)."</td><td><audio src='canciones/$value' type='audio/mpeg' controls></audio></td></tr>";      
            }
                  
            
           
        }
        
            
        ?>
         </table></div></div>
         <div id="derecha">
        <div id="formularioFiltrado">
                <form method="post" enctype="multipart/form-data">
                    <fieldset><legend><b>Busca por usuario y categoría</b></legend>
                    Usuario: <input type="text" name="usuario2" placeholder="usuario" size="30"/><br/>
                    Categoría: <input type="text" name="categoria2" placeholder="categoria" size="30"/>
                    </fieldset>
                    <input type="submit" name="filtrar" value="Filtrar"/>
                </form><br/><br/>       
        <?php
        
        $usu=  Request::post("usuario2");
        $cat=  Request::post("categoria2");
        
        if($usu!="" || $cat!="")
        {
            ?>
        <div id="segunTabla"><table id="tabla2" class="tabla"><th colspan="3">Resultado búsqueda</th><tr><td><b>Usuario</b></td><td><b>Categoría</b></td><td><b>Título canción</b></td></tr>
        <?php
        
         foreach($canciones->getLista('canciones/') as $key=>$value)
         {
           if($usu!= "" && $cat!= "" && $canciones->getUsuario($value)==$usu && $canciones->getCategoria($value)==$cat && strpos($value, "mp3")>0){
               echo "<tr><td>".$canciones->getUsuario($value)."</td><td>".$canciones->getCategoria($value)."</td><td>".$canciones->getNombre($value)."</td></tr>";      
           }
           else
               if($usu!="" && $cat=="" && $canciones->getUsuario($value)==$usu && strpos($value, "mp3")>0){
                   echo "<tr><td>".$canciones->getUsuario($value)."</td><td>".$canciones->getCategoria($value)."</td><td>".$canciones->getNombre($value)."</td></tr>";      
               }
               else
                   if($cat!="" && $usu=="" && $canciones->getCategoria($value)==$cat && strpos($value, "mp3")>0){
                      echo "<tr><td>".$canciones->getUsuario($value)."</td><td>".$canciones->getCategoria($value)."</td><td>".$canciones->getNombre($value)."</td></tr>";      
                   }
         }
         }
         
         ?>
         
        </table>
       
        </div>
                 </div> 
        </div>
        </div>
         
    </body>
</html>
