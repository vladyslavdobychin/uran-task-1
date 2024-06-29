<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
<h1><?php echo htmlspecialchars($title); ?></h1>
<p><?php echo htmlspecialchars($description); ?></p>
<h2>Pages:</h2>
<ul>
    <?php foreach ($pages as $page): ?>
        <li><a href="/<?php echo htmlspecialchars($page['friendly']); ?>"><?php echo htmlspecialchars($page['title']); ?></a></li>
    <?php endforeach; ?>
</ul>
</body>
</html>
