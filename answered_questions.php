<?php
session_start();
$pageTitle = "Answered Questions";
include 'includes/header.php';

// Function to read questions from file
function getQuestions() {
    $questions = [];
    if (file_exists('questions.txt')) {
        $file = fopen('questions.txt', 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $data = explode('||', $line);
                if (count($data) == 3) {
                    $questions[] = [
                        'id' => trim($data[0]),
                        'question' => trim($data[1]),
                        'answer' => trim($data[2])
                    ];
                }
            }
            fclose($file);
        } else {
            error_log("Failed to open questions.txt");
            return []; // Return empty array on error
        }
    } else {
        error_log("questions.txt does not exist");
    }
    return $questions;
}

// Load questions
$questions = getQuestions();

// Get the selected video from the query string (or default to video1.mp4)
$selectedVideo = isset($_GET['video']) && ($_GET['video'] === '2') ? 'video2' : 'video1';
$videoPath = "videos/" . $selectedVideo . ".mp4";

// Check if video files exist, display default if not found
$videoWebmPath = "videos/" . $selectedVideo . ".webm";
$videoOggPath = "videos/" . $selectedVideo . ".ogg";

if (!file_exists($videoPath)) {
    $videoPath = "videos/video1.mp4"; // Default to video1.mp4 if selected video not found
    $selectedVideo = "video1";
}

if (!file_exists($videoWebmPath)){
        $videoWebmPath = "videos/video1.webm";
}

if (!file_exists($videoOggPath)){
        $videoOggPath = "videos/video1.ogg";
}

?>

<main class="content">
    <h1 class="hero-title">Answered Questions</h1>
    <section class="qa-section">
        <h2>List of Answered Questions</h2>
        <?php if (empty($questions)): ?>
            <p>No questions have been submitted yet.</p>
        <?php else: ?>
            <ul class="question-list">
                <?php foreach ($questions as $question): ?>
                    <?php if (!empty($question['answer'])): ?>
                        <li class="question-item">
                            <p><strong>Question:</strong> <?php echo htmlspecialchars($question['question'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p><strong>Answer:</strong> <?php echo htmlspecialchars($question['answer'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>

    <div style="margin-bottom: 20px;">
        <a href="?video=1">Video 1</a> | <a href="?video=2">Video 2</a>
    </div>

</main>

<?php include 'includes/footer.php'; ?>

<div class="fixed-video-container">
    <video width="100%" height="100%" controls>
        <source src="<?php echo htmlspecialchars($videoPath); ?>" type="video/mp4">
        <source src="<?php echo htmlspecialchars($videoWebmPath); ?>" type="video/webm">
        <source src="<?php echo htmlspecialchars($videoOggPath); ?>" type="video/ogg">
        Your browser does not support the video tag.
    </video>
</div>