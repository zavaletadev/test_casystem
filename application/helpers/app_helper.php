<?php 
/**
 * @author Raúl Zavaleta Zea <raul.zavaletazea@gmail.com>
 */

defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("America/Mexico_City");

if(!function_exists("app_name")) {
    /**
     * Retornamos el nombre comercial del proyecto
     * @return String Nombre del proyecto
     */
    function app_name()
    {
        return "Test - C&A Systems";
    }
}

if(!function_exists("get_role_nav")) {
    /**
     * Retornamos el nombre comercial del proyecto
     * @return String Nombre del proyecto
     */
    function get_role_nav($role_id)
    {
        $_APP =& get_instance();
        $_APP->load->model('nav_model');
        $menu_items = $_APP->nav_model->get_role_nav($role_id);

        $html_nav = "";

        /*
        En función del template armamas el render HTML para las secciones
        autorizadas al rol
         */
        if (!is_null($menu_items)) {
            foreach ($menu_items as $item) {
                $html_nav .= "
                <div class=\"nav\">                        
                <a class=\"nav-link\" href=\"".base_url($item->item_url)."\">
                <div class=\"sb-nav-link-icon\">
                $item->icon
                </div>
                $item->label
                </a>
                </div>
                ";
            }
        }

        return $html_nav;
    }
}

if (!function_exists('fancy_phone')) {
    /**
     * De un telefono de 10 dígitos seguidos sin caracteres, devolvemos un teléfono 
     * con formato lada MX
     * @param  [type] $telefono [description]
     * @return [type]           [description]
     */
    function fancy_phone($telefono)  {
        $fancy_phone = "(".substr($telefono, 0, 3).") ";
        $fancy_phone .= substr($telefono, 3,3)."-";
        $fancy_phone .= substr($telefono, 6,4);

        return $fancy_phone;
    }
}


if (!function_exists('fancy_date')) {
    /**
     * creamos una feha con un formato especificado a partir de una fecha SQL
     * @param  Date   $sql_date     Fecha en formato SQL (yyyy-mm-dd)
     * @param  String $request_type Nomenclatura para el retorno de una fecha
     * 
     *                              $request_type = 'm-y' 
     *                              Retornamos solo el mes y el año de la fecha
     *                              fancy_date('1988-05-29', 'm-y')
     *                              <<mayo de 1988>>
     *
     *                              $request_type = 'd-m-y' 
     *                              Retornamos el día, mes y año
     *                              fancy_date('1988-05-29', 'd-m-y')
     *                              <<29 de mayo de 1988>>
     *
     *                              $request_type = 'd-m' 
     *                              Retornamos el mes y año
     *                              fancy_date('1988-05-29', 'd-m')
     *                              <<29 de mayo>>
     *
     *                              $request_type = 'w-d-m-y' 
     *                              Retornamos el día de la semana, 
     *                              el día del mes, el mes y año
     *                              fancy_date('1988-05-29', 'w-d-m-y')
     *                              <<domingo 29 de mayo de 1988>>
     *
     *                              $request_type = 'w-d-m-y-h' 
     *                              Retornamos el día de la semana, 
     *                              el día del mes, el mes, año y hora
     *                              fancy_date('1988-05-29 23:34', 'w-d-m-y-h')
     *                              <<domingo 29 de mayo de 1988 a las 23:34H>>
     *
     *                              $request_type = 'w' 
     *                              Retornamos el día de la semana
     *                              fancy_date('1988-05-29', 'w')
     *                              <<domingo>>
     *
     *                              $request_type = 'd-m-y-h' 
     *                              Retornamos el día del mes, el mes, 
     *                              año y hora
     *                              fancy_date('1988-05-29 23:34', 'd-m-y-h')
     *                              <<29 de mayo de 1988 a las 23:34H>>
     *
     *                              $request_type = 'slash' 
     *                              Retornamos el día del mes, el mes y el año
     *                              separado por diagonales
     *                              fancy_date('1988-05-29', 'slash')
     *                              <<29/mayo/1988>>
     *                              
     * @return String               Fecha en el formato especificado
     */
    function fancy_date($sql_date = NULL, $request_type = NULL) {
        $arr_month = array(              
            '01' => 'enero',
            '02' => 'febrero', 
            '03' => 'marzo', 
            '04' => 'abril', 
            '05' => 'mayo', 
            '06' => 'junio', 
            '07' => 'julio', 
            '08' => 'agosto', 
            '09' => 'septiembre', 
            '10' => 'octubre', 
            '11' => 'noviembre', 
            '12' => 'diciembre'
        );

        $arr_week = array(               
            'Mon'  => 'Lunes', 
            'Tue'  => 'Martes',
            'Wed'  => 'Miércoles', 
            'Thu'  => 'Jueves', 
            'Fri'  => 'Viernes', 
            'Sat'  => 'Sábado', 
            'Sun'  => 'Domingo'
        );        

        $year  = substr($sql_date, 0, 4); 
        $month = substr($sql_date, 5, 2);
        $day   = substr($sql_date, 8, 2);
        $hour  = substr($sql_date, 11, 8);        

        $year = !$year ? 0 : $year;
        $month = !$month ? 0 : $month;
        $day = !$day ? 0 : $day;

        if(checkdate($month, $day, $year)){
            $timestamp = strtotime($sql_date);
            $str_day   = date('D', $timestamp);
            $day       = (int) $day; 

            switch ($request_type) {
                case 'm-y': 
                return $arr_month[$month] . ' de ' . $year;
                break;

                case 'd-m-y': //REGRESAREMOS EL DIA, MES Y EL AÑO
                return $day . ' de ' . $arr_month[$month] . ' de ' . $year;
                break;

                case 'd-m': //REGRESAREMOS EL DIA Y EL MES
                return $day . ' de ' . $arr_month[$month];
                break;

                case 'w-d-m-y': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO
                return $arr_week[$str_day] . ' ' . $day . ' de ' . $arr_month[$month] . ' de  ' . $year;
                break;

                case 'w-d-m-y-h': //REGRESA EL DIA DE LA SEMANA, DIA DEL MES, MES Y AÑO Y LA HORA
                return $arr_week[$str_day] . ' ' . $day . ' de ' . $arr_month[$month] . ' de  ' . $year. ' a las '.$hour . 'Hrs';
                break;

                case 'w': //REGRESA EL DIA DE LA SEMANA
                return $arr_week[$str_day];
                break;

                case 'd-m-y-h': //REGRESAREMOS EL DIA, MES Y EL AÑO Y LA HORA
                return $day . ' de ' . $arr_month[$month] . ' de ' . $year.' a las '.$hour . 'Hrs';
                break;

                case 'slash': //REGRESAREMOS EL DIA, MES Y EL AÑO
                return $day . '/' . $month . '/' . $year;
                break;               

                case 'slash-ml': //REGRESAREMOS EL DIA, MES EN LETRA Y EL AÑO
                return $day . '/' . strtoupper(substr($arr_month[$month], 0, 3)) . '/' . $year;
                break;               

                default:
                return $day . ' de ' . $arr_month[$month] . ' de ' . $year;
                break;
            }
        }

        else {
            return "NA";
        } 
    } 
} 

