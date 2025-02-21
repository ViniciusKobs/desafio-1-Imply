<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        h1 {
            color: green;
        }
    </style>

</head>
<body>
    <header><div style="height:1.3rem;"></div></header>
    <main>
        <div id="success-container">
            <div id="success-box" class="shadow-box">
                <p class="form-title colored-box">
                    <?php echo (($_GET["status"] ?? "FAILURE") === "SUCCESS") ? "Sucesso" : "Fracasso" ?>
                </p>
                <div id="success-message-box">
                    <?php
                        echo (($_GET["status"] ?? "FAILURE") === "SUCCESS") ?
                            "<img src='assets/icon2.png' alt='icon'>" :
                            "<img src='assets/icon3.png' alt='icon'>"
                    ?>
                    <div>
                        <?php
                            echo (($_GET["status"] ?? "FAILURE") === "SUCCESS") ?
                                "<p>Seu cadastro foi concluído com sucesso. Entraremos em contato em breve.</p>" :
                                "<p>Houve um erro ao realizar o seu cadastro. Tente novamente mais tarde.</p>"
                        ?>
                    </div>
                </div>
                <div id="success-button-box">
                    <button class="form-button" onclick="location.href='/forms/register.php'">OK</button>
                </div>
            </div>
        </div>
    </main>
    <footer>feito por <a href="https://github.com/ViniciusKobs">Vinícius Kobs</a></footer>
</body>
</html>
