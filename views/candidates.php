<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?action=login');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Candidats</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Liste des candidats</h1>
        <form id="voteForm">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Vote</th>
                </tr>
                <?php
                require_once 'models/Candidate.php';
                $candidate = new Candidate();
                $candidates = $candidate->getAllCandidates();
                foreach ($candidates as $cand) {
                    echo "<tr>
                            <td>{$cand['name']}</td>
                            <td><input type='checkbox' name='vote[]' value='{$cand['id']}'></td>
                          </tr>";
                }
                ?>
            </table>
            <input type="submit" value="Voter">
        </form>
        <div class="message"></div>
        <a href="#" id="viewResults">Consulter les résultats en temps réel</a>
        <a href="pdf_generate.php">Reçu de vote (PDF)</a>
    </div>
    <script src="js/ajax_fonctions.js"></script>
    <script>
        document.getElementById('voteForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var Myrequest = getXMLHTTPRequest();
            var formData = new FormData(this);
            var queryString = new URLSearchParams(formData).toString();

            Myrequest.open("POST", "selectedCandidates.php", true);
            Myrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            Myrequest.onreadystatechange = function () {
                if (Myrequest.readyState == 4 && Myrequest.status == 200) {
                    var response = JSON.parse(Myrequest.responseText);
                    if (response.status === 'success') {
                        document.querySelector('.message').textContent = 'Vote soumis avec succès!';
                    } else {
                        document.querySelector('.message').textContent = response.message;
                    }
                }
            };
            Myrequest.send(queryString);
        });

        document.getElementById('viewResults').addEventListener('mouseover', function () {
            var Myrequest = getXMLHTTPRequest();

            Myrequest.open("GET", "view-results.php", true);

            Myrequest.onreadystatechange = function () {
                if (Myrequest.readyState == 4 && Myrequest.status == 200) {
                    document.querySelector('.message').innerHTML = Myrequest.responseText;
                }
            };
            Myrequest.send(null);
        });
    </script>
</body>
</html>
