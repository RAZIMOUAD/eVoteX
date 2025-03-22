<!DOCTYPE html>
<html>
<head>
    <title>Récapitulatif des Votes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Récapitulatif des Votes</h1>
        <table>
            <tr>
                <th>Nom</th>
            </tr>
            <?php
            foreach ($votedCandidates as $cand) {
                echo "<tr><td>{$cand['name']}</td></tr>";
            }
            ?>
        </table>
        <a href="pdf_generate.php">Télécharger le reçu (PDF)</a>
    </div>
</body>
</html>
