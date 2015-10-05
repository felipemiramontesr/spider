<?php
/**
 *Programa que permite localizar geograficamente IPs en ciertos rangos...
 *PHP version 5
 * @category  PHP
 * @package   PHP_Spider
 * @author    Felipe de Jesus Miramontes Romero <felipemiraontesr@gmail.com>
 * @license   https://github.com/felipemiramontesr/spider GNU Licence
 * @version   SVN: $Id: crawler.php, v 1.2 2015-09-29 13:15:00 ff Exp $
 * @link      https://github.com/felipemiramontesr/spider
 */
/**
*Se establece el valor de la directiva de configuración MAX_EXECUTION_TIME,
*se realiza desde codigo para evitar modificar el archivo ini.php
*/
$time_start = microtime(true);
ini_set('max_execution_time', 1000000);      
/*
*Configuración de reporte de errores: PHP5 notifica todos los contratiempos
*excluyendo los de tipo "Notice".
*/
error_reporting(E_ALL ^ E_NOTICE); 
/**
*Se establece el valor de la directiva de configuración DISPLAY_ERRORS,
*para ocultar los errores impresos en patalla
*/
ini_set('display_errors', '1');
/*
*Asignamos a la variable $file el archivo de nombre data2.txt, abierto y 
*con capasidades de escritura (w+)
*/
$file = fopen('data2.txt', 'w+')
        or die('Error 01: ¡Error al crear el nuevo archivo!');
/*
*Estrucutra de control que incremeta los valores de la sección d de una ip "a.b.c.d"
*/
for($b = 0; $b <= 255; $b++){
                            for($c = 0; $c <= 255; $c++){
                                                        for($d = 0; $d <= 255; $d++){
/*Se asigna la informacion detalla de la localización geografica de una IP a la 
 *variable $data por medio de la funcion GEOIP_RECORD_BY_NAME incluido en el paquete 
 *PECL GEOIP PHP
 */
$aip= '177';
$bip = strval($b);
$cip = strval($c);                     
$dip = strval($d); 
$ip = $aip.'.'.$bip.'.'.$cip.'.'.$dip;                
$data = (geoip_record_by_name($ip));
/*
*Estructura de control que evalua si la variable $data se encuentra vacia o no 
*/ 
if($data == false) {
/*
*Si la variable $data contiene datos, se escribe la información en el archivo
*data2.txt que anteriormente fue abierto 
*/   
                   echo 'Error 02: ¡No fue extraido ningun dato!';
                   }else{
                        if($data){
                                 fwrite($file, 'IP: '.$ip.' Localized in '.$data['country_name']."\r\n");
                                 }
                        }                                   
                                                          
                                                                                   } 
                                                        }
                            }                                                
/*
*Se cierra el archivo data2.txt 
*/ 
fclose($file);

$time_end = microtime(true); 
$time = $time_end - $time_start;
echo 'Process execution time: '. $time.' Miliseconds';
?>