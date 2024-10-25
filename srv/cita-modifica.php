<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaFecha.php";
require_once __DIR__ . "/../lib/php/validaHora.php";
require_once __DIR__ . "/../lib/php/validaEstado.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $fecha = recuperaTexto("fecha");
 $hora = recuperaTexto("hora");
 $estado = recuperaTexto("estado");

 $fecha = validaFecha($fecha);
 $hora = validaHora($hora);
 $estado = validaEstado($estado);

 update(
  pdo: Bd::pdo(),
  table: CITAS,
  set: [CIT_FECHA => $fecha],
  where: [CIT_ID => $id]
 );
 update(
  pdo: Bd::pdo(),
  table: CITAS,
  set: [CIT_HORA => $hora],
  where: [CIT_ID => $id]
 );
 update(
  pdo: Bd::pdo(),
  table: CITAS,
  set: [CIT_ESTADO => $estado],
  where: [CIT_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "fecha" => ["value" => $fecha],
  "hora" => ["value" => $hora],
  "estado" => ["value" => $estado]
 ]);
});
