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
        <h1>Voici les scores: </h1>
        <a href="result">
            <button>Voir les scores</button>
        </a>
        <a href="logout">
            <button>Se déconnecter</button>
        </a>
    </header>
    <table>
        <thead>
            <tr>
                <th>Score</th>
                <th>Date/heure</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($scores as $score) {
                echo "<tr>";
                echo "<td>" . $score["scoreRes"] . "</td>";
                echo "<td>" . $score["dateRes"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>