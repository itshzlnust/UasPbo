<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <!-- Include CSS and JS files -->
</head>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Manage Films</h2>
    <ul>
        <?php foreach ($films as $film): ?>
            <li>
                <h2><?php echo $film->title_film; ?></h2>
                <p><?php echo $film->synopsis; ?></p>
                <p>Genre: <?php echo $film->genre; ?></p>
                <p>Release Year: <?php echo $film->release_year; ?></p>
                <p>Director: <?php echo $film->director; ?></p>
                <p>Duration: <?php echo $film->duration; ?> hours</p>
                <a href="edit_film.php?id=<?php echo $film->id_film; ?>">Edit</a>
                <a href="delete_film.php?id=<?php echo $film->id_film; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <h2>Manage Users</h2>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <h2><?php echo $user->username; ?></h2>
                <p>Email: <?php echo $user->email; ?></p>
                <a href="edit_user.php?id=<?php echo $user->id_users; ?>">Edit</a>
                <a href="delete_user.php?id=<?php echo $user->id_users; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>