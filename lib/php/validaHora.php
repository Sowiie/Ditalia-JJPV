<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaHora(false|string $hora)
{

 if ($hora === false)
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Falta la hora.",
   type: "/error/faltaHora.html",
   detail: "La solicitud no tiene el valor de la hora."
  );

 $trimHora = trim($hora);

 if ($trimHora === "")
  throw new ProblemDetails(
   status: BAD_REQUEST,
   title: "Hora en blanco.",
   type: "/error/horaVacia.html",
   detail: "Pon texto en el campo hora.",
  );

 return $trimHora;
}