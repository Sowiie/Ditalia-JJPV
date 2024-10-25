<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaDescripcion.php";
require_once __DIR__ . "/../lib/php/validaEstado.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_TALLA.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $descripcion = recuperaTexto("desc");
 $estado = recuperaTexto("estado");

 $nombre = validaNombre($nombre);
 $descripcion = validaDescripcion($descripcion);
 $estado = validaEstado($estado);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: TALLA, values: [TALL_NOMBRE => $nombre, TALL_DESCRIPCION => $descripcion, TALL_ESTADO => $estado]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/talla.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "desc" => ["value" => $descripcion],
  "estado" => ["value" => $estado]
 ]);
});
