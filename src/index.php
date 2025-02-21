<?php
    require_once "scripts/constants.php";
    require_once "scripts/locale.php";
    global $errors;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <header></header>
    <main>
        <p id="page-title">Registrar</p>
        <form class="shadow-box" action="scripts/validate.php" method="POST">
            <p id="form-title" class="colored-box">Formulário</p>
            <div id="form-container" class="inverse-shadow-box">
                <div id="kiwi" class="form-container-child"></div>
                <div class="separator"></div>
                <div class="form-container-child">
                    <div class="form-input">
                        <label for="form-name">Nome</label>
                        <input type="text" id="form-name" class="inverse-shadow-box" name="name" placeholder="Nome" value=<?php echo $_GET["name"] ?? "" ?>>
                        <?php
                            if (isset($_GET["name_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["name_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-surname">Sobrenome</label>
                        <input type="text" id="form-surname" class="inverse-shadow-box" name="surname" placeholder="Sobrenome" value=<?php echo $_GET["surname"] ?? "" ?>>
                        <?php
                            if (isset($_GET["surname_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["surname_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-email">Email</label>
                        <input type="text" id="form-email" class="inverse-shadow-box" name="email" placeholder="Email" value=<?php echo $_GET["email"] ?? "" ?>>
                        <?php
                            if (isset($_GET["email_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["email_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-cpf">CPF</label>
                        <!-- for now use type text here, so I don't need to deal with leading 0s -->
                        <!-- might implement a javascript maks for live formatting and blocking invalid characters -->
                        <input type="text" id="form-cpf" class="inverse-shadow-box" name="cpf" placeholder="CPF" value=<?php echo $_GET["cpf"] ?? "" ?>>
                        <?php
                            if (isset($_GET["cpf_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["cpf_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-age">Idade</label>
                        <input type="number" id="form-age" class="inverse-shadow-box" name="age" placeholder="Idade" value=<?php echo $_GET["age"] ?? "" ?>>
                        <?php
                            if (isset($_GET["age_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["age_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-password">Senha</label>
                        <input type="password" id="form-password" class="inverse-shadow-box" name="password" placeholder="Senha" value=<?php echo $_GET["password"] ?? "" ?>>
                        <?php
                            if (isset($_GET["password_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["password_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <div class="form-input">
                        <label for="form-confirm-password">Confirmar Senha</label>
                        <input type="password" id="form-confirm-password" class="inverse-shadow-box" name="confirm-password" placeholder="Confirmar Senha" value=<?php echo $_GET["confirm_password"] ?? "" ?>>
                        <?php
                            if (isset($_GET["confirm_password_error"])) {
                                echo "<p class=\"form-error\">" . $errors[$_GET["confirm_password_error"]] . "</p>";
                            }
                        ?>
                    </div>
                    <button id="form-submit" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </main>
    <footer>made by <a href="https://github.com/ViniciusKobs">Vinícius Kobs</a></footer>
</body>
</html>