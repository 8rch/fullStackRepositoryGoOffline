<?php

namespace common\components;

use Yii;
use yii\base\Component;

/**
 * Utilitario para manejar metodos globales
 */
class Util extends Component
{

    /**
     * Permite obtener el directorio de los assets publicos que maneja ese controlador
     * @return String ruta del directorio publico
     */
    public function getPublishAssetDirectory()
    {
        //obtiene el path del directorio para los assets publicados WEB
        list($path, $webPath) = Yii::$app->getAssetManager()->publish(\Yii::$app->controller->module->basePath
            . '/assets/js/' . Yii::$app->controller->id);
        return $webPath;
    }

    /**
     *
     * @param type $fecha_nacimiento
     * @return type
     */
    function calcularEdad($fecha_nacimiento, $fecha_select)
    {

        $diff = abs(strtotime($fecha_select) - strtotime($fecha_nacimiento));

        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        return $months + $years * 12;
    }

    /**
     * Permite quitar el tiempo de un datetime
     * por defecto el date de salida es Y-m-d
     * @author Mauricio Chamorro <unrealmach>
     * @param String $datetime
     * @param String $format
     * @return String
     */
    public function transformDateTimeToDate($datetime, $format = "Y-m-d")
    {
        $date = new \DateTime($datetime);
        return $date->format($format);
    }

    /**
     * Devuelve la cantidad de días que tendra que sumarse a partir del lunes de una semana
     * Sirve para la fecha de la bitacora
     * @param String $day
     * @return int
     */
    public function getNumberOfDaysToAddMonday($day)
    {
        switch ($day) {
            case "LUNES":
                return 0;
            case "MARTES":
                return 1;
            case "MIERCOLES":
                return 2;
            case "JUEVES":
                return 3;
            case "VIERNES":
                return 04;

            default:
                return -1;
        }
    }

    /**
     * Crea una cadena para el username en base a 2 cadenas y un numero
     * @author Mauricio Chamorro
     * @param string $cadena1 por lo general es nombre
     * @param string $cadena2 por lo general es apellido
     * @param string $numeroRef por lo general es cedula o numero mayor a 5 digitos
     * @return string retorna una cadena con el siguiente formato {3 primeras letras del nombre}_{3 primeras letras del apellido}_{ultimo digito d.n.i.}
     */
    public function generarStringToUser($cadena1, $cadena2, $numeroRef)
    {
        $ultimoNum = substr($numeroRef, strlen($numeroRef) - 1, strlen($numeroRef));
        $sub1 = substr($cadena1, 0, 3);
        $sub2 = substr($cadena2, 0, 3);
        $simbol = "_";
        
        return strtolower($this->quitarAcentos(str_replace(' ', '_',$sub1.'_'.$sub2."_".$ultimoNum)));
    }

