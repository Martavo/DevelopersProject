<?php 
function obtenerArraysConValorDado($array, $valor) {
    $arraysConValorDado = [];
    foreach ($array as $subArray) {
      if (in_array($valor, $subArray)) {
        $arraysConValorDado[] = $subArray;
      }
    }
    return $arraysConValorDado;
  }

  $array = [
    [1, 2, 3],
    [4, 5, 6],
    [7, 8, 9],
    [10, 11, 12],
  ];
  
  $valor = 5;
  
  $arraysConValorDado = obtenerArraysConValorDado($array, $valor);
  
  print_r($arraysConValorDado);