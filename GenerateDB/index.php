
<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
    $mysqli = new mysqli("localhost", "root", "");

    $query = "CREATE DATABASE IF NOT EXISTS Filmfinder";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Database 'Filmfinder' berhasil dibuat / sudah tersedia <br>";
    }

    $mysqli->select_db("Filmfinder");
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Database 'Filmfinder' berhasil dipilih <br>";
    }

    $query = "DROP TABLE IF EXISTS users";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    }

    $query = "CREATE TABLE users (
        id_users INT PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR (50) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'users' berhasil dibuat <br>";
    }

    $query = "DROP TABLE IF EXISTS admin";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    }

    $query = "CREATE TABLE admin (
        id_admin INT PRIMARY KEY AUTO_INCREMENT,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'admin' berhasil dibuat <br>";
    }

    $query = "DROP TABLE IF EXISTS film";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    }

    $query = "CREATE TABLE film (
        id_film INT PRIMARY KEY AUTO_INCREMENT,
        title_film VARCHAR(100) NOT NULL,
        synopsis VARCHAR(1000) NOT NULL, 
        genre VARCHAR(100) NOT NULL,
        release_year INT(4) NOT NULL,
        director VARCHAR(100) NOT NULL,
        duration FLOAT(3) NOT NULL
    )";

    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'film' berhasil dibuat <br>";
    }

    $query = "INSERT INTO users (password, email) VALUES
        ('password123', 'user1@example.com'),
        ('password456', 'user2@example.com'),
        ('password789', 'user3@example.com')";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'users' berhasil diisi " . $mysqli->affected_rows . " baris data <br>";
    }

    $query = "INSERT INTO admin (password, email) VALUES
        ('adminpass', 'admin1@example.com'),
        ('adminpass2', 'admin2@example.com')";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'admin' berhasil diisi " . $mysqli->affected_rows . " baris data <br>";
    }

    // Insert dummy data into 'film' table
    $query = "INSERT INTO film (title_film, synopsis, genre, release_year, director, duration) VALUES
        ('Inception', 'Seorang pencuri yang mencuri rahasia perusahaan melalui penggunaan teknologi berbagi mimpi.', 'Sci-Fi', 2010, 'Christopher Nolan', 2.8),
        ('The Matrix', 'Seorang hacker menemukan kenyataan bahwa hidupnya adalah simulasi dan berjuang melawan pengendalinya.', 'Sci-Fi', 1999, 'The Wachowskis', 2.3),
        ('Interstellar', 'Sebuah tim penjelajah melakukan perjalanan melalui lubang cacing di ruang angkasa dalam upaya untuk memastikan kelangsungan hidup umat manusia.', 'Sci-Fi', 2014, 'Christopher Nolan', 2.9)";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'film' berhasil diisi " . $mysqli->affected_rows . " baris data <br>";
    }


    $query = "DROP TABLE IF EXISTS watchlist";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    }

    $query = "CREATE TABLE watchlist (
    id_watchlist INT PRIMARY KEY AUTO_INCREMENT,
    id_users INT NOT NULL,
    id_film INT NOT NULL,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_film) REFERENCES film(id_film)
)";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'watchlist' berhasil dibuat <br>";
    }

    $query = "DROP TABLE IF EXISTS reviewRating";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    }

    $query = "CREATE TABLE reviewRating (
    id_review INT PRIMARY KEY AUTO_INCREMENT,
    id_users INT NOT NULL,
    id_film INT NOT NULL,
    review TEXT,
    rating DECIMAL(2,1),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_users) REFERENCES users(id_users),
    FOREIGN KEY (id_film) REFERENCES film(id_film)
)";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'reviewRating' berhasil dibuat <br>";
    }

    $query = "INSERT INTO reviewRating (id_film, id_users, review, rating) VALUES
    (1, 1, 'Film yang menakjubkan dengan alur cerita kompleks.', 9.0),
    (2, 2, 'Film revolusioner yang mengubah genre sci-fi.', 8.5),
    (3, 3, 'Visual yang menakjubkan dan cerita yang menarik.', 9.0)";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'reviewRating' berhasil diisi " . $mysqli->affected_rows . " baris data <br>";
    }

    $query = "INSERT INTO watchlist (id_users, id_film) VALUES
    (1, 2),
    (1, 3),
    (2, 1),
    (3, 1),
    (3, 2)";
    $mysqli->query($query);
    if ($mysqli->error) {
        throw new Exception($mysqli->error, $mysqli->errno);
    } else {
        echo "Tabel 'watchlist' berhasil diisi " . $mysqli->affected_rows . " baris data <br>";
    }
} finally {
    if (isset($mysqli)) {
        $mysqli->close();
    }
}
