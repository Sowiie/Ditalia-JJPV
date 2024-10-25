<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";

ejecutaServicio(function () {

 $lista = select(pdo: Bd::pdo(), from: CITAS, orderBy: CIT_FECHA);

 $render = "<dl>";
 foreach ($lista as $modelo) {
     $encodeId = urlencode($modelo[CIT_ID]);
     $id = htmlentities($encodeId);
     $fecha = htmlentities($modelo[CIT_FECHA]);
     $hora = htmlentities($modelo[CIT_HORA]);

     $render .= "
     <dt>Fecha</dt>
     <dd><a href='modifica.html?id=$id'>$fecha</a></dd>

     <dt>Hora</dt>
     <dd>$hora</dd>
     <br>";
 }
 $render .= "</dl>";

 devuelveJson(["lista" => ["innerHTML" => $render]]);
});
