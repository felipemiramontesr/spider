<link href="style.css" rel="stylesheet" type="text/css">

<?php
/**
 *Programa que permite extrer el codigo del index de cualquier sitio web
 *PHP version 5
 * @category  PHP
 * @package   PHP_Spider
 * @author    Felipe de Jesus Miramontes Romero <felipemiraontesr@gmail.com>
 * @license   https://github.com/felipemiramontesr/spider GNU Licence
 * @version   SVN: $Id: crawler.php, v 1.0 2015-05-23 14:05:00 ff Exp $
 * @link      https://github.com/felipemiramontesr/spider
 */


//Reporte de errores PHP5 notifica todos los errores menos -Notice-
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", "1");

/*Se asigna la informacion detalla de la localización del sitio web a la 
 *variable $data por mediola funcion GEOIP_RECORD_BY_NAME incluido en el paquete 
 *PECL GEOIP PHP
 */
            $ip = $_POST["ip"];

            $domain = gethostbyaddr($ip);                          

            $data = (geoip_record_by_name($domain));

            $data_b = get_headers("http://www.ingsoft.mx");   

            //print_r(get_headers("http://www.saizac.com", 1));

//Estructura de control que evalua si la variable $data se encuentra vacia o no 
if ($data) {

    /**
     *Se asigna a la variable $code los datos extraidos de la página index del sitio
     *por medio de la funcion FILE_GET_CONTENTS
     */
      $code = file_get_contents("http://".$domain);

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

      /**
        * $shop = array( 
        * 1 => array($domain, $data["latitude"], $data["latitude"], $data["city"], 
        * $data["region"], $data["country_name"], $data["country_code"]),
        * 2 => array($domain, $data["latitude"], $data["latitude"], $data["city"], 
        * $data["region"], $data["country_name"], $data["country_code"])
        *              ); 
        *              print_r($shop);
        */

    //Si la variable contiente información, se imprime los datos en una tabla HTML
                    ?><table>
                        <thead>
                              <tr>
                                    <th>Dominio</th>
                                    <th>Protocolo</th>
                                    <th>Servidor</th>
                                    <th>Modificación</th>
                                    <th>Contenido</th>
                                    <th>Plataforma</th>
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
                                    echo "<strong>".$domain."</strong>";
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data_b[0]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data_b[2]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data_b[10]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data_b[12]);
                                    echo "</td>";

                                    echo "<td>";
                                          print_r($data_b[8]);
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
}                    
?>

