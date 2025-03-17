<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}
$pageTitle = "Answer Questions";
include 'includes/header.php';

function getQuestions() {
    $questions = [];
    if (file_exists('questions.txt')) {
        $file = fopen('questions.txt', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = explode('||', $line);
                if (count($data) >= 2) {
                    $questions[] = [
                        'id' => trim($data[0]),
                        'question' => trim($data[1]),
                        'answer' => isset($data[2]) ? trim($data[2]) : ''
                    ];
                }
            }
            fclose($file);
        }
    }
    return $questions;
}

$questions = getQuestions();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['answer_id'])) {
    $answer_id = $_POST['answer_id'];
    $answer = trim($_POST['answer']);

    $updated_questions = [];
    foreach ($questions as $question) {
        if ($question['id'] === $answer_id) {
            $question['answer'] = $answer;
        }
        $updated_questions[] = $question['id'] . '||' . $question['question'] . '||' . $question['answer'] . PHP_EOL;
    }

    file_put_contents('questions.txt', implode('', $updated_questions), LOCK_EX);
    header("Location: answer_questions.php");
    exit();
}
?>

<main class="content">
    <h1 class="hero-title">Answer User Questions</h1>
    <section class="qa-section">
        <h2>Questions to Answer</h2>
        <ul class="question-list">
            <?php foreach ($questions as $question): ?>
                <li class="question-item">
                    <p><strong>Question:</strong> <?php echo htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php if (empty($question['answer'])): ?>
                        <form method="POST">
                            <input type="hidden" name="answer_id" value="<?php echo $question['id']; ?>">
                            <textarea name="answer" placeholder="Type your answer here..." required></textarea>
                            <button type="submit" class="button button-primary">Submit Answer</button>
                        </form>
                    <?php else: ?>
                        <p><strong>Answer:</strong> <?php echo htmlspecialchars($question['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>

<?php include 'includes/footer.php'; ?>