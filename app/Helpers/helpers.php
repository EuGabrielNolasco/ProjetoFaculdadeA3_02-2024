<?php

// Updated validateDate function to handle format
if (!function_exists('validateDate')) {
    function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

if (!function_exists('formatCpfCnpj')) {
    function formatCpfCnpj($value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        if (strlen($value) === 11) {
            // Formatar CPF
            return substr($value, 0, 3) . '.' .
                substr($value, 3, 3) . '.' .
                substr($value, 6, 3) . '-' .
                substr($value, 9, 2);
        } elseif (strlen($value) === 14) {
            // Formatar CNPJ
            return substr($value, 0, 2) . '.' .
                substr($value, 2, 3) . '.' .
                substr($value, 5, 3) . '/' .
                substr($value, 8, 4) . '-' .
                substr($value, 12, 2);
        } else {
            return $value;
        }
    }
}

if (!function_exists('MascaraCPF')) {
    function MascaraCPF($value)
    {
        $value = preg_replace('/[^0-9]/', '', $value);

        if (strlen($value) === 11) {
            // Formatar CPF
            return '##' . substr($value, 1, 1) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-##';
        } else {
            return $value;
        }
    }
}