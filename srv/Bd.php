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
    "CREATE TABLE IF NOT EXISTS TALLA (
      TALL_ID INTEGER,
      TALL_NOMBRE TEXT NOT NULL,
      TALL_DESCRIPCION TEXT NOT NULL,
      TALL_ESTADO TEXT NOT NULL,
      CONSTRAINT TALL_PK
       PRIMARY KEY(TALL_ID),
      CONSTRAINT TALL_NOM_UNQ
       UNIQUE(TALL_NOMBRE),
      CONSTRAINT TALL_NOM_NV
       CHECK(LENGTH(TALL_NOMBRE) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
