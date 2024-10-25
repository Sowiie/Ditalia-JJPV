<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS CITAS (
      CIT_ID INTEGER,
      CIT_FECHA TEXT NOT NULL,
      CIT_HORA TEXT NOT NULL,
      CIT_ESTADO TEXT NOT NULL,
      CONSTRAINT CIT_PK
       PRIMARY KEY(CIT_ID),
      CONSTRAINT CIT_HORA_UNQ
       UNIQUE(CIT_HORA),
      CONSTRAINT CIT_HORA_NV
       CHECK(LENGTH(CIT_HORA) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
