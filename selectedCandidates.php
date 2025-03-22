<?php
require_once 'models/Database.php';
require_once 'models/Vote.php';
require_once 'models/Candidate.php';
require_once 'models/User.php';

session_start();

$userId = $_SESSION['user_id'];
$vote = new Vote();
$candidate = new Candidate();

if ($vote->hasVoted($userId)) {
    echo json_encode(['status' => 'error', 'message' => 'Vous avez déjà voté.']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['vote'])) {
    if (count($_POST['vote']) > 3) {
        echo json_encode(['status' => 'error', 'message' => 'Vous ne pouvez voter que pour un maximum de trois candidats.']);
        return;
    }

    $votedCandidates = [];
    foreach ($_POST['vote'] as $candidateId) {
        $vote->castVote($userId, $candidateId);
        $candidate->incrementVote($candidateId);
        $votedCandidates[] = $candidateId;
    }

    $_SESSION['voted_candidates'] = $votedCandidates;

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Aucun candidat sélectionné pour le vote.']);
}
?>
