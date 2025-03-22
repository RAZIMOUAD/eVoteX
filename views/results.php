<!DOCTYPE html>
<html>
<head>
    <title>Résultats des Votes</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Résultats des Votes</h1>
        <div id="results"></div>
    </div>
    <script src="js/ajax_fonctions.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var Myrequest = getXMLHTTPRequest();

            Myrequest.open("GET", "view-results.php", true);

            Myrequest.onreadystatechange = function () {
                if (Myrequest.readyState == 4 && Myrequest.status == 200) {
                    document.getElementById('results').innerHTML = Myrequest.responseText;
                }
            };
            Myrequest.send(null);
        });
    </script>
</body>
</html>
