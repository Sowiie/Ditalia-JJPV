<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_CITAS.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(),  from: CITAS,  where: [CIT_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "CITA no encontrada.",
   type: "/error/citanoencontrado.html",
   detail: "No se encontró ninguna cita con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "fecha" => ["value" => $modelo[CIT_FECHA]],
  "hora" => ["value" => $modelo[CIT_HORA]],
  "estado" => ["value" => $modelo[CIT_ESTADO]],
 ]);
});
