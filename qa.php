<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STI Q&A | Get Answers</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <aside class="vertical-nav">
            <a href="index.php" class="nav-heading">Home</a>
            <a href="info.php" class="nav-heading">STI Information</a>
            <a href="testing.php" class="nav-heading">Testing & Treatment</a>
            <a href="prevention.php" class="nav-heading">Prevention</a>
            <a href="resources.php" class="nav-heading">Local Resources</a>
            <a href="qa.php" class="nav-heading">Submit a Question</a>
        </aside>
        <main class="content">
            <h1 class="hero-title">STI Questions & Answers</h1>

            <section class="qa-section">
                <h2>Ask Your Question</h2>
                <form id="questionForm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                    <textarea id="questionInput" name="question" placeholder="Ask your question about STIs..." required></textarea>
                    <button type="submit" id="submitQuestion">Submit Question</button>
                </form>
                <div id="questionConfirmation" style="display: none;">
                    Thank you! Your question has been submitted.
                </div>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $question = isset($_POST['question']) ? trim($_POST['question']) : '';
                    if (!empty($question)) {
                        $id = uniqid();
                        $questionData = $id . '||' . htmlspecialchars($question, ENT_QUOTES, 'UTF-8') . '||' . PHP_EOL;
                        file_put_contents('questions.txt', $questionData, FILE_APPEND | LOCK_EX);
                        echo "<script>document.getElementById('questionConfirmation').style.display = 'block'; setTimeout(() => { document.getElementById('questionConfirmation').style.display = 'none'; }, 3000); document.getElementById('questionInput').value = '';</script>";
                    } else {
                        echo "<p style='color:red;'>Please enter a question.</p>";
                    }
                }
                ?>
            </section>

            <section class="qa-section" id="faqContainer">
                <h2>Frequently Asked Questions</h2>
                <ul class="question-list">
                    <li class="question-item">
                        <p><strong>Question:</strong> How can I protect myself from STIs?</p>
                        <p><strong>Answer:</strong> Use condoms consistently and correctly, get tested regularly, and limit your number of sexual partners.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> What are the common symptoms of STIs?</p>
                        <p><strong>Answer:</strong> Symptoms vary but can include unusual discharge, sores, pain during urination, or no symptoms at all.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> Where can I get tested for STIs?</p>
                        <p><strong>Answer:</strong> You can get tested at your local health clinic, Planned Parenthood, or a community health center.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> Are STIs curable?</p>
                        <p><strong>Answer:</strong> Some STIs like chlamydia and gonorrhea are curable with antibiotics, while others like herpes and HIV are manageable but not curable.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> How often should I get tested for STIs?</p>
                        <p><strong>Answer:</strong> If you're sexually active, it's recommended to get tested at least once a year, or more frequently if you have multiple partners.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> Is my question submitted anonymously?</p>
                        <p><strong>Answer:</strong> Yes, all questions are submitted anonymously. We do not collect any personal information.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> How long does it take to get an answer to my question?</p>
                        <p><strong>Answer:</strong> We aim to answer all questions as quickly as possible. Please allow up to 48 hours for a response. Check the answered questions page.</p>
                    </li>
                    <li class="question-item">
                        <p><strong>Question:</strong> How are the questions on this website answered?</p>
                        <p><strong>Answer:</strong> Questions are reviewed and answered by healthcare professionals to ensure accuracy and reliability.</p>
                    </li>
                </ul>
            </section>
        </main>
    </div>
    <footer>

    </footer>
    <script>
        // ... (your existing JavaScript code)
    </script>
</body>

</html>