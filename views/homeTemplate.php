<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
<div class="page-content">
    <div class="container">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <p><?php echo htmlspecialchars($description); ?></p>
        <h2>Pages:</h2>
        <ul>
            <?php foreach ($pages as $page): ?>
                <li><a href="/<?php echo htmlspecialchars($page['friendly']); ?>"><?php echo htmlspecialchars($page['title']); ?></a></li>
            <?php endforeach; ?>
        </ul>
        <button onclick="window.location.href='/createPageForm'">Create New Page</button>
    </div>
</div>
</body>
</html>
