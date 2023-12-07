<?php

global $conn;
require_once __DIR__ . '/../../config/DbConnection.php';

function fetchGenres($conn): array {
    $query = "SELECT id, name FROM genre";
    $result = $conn->query($query);
    $genres = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $genres[] = $row;
        }
    }
    return $genres;
}

function fetchFilms($conn): array {
    $query = "SELECT f.id, f.title, f.duration, f.releasedate, g.name AS genre_name, g.id AS genre_id
            FROM film f
            JOIN genre g ON f.genre_id = g.id;";
    $result = $conn->query($query);
    $films = [];

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $films[] = $row;
        }
    }
    return $films;
}

function addFilm($conn, $title, $duration, $releaseDate, $genreId): bool {
    $query = "INSERT INTO film (title, duration, releasedate, genre_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sisi", $title, $duration, $releaseDate, $genreId);
    return $stmt->execute();
}

function updateFilm($conn, $filmId, $title, $duration, $releaseDate, $genreId): bool {
    $query = "UPDATE film SET title = ?, duration = ?, releasedate = ?, genre_id = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sisii", $title, $duration, $releaseDate, $genreId, $filmId);
    return $stmt->execute();
}

function deleteFilm($conn, $filmId): bool {
    $query = "DELETE FROM film WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $filmId);
    return $stmt->execute();
}

// Form Submission Handling
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['addfilm'])) {
        addFilm($conn, $_POST['title'], $_POST['duration'], $_POST['releaseDate'], $_POST['genreId']);
    } elseif (isset($_POST['updateFilm'])) {
        updateFilm($conn, $_POST['filmId'], $_POST['title'], $_POST['duration'], $_POST['releaseDate'], $_POST['genreId']);
    } elseif (isset($_POST['deleteFilm'])) {
        deleteFilm($conn, $_POST['filmId']);
    }

    // Redirect to refresh data
    header("Location: filmsView.php");
    exit;
}
