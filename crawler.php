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


//Reporte de errores: PHP5 notifica todos los errores menos los de tipo "Notice".
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", "1");

//Estrucutra de control que incremeta los valores de la sección a de una ip "a.b.c.d"
for($a = 0; $a <= 1; $a++){
      //Estrucutra de control que incremeta los valores de la sección b de una ip "a.b.c.d"
      for($b = 0; $b <= 1; $b++){
            //Estrucutra de control que incremeta los valores de la sección c de una ip "a.b.c.d"
           for($c = 0; $c <= 10; $c++){
                 //Estrucutra de control que incremeta los valores de la sección d de una ip "a.b.c.d"
                for($d = 0; $d <= 10; $d++){

                     /*Se asigna la informacion detalla de la localización geografica de una IP a la 
 *variable $data por medio de la funcion GEOIP_RECORD_BY_NAME incluido en el paquete 
 *PECL GEOIP PHP
 */
//$ip = $_POST["ip"];
$aaa = strval($a);
$bbb = strval($b);
$ccc = strval($c);                     
$ddd = strval($d);

$ip = $aaa.".".$bbb.".".$ccc.".".$ddd;                 
$data = (geoip_record_by_name($ip));

if($data == false) {
                    ?>
                    <table>
                        <thead>
                              <tr>
                                    <th>IP</th>
                                    <th>Response</th>
                              </tr>
                        </thead>
                              <tr>
                                    <td><?php
                                    echo "<strong><h1>".$ip." </h1></strong>";
                                    echo "</td>";

                                    echo "<td>";
                                          echo "<center>";
                                          echo "HTTP or HTTPS not found";
                                          echo "</center>";
                                    echo "</td>";

                                    echo "</tr>";
                                    echo "</table>";
                                    ?><script>window.scrollBy(0,200);</script><?php
                   }else{
//Estructura de control que evalua si la variable $data se encuentra vacia o no 
if ($data) {

    /**
     *Se asigna a la variable $code los datos extraidos de la página index del sitio
     *por medio de la funcion FILE_GET_CONTENTS
     */
       $code = file_get_contents("http://www.saizac.com");
       //$gestor = fopen("http://".$domain."/sites/default/settings.php", "r");
       

    /**
     *Apertura o creación del nuevo archivo code.txt y escritura del codigo extraido
     */

      $file = fopen("code.txt", "w+")
      or die("Error 01: Error al crear el nuevo archivo!");

      /**
      *Se escribe la información contenida en $code dentro del archivo code.txt
      */

      fwrite($file, $code);

      //Cierre del archivo
      fclose($file);            

    //Si la variable contiente información se imprime los datos en una tabla HTML
                    ?><table> 
                        <thead>
                              <tr>
                                    <th>IP</th>
                                    <th>Latitud</th>
                                    <th>Longitud</th>
                                    <th>Ciudad</th>
                                    <th>Region</th>
                                    <th>País</th>
                                    <th>Código</th>
                              </tr>
                        </thead>
                              <tr>
                                    <td><?php
                                    echo "<strong><h1>".$ip." </h1></strong>";
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["latitude"]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["longitude"]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["city"]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["region"]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["country_name"]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data["country_code"]);
                                    echo "</td>";
                                    
                                    echo "</tr>";
                                    echo "</table>";
                                    ?><script>window.scrollBy(0,200);</script><?php
                                  }                                    
                                }              
                     }
                }
           }   
      }
?>
