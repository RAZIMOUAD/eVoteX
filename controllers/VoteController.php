<?php
require_once 'models/Vote.php';
require_once 'models/Candidate.php';

class VoteController {
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->castVote();
        }
    }

    private function castVote() {
        session_start();
        $userId = $_SESSION['user_id'];

        if (!isset($_POST['vote']) || count($_POST['vote']) > 3) {
            echo json_encode(['status' => 'error', 'message' => 'Vous ne pouvez voter que pour un maximum de trois candidats.']);
            return;
        }

        $vote = new Vote();
        foreach ($_POST['vote'] as $candidateId) {
            $vote->castVote($userId, $candidateId);
        }

        echo json_encode(['status' => 'success']);
    }
}
?>
