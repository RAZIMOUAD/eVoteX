<!DOCTYPE html>
<html>
<head>
    <title>Vote pour les Candidats</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#voteForm').on('submit', function(e) {
                e.preventDefault();

                var selectedCandidates = $('input[name="vote[]"]:checked').length;
                
                if (selectedCandidates > 3) {
                    alert("Vous ne pouvez voter que pour un maximum de trois candidats.");
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'selectedCandidates.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status === 'success') {
                            window.location.href = 'index.php?action=recap';
                        } else {
                            $('.message').text(res.message);
                        }
                    }
                });
            });

            $('#viewResults').on('click', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'GET',
                    url: 'view-results.php',
                    success: function(response) {
                        $('#results').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Liste des Candidats</h1>
        <form id="voteForm">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Vote</th>
                </tr>
                <?php
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
        <div id="results"></div>
    </div>
</body>
</html>
