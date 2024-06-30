<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
<div class="page-content">
    <div class="container">
        <h1>Update Page</h1>
        <form action="/updatePage" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($page['id']); ?>">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" required>
            <label for="friendly">Friendly URL:</label>
            <input type="text" id="friendly" name="friendly" value="<?php echo htmlspecialchars($page['friendly']); ?>" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($page['description']); ?></textarea>
            <div class="form-buttons">
                <button type="submit">Update Page</button>
                <button type="button" class="back-button" onclick="window.location.href='/home'">Back</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
