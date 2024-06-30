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
        <div class="form-buttons">
            <button class="back-button" onclick="window.location.href='/home'">Back</button>
            <button class="update-button" onclick="window.location.href='/updatePageForm?id=<?php echo $page['id']; ?>'">Update</button>
            <button class="delete-button" onclick="window.location.href='/deletePage?id=<?php echo $page['id']; ?>'">Delete</button>
        </div>
    </div>
</div>
</body>
</html>