/**
 * Cabecera JSON
 */
if(!function_exists("json_header")) {
    function json_header()
    {
        header('Content-Type: application/json; charset=utf-8');
    }
}

if(!function_exists("http_error")) {
    /**
     * Generamos una cabecera http a partir de los codigos de 
     * error estandar de HTTP
     * @param  int $error_code numero de error defecto de http
     * @return void
     */
    function http_error($error_code = 404) {
        header('X-PHP-Response-Code: '.$error_code, true, (int) $error_code);
    }
}


if (!function_exists('is_user_logged_in')) {
    /**
     * Revisamos si se cuenta con una sesión activa          
     * @param  boolean $login Si no econtramos en la sección delogin, buscamos 
     *                        redireccionar al panel de control, en las demas 
     *                        secciones es inverso, enviamos al login
     * @return Void           Redireccionamos al controlador designado
     */
    function is_user_logged_in($login = FALSE) {
        $CI =& get_instance();
        if ($login) {
            if($CI->session->userdata('signin')) {
                redirect(base_url('app/dashboard'),'refresh');
            }
        }

        else if (!$login) {
            if(!$CI->session->userdata('signin')) {
                $CI->session->set_flashdata('message', '<h3> <i class="fas fa-exclamation-triangle"></i> Acceso Restringido</h3> Por favor inicia sesión para continuar');
                $CI->session->set_flashdata('message_type', 'danger');            
                redirect(base_url('login'));
            }
        }
        
    }
}

/**
 * Si el rol no tiene permiso para acceder al item de menú, 
 * redireccionamos al logout para terminar con la sesión
 */
if (!function_exists('validate_role_access')) {
    function validate_role_access($role_id, $menuitem_id)
    {
        $_APP =& get_instance();
        $_APP->load->model('auth_model');
        $menu_item = $_APP->auth_model->validate_role_access($role_id, $menuitem_id);

        if (is_null($menu_item)) {
            redirect(base_url('app/logout'), 'refresh');
        }
    }
}

if (!function_exists('get_global_setting')) {
    /**
     * Función que retorna un valor de configuración de la tabla 'global settings' a partir 
     * del nombre de su propiedad
     * @param  [type] $prop [description]
     * @return [type]       [description]
     */
    function get_global_setting($prop)
    {
        $_APP =& get_instance();
        $_APP->load->model('globalsettings_model');
        
        return $_APP->globalsettings_model->get_item($prop);
    }
}
