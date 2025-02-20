<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <header>header</header>
    <main>
        <form action="scripts/validate.php" method="POST">
            <p id="form-title">Formulário</p>
            <div>
                <label for="form-name">Nome</label>
                <input type="text" id="form-name" name="name" placeholder="Nome" value=<?php echo $_GET["name"] ?? "" ?>>
                <?php
                    if (isset($_GET["name_error"])) {
                        echo "<p class=\"form-error\">" . $_GET["name_error"] . "</p>";
                    }
                ?>
            </div>
            <div>
                <label for="form-surname">Sobrenome</label>
                <input type="text" id="form-surname" name="surname" placeholder="Sobrenome" value=<?php echo $_GET["surname"] ?? "" ?>>
                <?php
                    if (isset($_GET["surname_error"])) {
                        echo "<p class=\"form-error\">" . $_GET["surname_error"] . "</p>";
                    }
                ?>
            </div>
            <div>
                <label for="form-email">Email</label>
                <input type="text" id="form-email" name="email" placeholder="Email" value=<?php echo $_GET["email"] ?? "" ?>>
                <?php
                    if (isset($_GET["email_error"])) {
                        echo "<p class=\"form-error\">" . $_GET["email_error"] . "</p>";
                    }
                ?>
            </div>
            <div>
                <label for="form-cpf">CPF</label>
                <!-- for now use type text here, so I don't need to deal with leading 0s -->
                <!-- might implement a javascript maks for live formatting and blocking invalid characters -->
                <input type="text" id="form-cpf" name="cpf" placeholder="CPF" value=<?php echo $_GET["cpf"] ?? "" ?>>
                <?php
                if (isset($_GET["cpf_error"])) {
                    echo "<p class=\"form-error\">" . $_GET["cpf_error"] . "</p>";
                }
                ?>
            </div>
            <div>
                <label for="form-age">Idade</label>
                <input type="number" id="form-age" name="age" placeholder="Idade" value=<?php echo $_GET["age"] ?? "" ?>
                <?php
                if (isset($_GET["age_error"])) {
                    echo "<p class=\"form-error\">" . $_GET["age_error"] . "</p>";
                }
                ?>
            </div>
            <div>
                <label for="form-password">Senha</label>
                <input type="password" id="form-password" name="password" placeholder="Senha" value=<?php echo $_GET["password"] ?? "" ?>>
                <?php
                if (isset($_GET["password_error"])) {
                    echo "<p class=\"form-error\">" . $_GET["password_error"] . "</p>";
                }
                ?>
            </div>
            <div>
                <label for="form-confirm-password">Confirmar Senha</label>
                <input type="password" id="form-confirm-password" name="confirm-password" placeholder="Confirmar Senha" value=<?php echo $_GET["confirm_password"] ?? "" ?>>
                <?php
                    if (isset($_GET["confirm_password_error"])) {
                        echo "<p class=\"form-error\">" . $_GET["confirm_password_error"] . "</p>";
                    }
                ?>
            </div>
            <div>
                <button id="form-submit" type="submit">Enviar</button>
            </div>
        </form>
    </main>
    <footer>footer</footer>
</body>
</html>