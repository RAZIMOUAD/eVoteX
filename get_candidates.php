<?php
require_once 'models/Candidate.php';

$candidate = new Candidate();
$candidates = $candidate->getAllCandidates();

header('Content-Type: application/json');
echo json_encode($candidates);
?>
