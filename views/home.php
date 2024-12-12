<!DOCTYPE html>
<html>

<head>
    <title>Film Finder</title>
    <!-- Include CSS and JS files -->
</head>

<body>
    <h1>Film Finder</h1>
    <ul>
        <?php foreach ($films as $film): ?>
            <li>
                <h2><?php echo $film->title_film; ?></h2>
                <p><?php echo $film->synopsis; ?></p>
                <p>Genre: <?php echo $film->genre; ?></p>
                <p>Release Year: <?php echo $film->release_year; ?></p>
                <p>Director: <?php echo $film->director; ?></p>
                <p>Duration: <?php echo $film->duration; ?> hours</p>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>