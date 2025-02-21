<?php

require_once "constants.php";

// TODO: write better error messages
$errors = [
    "NAME_MISSING" => "Nome é obrigatorio",
    "NAME_NUMBER" => "Nome não deve possuír digitos",
    "NAME_LARGE" => "Nome deve ter até " . MAX_NAME_LENGTH . " caracteres",

    "SURNAME_MISSING" => "Sobrenome é obrigatorio",
    "SURNAME_NUMBER" => "Sobrenome não deve possuír digitos",
    "SURNAME_LARGE" => "Sobrenome deve ter até " . MAX_NAME_LENGTH . " caracteres",

    "AGE_INVALID" => "Idade deve ser entre 0 e " . MAX_AGE . " anos",

    "EMAIL_MISSING" => "Email é obrigatorio",
    "EMAIL_LARGE" => "Email deve ter até " . MAX_EMAIL_LENGTH . " caracteres",
    "EMAIL_INVALID" => "Email invalido",

    "PASSWORD_MISSING" => "Senha é obrigatorio",
    "PASSWORD_SMALL" => "Senha deve ter no minimo " . MIN_PASSWORD_LENGTH . " caracteres",
    "PASSWORD_LARGE" => "Senha deve ter no maximo " . MAX_PASSWORD_LENGTH . " caracteres",
    "PASSWORD_LOWER" => "Senha deve ter pelo menos uma letra minuscula",
    "PASSWORD_UPPER" => "Senha deve ter pelo menos uma letra maiuscula",
    "PASSWORD_NUMBER" => "Senha deve ter pelo menos um numero",
    "PASSWORD_SPECIAL" => "Senha deve ter pelo menos um caracter especial",

    "CONFIRM_PASSWORD_MISSING" => "Confirmar senha é obrigatorio",
    "CONFIRM_PASSWORD_INVALID" => "Senhas nao conferem",

    "CPF_MISSING" => "Cpf é obrigatorio",
    "CPF_WRONG_SIZE" => "Cpf deve ter 11 digitos",
    "CPF_NUMBER" => "Cpf deve ter somente digitos",
    "CPF_INVALID" => "CPF invalido"
];
