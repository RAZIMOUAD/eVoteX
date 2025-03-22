<?php
require_once 'models/Database.php';
require_once 'models/Candidate.php';

$candidate = new Candidate();
$candidates = $candidate->getAllCandidates();

$response = '<table>';
$response .= '<tr><th>Nom</th><th>Votes</th></tr>';
foreach ($candidates as $cand) {
    $response .= "<tr><td>" . utf8_decode($cand['name']) . "</td><td>" . $cand['votes'] . "</td></tr>";
}
$response .= '</table>';

echo $response;
?>
