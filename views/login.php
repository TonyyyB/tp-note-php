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
        <h1>Veuillez vous connecter</h1>
    </header>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    echo $form->render();
    ?>
</body>

</html>