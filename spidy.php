<link href="style.css" rel="stylesheet" type="text/css">
<?php
/**
 *Programa que permite extrer el codigo del archivo index y las cabeceras 
 *PHP version 5
 * @category  PHP
 * @package   PHP_Spider
 * @author    Felipe de Jesus Miramontes Romero <felipemiraontesr@gmail.com>
 * @license   https://github.com/felipemiramontesr/spider GNU Licence
 * @version   SVN: $Id: crawler.php, v 1.0 2015-05-23 14:05:00 ff Exp $
 * @link      https://github.com/felipemiramontesr/spider
 */

/**
  *Apertura o creación del nuevo archivo code.txt y escritura del codigo extraido
  */
ini_set("max_execution_time", 1000000);
echo "Working bitch!!!";
      $file = fopen("data.txt", "w+")
              or die("Error 01: Error al crear el nuevo archivo!");
     
//Reporte de errores: PHP5 notifica todos los errores menos los de tipo "Notice".
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", "1");

      //Estrucutra de control que incremeta los valores de la sección b de una ip "a.b.c.d"
      for($b = 0; $b <= 255; $b++){
            //Estrucutra de control que incremeta los valores de la sección c de una ip "a.b.c.d"
           for($c = 0; $c <= 255; $c++){
                 //Estrucutra de control que incremeta los valores de la sección d de una ip "a.b.c.d"
                for($d = 0; $d <= 255; $d++){

                     /*Se asigna la informacion detalla de la localización geografica de una IP a la 
 *variable $data por medio de la funcion GEOIP_RECORD_BY_NAME incluido en el paquete 
 *PECL GEOIP PHP
 */
//$ip = $_POST["ip"];
$aaa = "177";
$bbb = strval($b);
$ccc = strval($c);                     
$ddd = strval($d);

$ip = $aaa.".".$bbb.".".$ccc.".".$ddd;                 
$data = (geoip_record_by_name($ip));

if($data == false) {
                    
                   }else{

//Estructura de control que evalua si la variable $data se encuentra vacia o no 
                  if ($data){
                            fwrite($file, "IP: ".$ip." Localized in ".$data["country_name"]."\r\n");
                            }                                    
                         }              
                     
                     }
                }
           }   
//Cierre del archivo
fclose($file); 
?>