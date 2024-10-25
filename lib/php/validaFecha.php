<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaFecha(false|string $fecha)
{

 if ($fecha === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta la fecha.",
   type: "/error/faltaFecha.html",
   detail: "La solicitud no tiene el valor de la fecha."
  );

 $trimFecha = trim($fecha);

 if ($trimFecha === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Fecha en blanco.",
   type: "/error/fechaVacia.html",
   detail: "Pon texto en el campo fecha.",
  );

 return $trimFecha;
}