<?php
if(session_status() == PHP_SESSION_NONE){
session_start();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="<?= URL . 'css/cssComer/compraRealizada.css'?>">
  <title>Pago Exitoso</title>

</head>