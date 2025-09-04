
<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}
include 'config.php';
$db = (new Database())->getConnection();
$project = new Project($db);

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $db->prepare("DELETE FROM projects WHERE id=?");
    $stmt->execute([$id]);
    header('Location: admin_dashboard.php');
    exit;
}

// Handle add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $stmt = $db->prepare("INSERT INTO projects (title, description, image_url, demo_url, github_url, technologies, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['title'], $_POST['description'], $_POST['image_url'],
        $_POST['demo_url'], $_POST['github_url'], $_POST['technologies'], $_POST['status']
    ]);
    header('Location: admin_dashboard.php');
    exit;
}

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $stmt = $db->prepare("UPDATE projects SET title=?, description=?, image_url=?, demo_url=?, github_url=?, technologies=?, status=? WHERE id=?");
    $stmt->execute([
        $_POST['title'], $_POST['description'], $_POST['image_url'],
        $_POST['demo_url'], $_POST['github_url'], $_POST['technologies'], $_POST['status'], $_POST['id']
    ]);
    header('Location: admin_dashboard.php');
    exit;
}

// Fetch projects
$stmt = $project->getAllProjects();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <a href="logout.php">Logout</a>
    <h3>Add New Project</h3>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="text" name="image_url" placeholder="Image URL" required>
        <input type="text" name="demo_url" placeholder="Demo URL">
        <input type="text" name="github_url" placeholder="GitHub URL">
        <input type="text" name="technologies" placeholder="Technologies (comma separated)">
        <select name="status">
            <option value="completed">Completed</option>
            <option value="in-progress">In Progress</option>
            <option value="planned">Planned</option>
        </select>
        <button type="submit" name="add">Add Project</button>
    </form>
    <h3>Existing Projects</h3>
    <table border="1" cellpadding="5">
        <tr>
            <th>Title</th><th>Description</th><th>Status</th><th>Actions</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
        <tr>
            <form method="post">
                <td><input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>"></td>
                <td><input type="text" name="description" value="<?php echo htmlspecialchars($row['description']); ?>"></td>
                <td>
                    <select name="status">
                        <option value="completed" <?php if($row['status']=='completed') echo 'selected'; ?>>Completed</option>
                        <option value="in-progress" <?php if($row['status']=='in-progress') echo 'selected'; ?>>In Progress</option>
                        <option value="planned" <?php if($row['status']=='planned') echo 'selected'; ?>>Planned</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="image_url" value="<?php echo htmlspecialchars($row['image_url']); ?>" placeholder="Image URL">
                    <input type="text" name="demo_url" value="<?php echo htmlspecialchars($row['demo_url']); ?>" placeholder="Demo URL">
                    <input type="text" name="github_url" value="<?php echo htmlspecialchars($row['github_url']); ?>" placeholder="GitHub URL">
                    <input type="text" name="technologies" value="<?php echo htmlspecialchars($row['technologies']); ?>" placeholder="Technologies">
                    <button type="submit" name="update">Update</button>
                    <a href="admin_dashboard.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this project?');">Delete</a>
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>