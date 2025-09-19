<?php
// ===================================================================================
//
// SIMPLE BLOG SYSTEM - A single file application for beginners.
// This file handles creating, reading, updating, and deleting blog posts.
//
// ===================================================================================

// --- 1. INCLUDE DATABASE CONNECTION ---
// We need this to talk to our database. 'require' means the script will stop if it can't find the file.
require 'db_connect.php';

// --- 2. HANDLE ACTIONS (Create, Update, Delete) ---

// ACTION: CREATE A NEW POST
// Check if the form was submitted using the 'save' button from a POST request.
if (isset($_POST['save'])) {
    // Get data from the form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];

    // Prepare the SQL query to prevent SQL injection attacks.
    $stmt = $pdo->prepare("INSERT INTO articles (title, content, tags) VALUES (?, ?, ?)");
    // Execute the query by passing the form data as an array.
    $stmt->execute([$title, $content, $tags]);

    // Redirect back to the main page to clear the form and prevent resubmission on refresh.
    header("Location: index.php");
    exit();
}

// ACTION: DELETE A POST
// Check if the URL contains 'action=delete' and an 'id' from a GET request.
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Prepare and execute the delete query.
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);

    // Redirect to the main page.
    header("Location: index.php");
    exit();
}

// ACTION: UPDATE AN EXISTING POST
// Check if the form was submitted using the 'update' button from a POST request.
if (isset($_POST['update'])) {
    // Get data from the form, including the hidden 'id' field.
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $tags = $_POST['tags'];

    // Prepare and execute the update query.
    $stmt = $pdo->prepare("UPDATE articles SET title = ?, content = ?, tags = ? WHERE id = ?");
    $stmt->execute([$title, $content, $tags, $id]);

    // Redirect to the main page.
    header("Location: index.php");
    exit();
}

// --- 3. PREPARE FOR EDITING (if requested) ---
// This part runs BEFORE the HTML is displayed to get the data needed for the form.
$edit_post = null; // Default to null (meaning we are NOT in edit mode).
// Check if the URL contains 'action=edit' and an 'id'.
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch the specific article from the database to edit.
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    // Store the article's data in the $edit_post variable. The form will use this later.
    $edit_post = $stmt->fetch();
}

// --- 4. FETCH ALL ARTICLES TO DISPLAY ---
// This query gets all articles from the database, with the newest ones appearing first.
$stmt = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');

?>
<!-- =================================================================================== -->
<!--
     HTML PART OF THE PAGE
     This section displays the content. PHP is used inside the HTML to show dynamic data
     from the database.
-->
<!-- =================================================================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Simple Blog</title>
    <!-- Link to the external CSS file for styling. -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h1>My Blog</h1>
        <p>A simple blog system built with PHP and MySQL.</p>
        <hr>

        <!-- The form for creating and editing posts. The action attribute points to this same file. -->
        <h2><?php echo $edit_post ? 'Edit Post' : 'Create a New Post'; ?></h2>
        <form action="index.php" method="post">
            
            <!-- This hidden input stores the post ID. It's empty when creating, but has a value when editing. -->
            <input type="hidden" name="id" value="<?php echo $edit_post['id'] ?? ''; ?>">

            <div>
                <label>Title:</label>
                <!-- Pre-fill the value if we are editing. The '??' operator prevents errors if $edit_post is null. -->
                <!-- htmlspecialchars() is a security measure to prevent cross-site scripting (XSS) attacks. -->
                <input type="text" name="title" value="<?php echo htmlspecialchars($edit_post['title'] ?? ''); ?>" required>
            </div>

            <div>
                <label>Content:</label>
                <textarea name="content" rows="6" required><?php echo htmlspecialchars($edit_post['content'] ?? ''); ?></textarea>
            </div>

            <div>
                <label>Tags (comma separated, e.g., php, learning, fun):</label>
                <input type="text" name="tags" value="<?php echo htmlspecialchars($edit_post['tags'] ?? ''); ?>">
            </div>

            <!-- Show "Update Post" button if editing, otherwise show "Save Post" button. -->
            <?php if ($edit_post): ?>
                <button type="submit" name="update">Update Post</button>
            <?php else: ?>
                <button type="submit" name="save">Save Post</button>
            <?php endif; ?>
        </form>

        <hr>

        <!-- The list of all your blog posts will be displayed here. -->
        <h2>Recent Posts</h2>
        <?php while ($row = $stmt->fetch()): ?>
            <div class="post">
                <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                <p><?php echo htmlspecialchars($row['content']); ?></p>
                <div class="post-meta">
                    <strong>Tags:</strong> <?php echo htmlspecialchars($row['tags']); ?><br>
                    <strong>Posted on:</strong> <?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?><br>
                    <!-- Links to edit and delete. The JS confirm() asks for confirmation before deleting. -->
                    <a href="index.php?action=edit&id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="index.php?action=delete&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- Message to show if there are no posts in the database yet. -->
        <?php if ($stmt->rowCount() === 0): ?>
            <p>No posts yet. Use the form above to create one!</p>
        <?php endif; ?>

    </div>

</body>
</html>

