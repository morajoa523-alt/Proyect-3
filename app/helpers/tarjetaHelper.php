<?php
class tarjetaHelper {

    public function validarNumerica($numero) {
        return ctype_digit($numero);
    }

    // Algoritmo de Luhn
    public static function validarLuhn($numero) {
        $suma = 0;
        $duplicar = false;

        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $digito = intval($numero[$i]);

            if ($duplicar) {
                $digito *= 2;
                if ($digito > 9) {
                    $digito -= 9;
                }
            }

            $suma += $digito;
            $duplicar = !$duplicar;
        }

        return $suma % 10 === 0;
    }

    public function obtenerMarca($numero) {
        if (str_starts_with($numero, '4')) {
            return 'VISA';
        } elseif (preg_match('/^5[1-5]/', $numero)) {
            return 'MASTERCARD';
        } elseif (str_starts_with($numero, '6011') || str_starts_with($numero, '65')) {
            return 'DISCOVER';
        }
        return 'DESCONOCIDA';
    }

    public  function obtenerBIN($numero) {
        return strlen($numero) >= 6 ? substr($numero, 0, 6) : null;
    }

    public function obtenerCuenta($numero) {
        return strlen($numero) > 7 ? substr($numero, 6, -1) : null;
    }

    public function obtenerDigitoControl($numero) {
        return substr($numero, -1);
    }
}
?>