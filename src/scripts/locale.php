<?php

require_once "constants.php";

$error_messages = [
    "NAME_MISSING" => "O campo nome é obrigatório.",
    "NAME_NUMBER" => "O nome não deve conter dígitos.",
    "NAME_LARGE" => "O nome deve ter no máximo " . MAX_NAME_LENGTH . " caracteres.",

    "SURNAME_MISSING" => "O campo sobrenome é obrigatório.",
    "SURNAME_NUMBER" => "O sobrenome não deve conter dígitos.",
    "SURNAME_LARGE" => "O sobrenome deve ter no máximo " . MAX_NAME_LENGTH . " caracteres.",

    "AGE_MISSING" => "O campo idade é obrigatório.",
    "AGE_NUMBER" => "A idade deve conter apenas dígitos.",
    "AGE_INVALID" => "A idade deve estar entre 0 e " . MAX_AGE . " anos.",

    "EMAIL_MISSING" => "O campo e-mail é obrigatório.",
    "EMAIL_LARGE" => "O e-mail deve ter no máximo " . MAX_EMAIL_LENGTH . " caracteres.",
    "EMAIL_INVALID" => "Este e-mail é inválido.",

    "PASSWORD_MISSING" => "O campo senha é obrigatório.",
    "PASSWORD_SMALL" => "A senha deve ter no mínimo " . MIN_PASSWORD_LENGTH . " caracteres.",
    "PASSWORD_LARGE" => "A senha deve ter no máximo " . MAX_PASSWORD_LENGTH . " caracteres.",
    "PASSWORD_LOWER" => "A senha deve conter pelo menos uma letra minúscula.",
    "PASSWORD_UPPER" => "A senha deve conter pelo menos uma letra maiúscula.",
    "PASSWORD_NUMBER" => "A senha deve conter pelo menos um número.",
    "PASSWORD_SPECIAL" => "A senha deve conter pelo menos um caractere especial.",

    "CONFIRM_PASSWORD_MISSING" => "A confirmação da senha é obrigatória.",
    "CONFIRM_PASSWORD_INVALID" => "As senhas não coincidem.",

    "CPF_MISSING" => "O campo CPF é obrigatório.",
    "CPF_WRONG_SIZE" => "O CPF deve conter 11 dígitos.",
    "CPF_NUMBER" => "O CPF deve conter apenas dígitos.",
    "CPF_INVALID" => "Este CPF é inválido.",

    "CSRF_POST_MISSING" => "Token CSRF do POST ausente.",
    "CSRF_SESSION_MISSING" => "Token CSRF da Sessão ausente.",
    "CSRF_INVALID" => "Token CSRF inválido."
];