<?php

namespace backend\controllers\pdf;

use backend\models\Dictamen;
use yii\web\Controller;
use Mpdf\Mpdf;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers; //agregar esta linea siempre y cuando se use el comportamiento(behaviors) de la pagina.
use yii\web\NotFoundHttpException; // Asegúrate de importar esta clase
use yii\helpers\Url;



class PdfController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['generate-pdf'], // Solo proteger la acción generate-pdf
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Solo usuarios autenticados pueden acceder
                            'matchCallback' => function ($rule, $action) {
                                // Requiere que el usuario tenga al menos el rol 'Admin' y esté activo
                                return PermisosHelpers::requerirMinimoRol('Admin') 
                                    && PermisosHelpers::requerirEstado('Activo');
                            }
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionGeneratePdf($id)
    {
        // Encuentra el modelo por su ID
        $dictamen = Dictamen::findOne($id);
        if (!$dictamen) {
            throw new NotFoundHttpException("El dictamen no existe.");
        }

        // Inicializa mPDF
        $mpdf = new Mpdf();

        // Configura la codificación de caracteres
        $mpdf->allow_charset_conversion = true;
        $mpdf->charset_in = 'UTF-8';

        // Establece el fondo SVG
        $mpdf->SetDefaultBodyCSS('background', "url('" . Url::to('@web/img/FondoPdf.png') . "')");
        $mpdf->SetDefaultBodyCSS('background-image-resize', 6);

        // Cargar el archivo CSS desde la ruta correspondiente
        $css = file_get_contents(Url::to('@web/css/pdf_style.css', true));

        // Escribir el CSS en el PDF
        $mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);

        // Renderiza la vista parcial
        $html = $this->renderPartial('/pdf/dictamen_pdf', [
            'dictamen' => $dictamen,
        ]);

        // Escribe el contenido HTML en el PDF
        $mpdf->WriteHTML($html);

/*         // Configura el pie de página solo para la primera página
        $mpdf->SetHTMLFooter('
            <div style="text-align: center; font-size: 12px; position: absolute; bottom: 10px; width: 100%;">
                ESTE DOCUMENTO TIENE VALIDEZ POR UN AÑO
            </div>
        '); */

        // Salida del PDF al navegador
        $mpdf->Output('dictamen.pdf', \Mpdf\Output\Destination::INLINE);
    }
}





