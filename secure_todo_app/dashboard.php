<?php
session_start();
include('config.php');


if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}


$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create_task'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $due_date = mysqli_real_escape_string($conn, $_POST['due_date']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Insert task for the current user
        $query = "INSERT INTO tasks (user_id, title, description, category, due_date, status) VALUES ('$user_id', '$title', '$description', '$category', '$due_date', '$status')";
        mysqli_query($conn, $query);
    } elseif (isset($_POST['delete_task'])) {
        $task_id = mysqli_real_escape_string($conn, $_POST['task_id']);
        // Delete task only if it belongs to the current user
        $query = "DELETE FROM tasks WHERE id='$task_id' AND user_id='$user_id'";
        mysqli_query($conn, $query);
    }
}


$query = "SELECT * FROM tasks WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js"></script>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <a href="logout.php">Logout</a>
        
        <h3>Your Tasks</h3>
        <form method="post" action="">
            <input type="text" name="title" placeholder="Task Title" required>
            <textarea name="description" placeholder="Description"></textarea>
            <select name="category" required>
                <option value="Work">Work</option>
                <option value="Personal">Personal</option>
            </select>
            <input type="date" name="due_date" required>
            <select name="status">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
            <button type="submit" name="create_task">Add Task</button>
        </form>

        <h3>Task List</h3>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while ($task = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['title']); ?></td>
                    <td><?php echo htmlspecialchars($task['description']); ?></td>
                    <td><?php echo htmlspecialchars($task['category']); ?></td>
                    <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                    <td><?php echo htmlspecialchars($task['status']); ?></td>
                    <td>
                        <form method="post" action="">
                            <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                            <button type="submit" name="delete_task">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
