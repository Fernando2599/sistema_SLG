<?php

use yii\helpers\Html;
use common\models\PermisosHelpers;

use yii\helpers\Url;


/** @var yii\web\View $this */

$this->title = 'Sistema XXX';
$es_admin = PermisosHelpers::requerirMinimoRol('Admin');

// Registrar el archivo CSS para la validación
$this->registerCssFile("@web/css/index_site.css");

?>

<div class="site-index">
<div class="container">
    <center>
        <p></p>
        <IMG src=  <?php echo Url::to('@web/img/Imagen_index_site.jpg',true); ?> width="20%" height="30%"  BORDER=0 ALT="Imagen de Enzabezado" ALIGN="center">
        
        <hr>
            <!-- <h4 style=" background:"> Navegador Recomendado<a href=<?php echo Url::to('https://www.mozilla.org/es-MX/firefox/new/',true); ?> target="_blank" > Firefox </a> para un mejor desempeño del sistema -->

            <?php 
                //   $id_user = Yii::$app->user->identity->getId();
                //   $nombreRol = User::findOne(['id'=>$id_user])->rol->rol_nombre;
                //   echo "<p><p>ROL = " . $nombreRol . " VALOR ROL= " . User::findOne(['id'=>$id_user])->rol->rol_valor;
                //   echo "<p>User ID=" . $id_user;
            ?>
            <p class="bienvenida" >Estamos encantados de que estés aquí. Nuestro sistema está diseñado para facilitar el control y gestión de dictámenes que aseguran un manejo efectivo y transparente de la información.
                Explora todas nuestras herramientas y funcionalidades, y descubre cómo podemos ayudarte a optimizar la gestión de tus dictámenes. Si tienes alguna pregunta o sugerencia, no dudes en ponerte en contacto con nosotros.
            </p>

            <h3>¡Disfruta de tu visita!</h3>
        </center>
    </div>
</div>