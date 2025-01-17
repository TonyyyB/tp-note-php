<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>SuperQuiz</title>
</head>

<body>
    <header class="header">
        <h1>Voici les réponses: </h1>
        <a href="logout">
            <button>Se déconnecter</button>
        </a>
    </header>
    <?php
    echo $quiz->renderAnswer($_POST);
    ?>
</body>

</html>