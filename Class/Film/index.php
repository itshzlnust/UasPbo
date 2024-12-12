<?php

class Film
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addFilm($title, $synopsis, $director, $duration)
    {
        $sql = "INSERT INTO film (title_film, synopsis, director, duration) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $synopsis, $director, $duration);
        return $stmt->execute();
    }

    public function updateFilm($id, $title, $synopsis, $director, $duration)
    {
        $sql = "UPDATE film SET title_film = ?, synopsis = ?, director = ?, duration = ? WHERE id_film = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssi", $title, $synopsis, $director, $duration, $id);
        return $stmt->execute();
    }

    public function readTables($id)
    {
        $sql = "SELECT * FROM film WHERE id_film = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function deleteFilm($id)
    {
        $sql = "DELETE FROM film WHERE id_film = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}


// Database connection
$mysqli = new mysqli("localhost", "username", "password", "database");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Create Film object
$film = new Film($mysqli);

// Add a new film
if ($film->addFilm("Inception", "A thief who steals corporate secrets through the use of dream-sharing technology.",  "Christopher Nolan", 148)) {
    echo "Film added successfully.";
} else {
    echo "Failed to add film.";
}

// Update an existing film
if ($film->updateFilm(1, "Inception", "A thief who steals corporate secrets through the use of dream-sharing technology.", "Christopher Nolan", 148)) {
    echo "Film updated successfully.";
} else {
    echo "Failed to update film.";
}

// Read a film's details
$result = $film->readTables(1);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id_film"] . " - Title: " . $row["title_film"] . " - Synopsis: " . $row["synopsis"] . $row["release_year"] . " - Director: " . $row["director"] . " - Duration: " . $row["duration"] . "<br>";
    }
} else {
    echo "No film found.";
}

// Delete a film
if ($film->deleteFilm(1)) {
    echo "Film deleted successfully.";
} else {
    echo "Failed to delete film.";
}

// Close connection
$mysqli->close();
