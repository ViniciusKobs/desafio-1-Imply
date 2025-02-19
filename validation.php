<?php
// Vinícius Kobs
// 19/02/2025

// ---- DADOS ----
// nome
// sobrenome
// idade
//
// e-mail
// cpf
// senha
// confirma senha

const MIN_PASSWORD_LENGTH = 8;
const MAX_PASSWORD_LENGTH = 64;
const MAX_NAME_LENGTH = 64;
const MAX_AGE = 150;
const MAX_EMAIL_LENGTH = 64;
const MAX_EMAIL_LOCAL_LENGTH = 63;

// https://emailregex.com/
const EMAIL_REGEX = '/(?:[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)])/';

function test_functions() {
    $should_stop = false;
    while (!$should_stop) {
        $valid_data = [
            "name" => readline("Nome: "),
            "surname" => readline("Sobrenome: "),
            "age" => (int)readline("Idade: "),
            "email" => readline("E-mail: "),
            "cpf" => readline("CPF: "),
            "password" => readline("Senha: "),
            "confirm_password" => readline("Confirme a senha: ")
        ];

        echo is_valid_name($valid_data["name"]) ? "\033[32m\nNome Valido\n\033[0m" : "\033[31mNome Invalido\033[0m\n";
        echo is_valid_name($valid_data["surname"]) ? "\033[32mSobrenome Valido\n\033[0m" : "\033[31mSobrenome Invalido\033[0m\n";
        echo is_valid_age($valid_data["age"]) ? "\033[32mIdade Valida\n\033[0m" : "\033[31mIdade Invalida\033[0m\n";
        echo is_valid_email_regex($valid_data["email"]) ? "\033[32mE-mail Valido\n\033[0m" : "\033[31mE-mail Invalido\033[0m\n";
        echo is_valid_cpf($valid_data["cpf"]) ? "\033[32mCPF Valido\n\033[0m" : "\033[31mCPF Invalido\033[0m\n";
        echo is_valid_password($valid_data["password"]) ? "\033[32mSenha Valida\n\033[0m" : "\033[31mSenha Invalida\033[0m\n";
        echo ($valid_data["password"] === $valid_data["confirm_password"]) ? "\033[32mSenhas Conferem\n\033[0m" : "\033[31mSenhas Não Conferem\033[0m\n";
        echo validate($valid_data) ? "\033[32mDados Validos\n\n\033[0m" : "\033[31mDados Invalidos\033[0m\n\n";

        $should_stop = strtolower(readline("Testar novamente? [S/N] ")) === "n";
    }
}

function validate($data) {
    if (!is_data($data)) { return false; }
    return 
        is_valid_name($data["name"]) &&
        is_valid_name($data["surname"]) &&
        is_valid_age($data["age"]) &&
        is_valid_email_regex($data["email"]) &&
        is_valid_cpf($data["cpf"]) &&
        is_valid_password($data["password"]) &&
        $data["password"] === $data["confirm_password"]
    ;
}

function is_data($data) {
    return is_array($data) && isset($data["name"], $data["surname"], $data["age"], $data["email"], $data["cpf"], $data["password"], $data["confirm_password"]);
}

function is_valid_name($name) {
    // is a string
    // length between MIN_NAME_LENGTH and MAX_NAME_LENGTH
    return
        is_string($name) &&
        strlen($name) > 0 &&
        strlen($name) >= MAX_NAME_LENGTH
    ;
}

function is_valid_age($age) {
    // is an integer
    // is greater than 0
    // is less than MAX_AGE
    return
        is_int($age) &&
        $age > 0 &&
        $age <= MAX_AGE
    ;
}



function is_valid_password($password) {
    // is a string
    // contains at least N characters
    // contains at least one lowercase and one uppercase character
    // contains at least one number
    // contains at least one special symbol
    return
        is_string($password) &&
        strlen($password) >= MIN_PASSWORD_LENGTH &&
        strlen($password) <= MAX_PASSWORD_LENGTH &&
        preg_match('/[a-z]/', $password) &&
        preg_match('/[A-Z]/', $password) &&
        preg_match('/[0-9]/', $password) &&
        preg_match('/[\W_]/', $password)
    ;
}

// https://www.macoratti.net/alg_cpf.htm
function is_valid_cpf($cpf) {
    // is an integer
    // do cpf validation (module 11)

    $formated_cpf = preg_replace('/[.-]/', '', $cpf);

    if (
        !is_string($formated_cpf) &&
        strlen($formated_cpf) === 11 &&
        !preg_match('/^\d+$/', $formated_cpf)
    ) {
        return false;
    }

    $digits = array_map('intval', str_split($formated_cpf));

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

    return
        $digits[9] === $d1 &&
        $digits[10] === $d2
        ;
}

// there are two ways of doing this:
// 1 - is to use a huge or multiple regular expressions, which can be problematic
// 2 - is to do a basic validation, pass to the email server, and catch an exception if invalid
// https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html#email-address-validation
function is_valid_email_basic($email) {
    // is a string
    // do basic email validation
    $parts = explode("@", $email);
    return
        is_string($email) &&
        sizeof($parts) === 2 &&
        strlen($parts[0]) > 0 &&
        strlen($parts[0]) <= MAX_EMAIL_LOCAL_LENGTH &&
        strlen($parts[1]) > 0 &&
        strlen($email) <= MAX_EMAIL_LENGTH &&
        !preg_match('/["\';<>\[\]()\s]/', $email) &&
        preg_match('/^[a-zA-Z0-9\-.\s]+$/', $parts[1])
        ;
}

function is_valid_email_regex($email) {
    // is a string
    // do regex email validation
    return
        is_string($email) &&
        strlen($email) <= MAX_EMAIL_LENGTH &&
        preg_match(EMAIL_REGEX, $email)
        ;
}

test_functions();