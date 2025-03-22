<?php
require_once 'models/Database.php';
require_once 'models/User.php';
require_once 'models/Candidate.php';
require 'fpdf/fpdf.php';

session_start();
$userId = $_SESSION['user_id'];

$user = new User();
$userData = $user->getUserById($userId);

$candidate = new Candidate();
$candidates = $candidate->getAllCandidates();

$votedCandidateIds = isset($_SESSION['voted_candidates']) ? $_SESSION['voted_candidates'] : [];

// Récupérer les informations des candidats votés par l'utilisateur
$votedCandidates = array_filter($candidates, function($candidate) use ($votedCandidateIds) {
    return in_array($candidate['id'], $votedCandidateIds);
});

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(0, 10, 'Vote du Lundi 20 Mai 2024', 0, 1, 'C');
        $this->Cell(0, 10, utf8_decode('École Nationale des Sciences Appliquées de Marrakech'), 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
    }

    function ChapterTitle($title) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 220, 255);
        $this->Cell(0, 10, utf8_decode($title), 0, 1, 'L', true);
        $this->Ln(4);
    }

    function CandidateTable($header, $data) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 220, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->Cell(0, 10, utf8_decode('Liste des candidats'), 0, 1, 'C', true);
        $this->Ln(4);

        // Header
        $w = array(140, 40); // Largeurs des colonnes
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();

        // Données
        $this->SetFont('Arial', '', 12);
        foreach($data as $row) {
            $this->Cell($w[0],6,utf8_decode($row['name']),'LR');
            $this->Cell($w[1],6,utf8_decode($row['votes']),'LR');
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }

    function VotedCandidatesTable($header, $data) {
        $this->SetFont('Arial', 'B', 12);
        $this->SetFillColor(200, 220, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->Cell(0, 10, utf8_decode('Récapitulatif des Candidats Votés'), 0, 1, 'C', true);
        $this->Ln(4);

        // Header
        $w = array(180); // Largeurs des colonnes
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,utf8_decode($header[$i]),1,0,'C',true);
        $this->Ln();

        // Données
        $this->SetFont('Arial', '', 12);
        foreach($data as $row) {
            $this->Cell($w[0],6,utf8_decode($row['name']),'LR');
            $this->Ln();
        }
        $this->Cell(array_sum($w),0,'','T');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->ChapterTitle('Liste des candidats');

// Données pour la table des candidats
$candidateHeader = array('Nom', 'Votes');
$pdf->CandidateTable($candidateHeader, $candidates);
$pdf->Ln(10);

// Données pour la table des candidats votés
$votedCandidatesHeader = array('Nom');
$pdf->VotedCandidatesTable($votedCandidatesHeader, $votedCandidates);
$pdf->Ln(10);

$pdf->Cell(0, 10, utf8_decode('Fait à Marrakech le 20/05/2024'), 0, 1);
$pdf->Cell(0, 10, utf8_decode('Vote réalisé par : ') . utf8_decode($userData['username']), 0, 1);

$pdf->Output('D', 'vote_recapitulatif_'.$userData['username'].'.pdf');
?>
