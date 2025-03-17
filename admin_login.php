<?php
session_start();
$pageTitle = "Admin Login";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Validate credentials (replace with your actual credentials)
    $username = "admin";
    $password = "password";

    if ($_POST['username'] == $username && $_POST['password'] == $password) {
        $_SESSION['admin'] = true; // Set session if credentials are valid
        header("Location: answer_questions.php"); // Redirect to the main admin page
        exit();
    } else {
        $login_error = "Invalid username or password";
    }
}

include 'includes/header.php'; // Include the standard header
?>

<main class="content">
    <h1 class="hero-title">Admin Login</h1>
    <section class="qa-section">
        <?php if (isset($login_error)): ?>
            <p style="color: red;"><?php echo $login_error; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit" class="button button-primary">Login</button>
        </form>
    </section>
</main>

<?php
include 'includes/footer.php'; // Include the standard footer
?>
