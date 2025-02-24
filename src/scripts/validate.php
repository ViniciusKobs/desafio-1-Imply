<?php

require_once "constants.php";
require_once "locale.php";

function validate() : void {
    if (!is_valid_session()) { return; }

    $data = get_data();
    $errors = [];

    validate_name($data["name"], $errors);
    validate_surname($data["surname"], $errors);
    validate_age($data["age"], $errors);
    validate_email($data["email"], $errors);
    validate_cpf($data["cpf"], $errors);
    validate_password($data["password"], $errors);
    confirm_password($data["password"], $data["confirm_password"], $errors);

    // erasing password history for security reasons
    unset($data["password"], $data["confirm_password"]);

    if (empty($errors)) {
        $status = store_data($data);
        header("Location: " . CONFIRMATION_URL . http_build_query(["status" => $status ? "SUCCESS" : "FAILURE"]));
        return;
    }

    header("Location: " . ERROR_URL . http_build_query(array_merge($data, $errors)));
}

function is_valid_session() : bool {
    global $error_messages;

    session_start();

    if (empty($_POST["csrf-token"])) {
        echo $error_messages["CSRF_POST_MISSING"];
        return false;
    }

    if (empty($_SESSION["csrf_token"])) {
        echo $error_messages["CSRF_SESSION_MISSING"];
        return false;
    }

    if ($_POST["csrf-token"] !== $_SESSION["csrf_token"]) {
        echo $error_messages["CSRF_INVALID"];
        return false;
    }

    unset($_POST["csrf_token"], $_SESSION["csrf_token"]);

    return true;
}

function get_data() : array {
    // might implement sql sanitization
    return [
        "name" => htmlspecialchars(trim($_POST["name"] ?? '')),
        "surname" => htmlspecialchars(trim($_POST["surname"] ?? '')),
        "age" => htmlspecialchars(trim($_POST["age"] ?? '')),
        "email" => htmlspecialchars(trim($_POST["email"] ?? '')),
        "cpf" => htmlspecialchars(trim($_POST["cpf"] ?? '')),
        "password" => htmlspecialchars(trim($_POST["password"] ?? '')),
        "confirm_password" => htmlspecialchars(trim($_POST["confirm-password"] ?? ''))
    ];
}

function store_data($data) : bool {
    $path = getcwd() . STORAGE_PATH;

    $content = file_get_contents($path);
    if ($content === false) { return false; }

    $storage = json_decode($content, true);
    if ($storage === NULL && !empty(trim($content))) { return false; }

    $storage[] = $data;

    $status = file_put_contents($path, json_encode($storage, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    if ($status === false) { return false; }

    return true;
}

function validate_name($name, &$errors) : void {
    if (empty($name)) {
        $errors["name_error"] = "NAME_MISSING";
        return;
    }

    if (preg_match('/\d/', $name)) {
        $errors["name_error"] = "NAME_NUMBER";
        return;
    }

    if (strlen($name) > MAX_NAME_LENGTH) {
        $errors["name_error"] = "NAME_LARGE";
    }
}

function validate_surname($name, &$errors) : void {
    if (empty($name)) {
        $errors["surname_error"] = "SURNAME_MISSING";
        return;
    }

    if (preg_match('/\d/', $name)) {
        $errors["surname_error"] = "SURNAME_NUMBER";
        return;
    }

    if (strlen($name) > MAX_NAME_LENGTH) {
        $errors["surname_error"] = "SURNAME_LARGE";
    }
}

function validate_age($age, &$errors) : void {
    if (empty($age)) {
        $errors["age_error"] = "AGE_MISSING";
        return;
    }

    if (!preg_match('/^\d+$/', $age)) {
        $errors["cpf_error"] = "AGE_NUMBER";
        return;
    }

    $age_int = (int)$age;

    if ($age_int < 0 || $age_int > MAX_AGE) {
        $errors["age_error"] = "AGE_INVALID";
    }
}

function validate_email($email, &$errors) : void {
    if (empty($email)) {
        $errors["email_error"] = "EMAIL_MISSING";
        return;
    }

    if (strlen($email) > MAX_EMAIL_LENGTH) {
        $errors["email_error"] = "EMAIL_LARGE";
        return;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email_error"] = "EMAIL_INVALID";
    }
}

function validate_password($password, &$errors) : void {
    if (empty($password)) {
        $errors["password_error"] = "PASSWORD_MISSING";
        return;
    }

    if (strlen($password) < MIN_PASSWORD_LENGTH) {
        $errors["password_error"] = "PASSWORD_SMALL";
        return;
    }

    if (strlen($password) > MAX_PASSWORD_LENGTH) {
        $errors["password_error"] = "PASSWORD_LARGE";
        return;
    }

    if (!preg_match('/[a-z]/', $password)) {
        $errors["password_error"] = "PASSWORD_LOWER";
        return;
    }

    if (!preg_match('/[A-Z]/', $password)) {
        $errors["password_error"] = "PASSWORD_UPPER";
        return;
    }

    if (!preg_match('/[0-9]/', $password)) {
        $errors["password_error"] = "PASSWORD_NUMBER";
        return;
    }

    if (!preg_match('/[\W_]/', $password)) {
        $errors["password_error"] = "PASSWORD_SPECIAL";
    }
}

function confirm_password($password, $confirm_password, &$errors) : void {
    if (empty($confirm_password)) {
        $errors["confirm_password_error"] = "CONFIRM_PASSWORD_MISSING";
        return;
    }

    if ($password !== $confirm_password) {
        $errors["confirm_password_error"] = "CONFIRM_PASSWORD_INVALID";
    }
}

function validate_cpf($cpf, &$errors) : void {
    if (empty($cpf)) {
        $errors["cpf_error"] = "CPF_MISSING";
        return;
    }

    $formated_cpf = preg_replace('/[.-]/', '', $cpf);

    if (strlen($formated_cpf) !== 11) {
        $errors["cpf_error"] = "CPF_WRONG_SIZE";
        return;
    }

    if (!preg_match('/^\d+$/', $formated_cpf)) {
        $errors["cpf_error"] = "CPF_NUMBER";
        return;
    }

    if (!is_valid_cpf($formated_cpf)) {
        $errors["cpf_error"] = "CPF_INVALID";
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
