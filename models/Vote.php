<?php
require_once 'Database.php';

class Vote {
    private $conn;
    private $table_name = "votes";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function castVote($userId, $candidateId) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, candidate_id) VALUES (:user_id, :candidate_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->bindParam(":candidate_id", $candidateId);
        return $stmt->execute();
    }

    public function hasVoted($userId) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $userId);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getResults() {
        $query = "SELECT candidate_id, COUNT(*) as vote_count FROM " . $this->table_name . " GROUP BY candidate_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
