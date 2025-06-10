<?php
if (!function_exists('convertir_a_letras')) {
    function convertir_a_letras($numero, $moneda = '')
    {
        // Implementa tu función para convertir número a letras en español.
        // Por ejemplo, usa una librería, o tu código anterior extraído de utils.php.
        // Retorna la cadena “X Bolivianos”.
        // Ejemplo básico (necesita versión real para números grandes):
        $formatter = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $letra = $formatter->format($numero);
        return ucfirst($letra) . ' ' . $moneda;
    }
}