    /**
     * Reemplaza los acentos o tildes por sus homologos
     * @author Mauricio Chamorro
     * @param string $string
     * @return string
     */
    public function quitarAcentos($string)
    {
        return strtr($string, 'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ', 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

    /**
     * Crea una cadena para el password en base a dos cadenas
     * @param string $cadena1 por lo general es nombre
     * @param string $cadena2 por lo general es apellido
     * @return string una cadena fon el formato {tres primeras letras cadena1}{dos caracteres especiales}{tres primeras letras cadena 2}{longitud cadena 2}
     */
    public function generarContraseniaToUser($cadena1, $cadena2)
    {
        $sub1 = strtolower(substr($cadena1, 0, 2));
        $sub2 = ucfirst(substr($cadena2, 0, 2));
        $longitudApellido = strlen($cadena2);
        $caracter = $longitudApellido % 2 == 0 ? '//' : '**';
        return $this->quitarAcentos(trim($sub2 . $caracter . $sub1 . $longitudApellido));
    }

    /**
     * Obtiene los dias del mes deacuedro a un dia de referencia
     * @author Mauricio CHamorro
     * @param String $fechaInicio si es null trabajara con el dia actual
     * @return array
     */
    public function getDaysOfMonth($fechaInicio = null)
    {
        $days = [];
        $start = is_null($fechaInicio) ? new \DateTime() : new \DateTime($fechaInicio);
        $start = $start->modify('first day of this month');
        $end = is_null($fechaInicio) ? new \DateTime() : new \DateTime($fechaInicio);
        $end = $end->modify('last day of this month')->modify('+1 day');
        $interval = new \DateInterval('P1D'); //periodo por dia
        $period = new \DatePeriod($start, $interval, $end);
        foreach ($period as $date3) {
            array_push($days, $date3->format('Y-m-d'));
        }
        return $days;
    }
    
    public function getNacionalidades()
    {
        return [
            'AFGANA' => 'AFGANA',
            'ALBANESA' => 'ALBANESA',
            'ALEMANA' => 'ALEMANA',
            'ANDORRANA' => 'ANDORRANA',
            'ANGOLEÑA' => 'ANGOLEÑA',
            'ARGELINA' => 'ARGELINA',
            'ARGENTINO' => 'ARGENTINO',
            'ARMENIA' => 'ARMENIA',
            'ARUBANA' => 'ARUBANA',
            'AUSTRALIANA' => 'AUSTRALIANA',
            'AUSTRÍACA' => 'AUSTRÍACA',
            'AZERBAIYANA' => 'AZERBAIYANA',
            'BAHAMEÑA' => 'BAHAMEÑA',
            'BANGLADESÍ' => 'BANGLADESÍ',
            'BARBADENSE' => 'BARBADENSE',
            'BAREINÍ' => 'BAREINÍ',
            'BELGA' => 'BELGA',
            'BELICEÑA' => 'BELICEÑA',
            'BIELORRUSA' => 'BIELORRUSA',
            'BOLIVIANA' => 'BOLIVIANA',
            'BOSNIA' => 'BOSNIA',
            'BRASILEÑA' => 'BRASILEÑA',
            'BRITÁNICA' => 'BRITÁNICA',
            'BÚLGARA' => 'BÚLGARA',
            'CAMERUNESA' => 'CAMERUNESA',
            'CANADIENSE' => 'CANADIENSE',
            'CHECA' => 'CHECA',
            'CHILENA' => 'CHILENA',
            'CHINA' => 'CHINA',
            'CHIPRIOTA' => 'CHIPRIOTA',
            'COLOMBIANA' => 'COLOMBIANA',
            'COSTARRICENSE' => 'COSTARRICENSE',
            'CROATA' => 'CROATA',
            'CUBANA' => 'CUBANA',
            'DANESA' => 'DANESA',
            'DOMINICANA' => 'DOMINICANA',
            'DOMINIQUESA' => 'DOMINIQUESA',
            'ECUATOGUINEANA' => 'ECUATOGUINEANA',
            'ECUATORIANA' => 'ECUATORIANA',
            'EGIPCIA' => 'EGIPCIA',
            'EMIRATÍ' => 'EMIRATÍ',
            'ESCOCESA' => 'ESCOCESA',
            'ESLOVACA' => 'ESLOVACA',
            'ESLOVENA' => 'ESLOVENA',
            'ESPAÑOLA' => 'ESPAÑOLA',
            'ESTADOUNIDENSE' => 'ESTADOUNIDENSE',
            'ESTONIA' => 'ESTONIA',
            'ETÍOPE' => 'ETÍOPE',
            'FILIPINA' => 'FILIPINA',
            'FINLANDESA' => 'FINLANDESA',
            'FRANCESA' => 'FRANCESA',
            'GEORGIANA' => 'GEORGIANA',
            'GRIEGA' => 'GRIEGA',
            'GUATEMALTECA' => 'GUATEMALTECA',
            'GUYANESA' => 'GUYANESA',
            'HAITIANA' => 'HAITIANA',
            'HINDÚ' => 'HINDÚ',
            'HOLANDESA' => 'HOLANDESA',
            'HONDUREÑA' => 'HONDUREÑA',
            'HÚNGARA' => 'HÚNGARA',
            'INDONESIA' => 'INDONESIA',
            'IRLANDESA' => 'IRLANDESA',
            'ISRAELÍ' => 'ISRAELÍ',
            'ITALIANA' => 'ITALIANA',
            'JAMAIQUINA' => 'JAMAIQUINA',
            'JAPONESA' => 'JAPONESA',
            'LETONA' => 'LETONA',
            'LIBANESA' => 'LIBANESA',
            'LIBERIANA' => 'LIBERIANA',
            'LIBIA' => 'LIBIA',
            'LITUANA' => 'LITUANA',
            'LUXEMBURGUESA' => 'LUXEMBURGUESA',
            'MALTESA' => 'MALTESA',
            'MARROQUÍ' => 'MARROQUÍ',
            'MEXICANA' => 'MEXICANA',
            'MOLDAVA' => 'MOLDAVA',
            'MONEGASCA' => 'MONEGASCA',
            'MONGOLA' => 'MONGOLA',
            'MONTENEGRINA' => 'MONTENEGRINA',
            'NAMIBIA' => 'NAMIBIA',
            'NEOZELANDESA' => 'NEOZELANDESA',
            'NICARAGÜENSE' => 'NICARAGÜENSE',
            'NIGERIANA' => 'NIGERIANA',
            'NORCOREANA' => 'NORCOREANA',
            'NORUEGA' => 'NORUEGA',
            'PANAMEÑA' => 'PANAMEÑA',
            'PARAGUAYA' => 'PARAGUAYA',
            'PERUANA' => 'PERUANA',
            'POLACA' => 'POLACA',
            'PORTUGUESA' => 'PORTUGUESA',
            'PUERTORRIQUEÑA' => 'PUERTORRIQUEÑA',
            'RUMANA' => 'RUMANA',
            'RUSA' => 'RUSA',
            'SAHARAUI' => 'SAHARAUI',
            'SALVADOREÑA' => 'SALVADOREÑA',
            'SANCRISTOBALEÑA' => 'SANCRISTOBALEÑA',
            'SANTALUCIANA' => 'SANTALUCIANA',
            'SANVICENTINA' => 'SANVICENTINA',
            'SENEGALESA' => 'SENEGALESA',
            'SERBIA' => 'SERBIA',
            'SIRIA' => 'SIRIA',
            'SUDAFRICANA' => 'SUDAFRICANA',
            'SUECA' => 'SUECA',
            'SUIZA' => 'SUIZA',
            'SURCOREANA' => 'SURCOREANA',
            'SURINAMESA' => 'SURINAMESA',
            'TOGOLESA' => 'TOGOLESA',
            'TURCA' => 'TURCA',
            'UCRANIANA' => 'UCRANIANA',
            'URUGUAYA' => 'URUGUAYA',
            'VENEZOLANA' => 'VENEZOLANA',
            'VIETNAMITA' => 'VIETNAMITA',
            'EUROPEA' => 'EUROPEA',
        ];
    }

    public function getResulPensumAsigned($period_id, $user_id, $with_ref_date, $refDate){
        return Yii::$app->db
            ->createCommand(
                "select * from function_get_pensum_filtered(:user_id::int4,:period_id::int4,
                        :with_ref_date_in::boolean, :ref_date_in::text);")
            ->bindValue(':period_id', $period_id)
            ->bindValue(':user_id', $user_id)
            ->bindValue(':with_ref_date_in', $with_ref_date)
            ->bindValue(':ref_date_in', $refDate)
            ->queryAll();
    }
}

