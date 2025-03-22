<?php
require_once 'models/Candidate.php';

class CandidateController {
    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';

        switch ($action) {
            case 'list':
                $this->listCandidates();
                break;
            default:
                $this->listCandidates();
        }
    }

    private function listCandidates() {
        $candidate = new Candidate();
        $candidates = $candidate->getAllCandidates();
        include 'views/candidates.php';
    }
}
?>
