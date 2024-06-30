<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Page</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
<div class="page-content">
    <div class="container">
        <h1>Create New Page</h1>
        <form action="/createPage" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="friendly">Friendly URL:</label>
            <input type="text" id="friendly" name="friendly" required>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
            <div class="form-buttons">
                <button type="submit">Create Page</button>
                <button type="button" class="back-button" onclick="window.location.href='/home'">Back</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
