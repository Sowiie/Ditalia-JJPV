<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaFecha.php";
require_once __DIR__ . "/../lib/php/validaHora.php";
require_once __DIR__ . "/../lib/php/validaEstado.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";

ejecutaServicio(function () {

 $fecha = recuperaTexto("fecha");
 $hora = recuperaTexto("hora");
 $estado = recuperaTexto("estado");

 $fecha = validaFecha($fecha);
 $hora = validaHora($hora);
 $estado = validaEstado($estado);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: CITAS, values: [CIT_FECHA => $fecha, CIT_HORA => $hora, CIT_ESTADO => $estado]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/citas.php?id=$encodeId", [
  "id" => ["value" => $id],
  "fecha" => ["value" => $fecha],
  "hora" => ["value" => $hora],
  "estado" => ["value" => $estado]
 ]);
});
