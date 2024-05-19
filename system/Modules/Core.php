<?php
class Core {
    public static function money($cantidad) {
        // Elimina caracteres no numéricos (como comas y puntos)
        $cantidad = preg_replace('/[^0-9.]/', '', $cantidad);
        
        // Convierte la cantidad a un número decimal
        $numero = floatval($cantidad);
        
        $dineroFormateado = number_format($numero, 2, '.', '');
        
        return $dineroFormateado;
    }
}
?>