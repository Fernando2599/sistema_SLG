<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<!-- Portada del pdf -->
<div class="portada">
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> <!-- Puedes agregar más <br> según necesites -->
    <h1 class="titulo">ANÁLISIS DE RIESGO Y DICTAMINACIÓN ELÉCTRICA</h1>
    <h2>ING VICTOR MANUEL ALMENDRA ANTONIO</h2>
    <h3>ANÁLISIS Y DICTAMINADOR DE INSTALACIONES ELÉCTRICAS DEL MUNICIPIO DE BENITO JUAREZ, QUINTANA ROO</h3>

    <div style="line-height: 30%;">
        <h3 style="color: #a10000;">NÚMERO DE REGISTRO:</h3>
        <p><u>MBJ-PM-SG-DGPC-JDN-AP-02-0050-2024</u></p>
    </div>

    <!-- Aquí colocamos el mensaje en la portada -->
    <p style="margin-top: 59%;font-size: 14px; color: gray">
        ESTE DOCUMENTO TIENE VALIDEZ POR UN AÑO
    </p>


</div>

<pagebreak />

<div class="content">
    <div style="line-height: 30%;">
        <h3>DICTAMEN ELÉCTRICO 2024</h3>

        <?php
        $formatter = new IntlDateFormatter('es_MX', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
        $fechaCreacion = $formatter->format(new DateTime($dictamen->created_at));
        $fechaCreacion = strtoupper($fechaCreacion); // Convertir la fecha a mayúsculas
        ?>
        
        <p>BENITO JUAREZ, QUINTANA ROO A <?= $fechaCreacion ?></p>
    </div>


    <table>
        <tr>
            <th>Razón Social</th>
            <td><?= Html::encode($dictamen->razon_social) ?></td>
        </tr>
        <tr>
            <th>Nombre Comercial</th>
            <td><?= Html::encode($dictamen->nombre_comercial) ?></td>
        </tr>
        <tr>
            <th>Giro Comercial</th>
            <td><?= Html::encode($dictamen->giro_comercial) ?></td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td><?= Html::encode($dictamen->direccion) ?></td>
        </tr>
        <tr>
            <th>RFC</th>
            <td><?= Html::encode($dictamen->rfc) ?></td>
        </tr>
        <tr>
            <th>Representante Legal</th>
            <td><?= Html::encode($dictamen->representante_legal) ?></td>
        </tr>
    </table>
    <div style="margin-top: 8px;">
        <p>
            Se evaluaron las instalaciones del lugar de forma personal, en la cual se da por sentado
            que el inmueble cuenta con las condiciones adecuadas para su funcionamiento. Es
            responsabilidad del propietario el mantenimiento preventivo, así como cualquier incidente
            que se presente en la instalación eléctrica. Cualquier ajuste que requiera deberá realizarse
            por personal calificado respetando los lineamientos que marca la NOM-001-SEDE-2012 de
            instalaciones eléctricas. Posteriormente deberá realizarse nuevamente la inspección. (no
            podrá utilizar materiales, y accesorios eléctricos que no están aprobados por las normas
            oficiales mexicanas)
        </p>
    </div>

    <div class="info-firma">

    <!-- Firma del Ingeniero-->
        <img src="<?= Url::to('@web/img/Firma_Pdf.png', true) ?>" alt="Firma" style="width: 150px;"/>

        <p>
        <strong>ING VICTOR MANUEL ALMENDRA ANTONIO</strong><br>

        <span style="font-size: 13px; line-height: 1.0;">
            Análisis de Riesgo y Dictaminación Eléctrica<br>
            del municipio de BENITO JUAREZ, QUINTANA ROO<br>
            NÚMERO DE REGISTRO:<br>
            <u>MBJ-PM-SG-DGPC-JDN-AP-02-0050-2024</u><br>
            ESTE DOCUMENTO TIENE VALIDEZ POR UN AÑO.</span>
    </div>
    <p style="font-size: 13px; line-height: 1.0; ">
        <br><br><br><br><br><br>
        Evaluación conforme a la <strong>NORMA OFICIAL MEXICANA (NOM-002- STPS-2010) Y</strong><br>
        <strong>NORMA OFICIAL MEXICANA (NOM-001-SEDE-2012)</strong>. El objeto de esta NOM es<br>
        establecer las especificaciones y lineamientos de carácter técnico que deban satisfacer<br>
        las instalaciones.
    </p>
</div>

