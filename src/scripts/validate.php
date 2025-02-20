<?php

const MAX_NAME_LENGTH = 64;
const MAX_AGE = 150;
const MAX_EMAIL_LENGTH = 254;
const MIN_PASSWORD_LENGTH = 8;
const MAX_PASSWORD_LENGTH = 64;

function validate() : void {
    $data = [
        "name" => $_POST["name"] ?? '',
        "surname" => $_POST["surname"] ?? '',
        "age" => $_POST["age"] ?? 0,
        "email" => $_POST["email"] ?? '',
        "cpf" => $_POST["cpf"] ?? '',
        "password" => $_POST["password"] ?? '',
        "confirm_password" => $_POST["confirm-password"] ?? ''
    ];
    $errors = [];

    validate_name($data["name"], $errors);
    validate_surname($data["surname"], $errors);
    validate_age($data["age"], $errors);
    validate_email($data["email"], $errors);
    validate_cpf($data["cpf"], $errors);
    validate_password($data["password"], $errors);
    confirm_password($data["password"], $data["confirm_password"], $errors);

    if (empty($errors)) {
        header("Location: /forms/success.php");
        return;
    }

    // erasing password history for security reasons
    $data["password"] = ""; $data["confirm_password"] = "";

    header("Location: /forms/index.php?" . http_build_query(array_merge($data, $errors)));
}

function validate_name($name, &$errors) : void {
    if (empty($name)) {
        $errors["name_error"] = "Campo nome é obrigatorio";
        return;
    }

    if (strlen($name) > MAX_NAME_LENGTH) {
        $errors["name_error"] = "Nome deve ter até " . MAX_NAME_LENGTH . "caracteres";
    }

    // might add rule that prohibits numbers
}

function validate_surname($name, &$errors) : void {
    // not sure if surname is mandatory
    if (empty($name)) {
        $errors["surname_error"] = "Campo sobrenome é obrigatorio";
        return;
    }

    if (strlen($name) > MAX_NAME_LENGTH) {
        $errors["surname_error"] = "Sobrenome deve ter até " . MAX_NAME_LENGTH . " caracteres";
    }

    // might add rule that prohibits numbers
}

function validate_age($age, &$errors) : void {
    if ($age < 0 || $age > MAX_AGE) {
        $errors["age_error"] = "Campo idade deve ser entre 0 e " . MAX_AGE;
    }
}

function validate_email($email, &$errors) : void {
    if (empty($email)) {
        $errors["email_error"] = "Campo email é obrigatorio";
        return;
    }

    if (strlen($email) > MAX_EMAIL_LENGTH) {
        $errors["email_error"] = "Campo email deve ter até" . MAX_EMAIL_LENGTH . " caracteres";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email_error"] = "Email invalido";
    }
}
function validate_password($password, &$errors) : void {
    if (empty($password)) {
        $errors["password_error"] = "Campo senha é obrigatorio";
        return;
    }

    if (strlen($password) < MIN_PASSWORD_LENGTH) {
        $errors["password_error"] = "Campo senha deve ter no minimo 8 caracteres";
        return;
    }

    if (strlen($password) > MAX_PASSWORD_LENGTH) {
        $errors["password_error"] = "Campo senha deve ter no maximo 64 caracteres";
        return;
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors["password_error"] = "Campo senha deve ter pelo menos uma letra minuscula";
        return;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors["password_error"] = "Campo senha deve ter pelo menos uma letra maiuscula";
        return;
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors["password_error"] = "Campo senha deve ter pelo menos um numero";
        return;
    }

    if (!preg_match('/[\W_]/', $password)) {
        $errors["password_error"] = "Campo senha deve ter pelo menos um caracter especial";
    }
}

function confirm_password($password, $confirm_password, &$errors) : void {
    if (empty($confirm_password)) {
        $errors["confirm_password_error"] = "Campo confirmar senha é obrigatorio";
        return;
    }

    if ($password !== $confirm_password) {
        $errors["confirm_password_error"] = "Senhas nao conferem";
    }
}

function validate_cpf($cpf, &$errors) : void {
    if (empty($cpf)) {
        $errors["cpf_error"] = "Campo cpf é obrigatorio";
        return;
    }

    $formated_cpf = preg_replace('/[.-]/', '', $cpf);

    if (strlen($formated_cpf) !== 11) {
        $errors["cpf_error"] = "Campo cpf deve ter 11 digitos";
        return;
    }

    if (!preg_match('/^\d+$/', $formated_cpf)) {
        $errors["cpf_error"] = "Campo cpf deve ter somente digitos";
        return;
    }

    if (!is_valid_cpf($formated_cpf)) {
        $errors["cpf_error"] = "CPF invalido";
    }
}

function is_valid_cpf($cpf) : bool {
    $digits = array_map('intval', str_split($cpf));

    $d1 = 0;
    for ($i = 0; $i < 9; $i++) {
        $d1 += $digits[$i] * (10 - $i);
    }
    $d1 = ($d1 % 11 < 2) ? 0 : 11 - ($d1 % 11);

    $d2 = 0;
    for ($i = 0; $i < 10; $i++) {
        $d2 += $digits[$i] * (11 - $i);
    }
    $d2 = ($d2 % 11 < 2) ? 0 : 11 - ($d2 % 11);

    return $digits[9] === $d1 && $digits[10] === $d2;
}

validate();
