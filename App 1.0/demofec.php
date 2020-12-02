<?php

/**
 * @author gencyolcu
 * @copyright 2014
 */
$fecha="2014/05/28";
require ("funciones.php");

                                        if (dia($fecha)<>"Lunes"){
                                           $ft = $fecha; 
                                            while (dia($ft)<>"Lunes"){
                                                $ft = date('Y-m-d', strtotime("$ft + 1day"));                                            
                                                }
                                            $ffin = $ft;
                                            echo 'el proximo lunes es '.$ffin;
                                        } 
?>