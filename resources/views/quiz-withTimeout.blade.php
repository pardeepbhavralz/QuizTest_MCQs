<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Competition</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.12/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f1f5f9;
            min-height: 100vh;
            display: flex;
            line-height: 1.6;
            color: #1e293b;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background-color: #1e293b;
            color: #ffffff;
            padding: 24px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sidebar .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sidebar .nav-links a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e2e8f0;
            text-decoration: none;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.2s, color 0.2s;
        }

        .sidebar .nav-links a:hover, .sidebar .nav-links a.active {
            background-color: #3b82f6;
            color: #ffffff;
        }

        .sidebar .nav-links a i {
            font-size: 1.25rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 40px;
            flex-grow: 1;
            background-color: #f1f5f9;
            min-height: 100vh;
            transition: margin-left 0.3s ease-in-out;
        }

        .main-header {
            background-color: #ffffff;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            color: #1e293b;
        }

        .main-header .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1rem;
            color: #64748b;
        }

        /* Progress Bar */
        .progress-container {
            margin-bottom: 24px;
            background-color: #e5e7eb;
            border-radius: 12px;
            height: 8px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #3b82f6;
            width: 0;
            transition: width 0.3s ease;
        }

        /* Quiz Form Styling */
        .exam-form {
            max-width: 900px;
            margin: 0 auto;
        }

        .question-block {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 32px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: none;
            transition: all 0.3s ease;
        }

        .question-block.active {
            display: block;
        }

        .question-block p {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 24px;
        }

        /* Circular Timer */
        .timer {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: 600;
            color: #dc2626;
        }

        .timer svg {
            position: absolute;
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .timer circle {
            fill: none;
            stroke: #fef2f2;
            stroke-width: 8;
            cx: 40;
            cy: 40;
            r: 36;
        }

        .timer .progress {
            stroke: #dc2626;
            stroke-width: 8;
            stroke-linecap: round;
            transition: stroke-dashoffset 1s linear;
        }

        /* Custom Radio Buttons */
        .question-block label {
            display: flex;
            align-items: center;
            padding: 16px;
            margin-bottom: 12px;
            background-color: #f9fafb;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1.1rem;
        }

        .question-block label:hover {
            border-color: #3b82f6;
            background-color: #f1f5f9;
        }

        .question-block input[type="radio"] {
            margin-right: 16px;
            width: 20px;
            height: 20px;
            accent-color: #3b82f6;
        }

        .question-block input[type="radio"]:checked + span {
            font-weight: 600;
            color: #3b82f6;
        }

        /* Buttons */
        .next-question, #backButton, #backButtonExit {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            display: inline-block;
            margin-top: 16px;
        }

        #backButtonExit {
            background-color: #dc2626;
            margin-bottom: 24px;
        }

        .next-question:hover, #backButton:hover {
            background-color: #2563eb;
        }

        #backButtonExit:hover {
            background-color: #b91c1c;
        }

        /* Result Section */
        #result {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: none;
        }

        #result .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 24px;
            gap: 24px;
        }

        #result .summary div {
            flex: 1;
            padding: 16px;
            background-color: #f9fafb;
            border-radius: 8px;
            text-align: center;
        }

        #result .summary div h3 {
            font-size: 1.25rem;
            color: #1e293b;
            margin-bottom: 8px;
        }

        #result .summary div p {
            font-size: 2rem;
            font-weight: 700;
            color: #3b82f6;
        }

        .correct-answer, .wrong-answer, .skipped-answer {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 12px;
            font-size: 1.1rem;
        }

        .correct-answer {
            background-color: #f0fdf4;
            color: #15803d;
        }

        .wrong-answer {
            background-color: #fef2f2;
            color: #b91c1c;
        }

        .skipped-answer {
            background-color: #fefce8;
            color: #ca8a04;
        }

        /* Toggle Sidebar Button */
        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 1001;
            background-color: #1e293b;
            color: #ffffff;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 1.25rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-280px);
                width: 240px;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px;
            }

            .main-content.sidebar-active {
                margin-left: 240px;
            }

            .toggle-sidebar {
                display: block;
            }

            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .question-block {
                padding: 24px;
            }

            #result .summary {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <button class="toggle-sidebar" aria-label="Toggle Sidebar"><i class="fas fa-bars"></i></button>
    <aside class="sidebar">
        <h2><i class="fas fa-graduation-cap"></i> Quiz Dashboard</h2>
        <nav>
            <ul class="nav-links">
                <li><a href=""><i class="fas fa-home"></i> Home</a></li>
                <li><a href="{{ route('quiz-withTimeout') }}"><i class="fas fa-question-circle"></i> Quiz with Mix-Technology</a></li>
                <li><a href="{{ route('listOfAllUser_user') }}"><i class="fas fa-trophy"></i> Leaderboard</a></li>
                @if(Session::get('email'))
                    <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                @endif
            </ul>
        </nav>
    </aside>

    <div class="main-content">
        @if (Session('email'))
            <input type="hidden" name="hiddenEmail" id="hiddenEmail" value="{{ Session('email') }}">
        @endif
        <header class="main-header">
            <h1>Quiz Competition</h1>
            <div class="user-info">
                <i class="fas fa-user"></i>
                <span>{{ Session('email') ?? 'Guest' }}</span>
            </div>
        </header>
        <button id="backButtonExit">Exit Quiz</button>
        <div class="progress-container">
            <div class="progress-bar" id="progressBar"></div>
        </div>
        <div class="exam-form">
            @csrf
            @foreach ($allQuestion as $index => $allQuestion_allQuestions)
                <div class="question-block" id="question-{{ $index + 1 }}">
                    <div class="timer" id="timer-{{ $index + 1 }}">
                        <svg>
                            <circle cx="40" cy="40" r="36"></circle>
                            <circle class="progress" cx="40" cy="40" r="36" stroke-dasharray="226.19" stroke-dashoffset="0"></circle>
                        </svg>
                        <span>10</span>
                    </div>
                    <p>Q{{ $index + 1 }}. {{ $allQuestion_allQuestions->question }}</p>
                    <label>
                        <input type="radio" name="answers[{{ $allQuestion_allQuestions->id }}]" value="optionA" required>
                        <span>{{ $allQuestion_allQuestions->optionA }}</span>
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $allQuestion_allQuestions->id }}]" value="optionB">
                        <span>{{ $allQuestion_allQuestions->optionB }}</span>
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $allQuestion_allQuestions->id }}]" value="optionC">
                        <span>{{ $allQuestion_allQuestions->optionC }}</span>
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $allQuestion_allQuestions->id }}]" value="optionD">
                        <span>{{ $allQuestion_allQuestions->optionD }}</span>
                    </label>
                    <button type="button" class="next-question" data-question-id="{{ $allQuestion_allQuestions->id }}"
                        data-next="{{ $index + 2 }}">Next</button>
                </div>
            @endforeach
            <div id="result">
                <div class="summary">
                    <div>
                        <h3>Correct Answers</h3>
                        <p id="correctCount">0</p>
                    </div>
                    <div>
                        <h3>Total Time</h3>
                        <p id="totalTime">0s</p>
                    </div>
                    <div>
                        <h3>Skipped</h3>
                        <p id="skippedCount">0</p>
                    </div>
                </div>
                <div id="resultDetails"></div>
            </div>
            <button id="backButton" style="display:none;">Go Back</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Session email
            var sessionEmail = $('#hiddenEmail').val();
            var totalQuestions = $('.question-block').length;

            // Toggle Sidebar
            $('.toggle-sidebar').click(function () {
                $('.sidebar').toggleClass('active');
                $('.main-content').toggleClass('sidebar-active');
            });

            // Update Progress Bar
            function updateProgress(currentQuestion) {
                var progress = (currentQuestion / totalQuestions) * 100;
                $('#progressBar').css('width', progress + '%');
            }

            // Back button functionality
            $('#backButton, #backButtonExit').click(function () {
                window.history.back();
            });

            // Start Quiz Confirmation
            Swal.fire({
                title: "Ready to Start?",
                text: "Begin the MCQ test now?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3b82f6",
                cancelButtonColor: "#dc2626",
                confirmButtonText: "Start Quiz!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#question-1').addClass('active');
                    updateProgress(1);
                    let answerResults = [];
                    let skippedQuestions = [];
                    let timer;
                    let startTime;

                    // Start Timer
                    function startTimer(questionId, nextQuestion, questionIndex) {
                        clearTimeout(timer);
                        let timeLeft = 10;
                        startTime = Date.now();
                        $(`#timer-${questionIndex} span`).text(timeLeft);
                        var circle = $(`#timer-${questionIndex} .progress`);
                        var circumference = 226.19; // 2 * π * r (r = 36)
                        circle.css('stroke-dashoffset', 0);

                        timer = setInterval(function () {
                            timeLeft--;
                            $(`#timer-${questionIndex} span`).text(timeLeft);
                            var offset = (timeLeft / 10) * circumference;
                            circle.css('stroke-dashoffset', circumference - offset);

                            if (timeLeft <= 0) {
                                clearInterval(timer);
                                let timeSpent = Math.round((Date.now() - startTime) / 1000);
                                skippedQuestions.push(questionId);
                                let questionText = $(`#question-${questionIndex} p`).text();
                                answerResults.push({
                                    id: questionId,
                                    question: questionText,
                                    is_correct: false,
                                    skipped: true,
                                    timeTaken: timeSpent
                                });

                                $(`#question-${questionIndex}`).removeClass('active');
                                if ($(`#question-${nextQuestion}`).length) {
                                    $(`#question-${nextQuestion}`).addClass('active');
                                    updateProgress(nextQuestion);
                                    startTimer(
                                        $(`#question-${nextQuestion} .next-question`).data('question-id'),
                                        nextQuestion + 1,
                                        nextQuestion
                                    );
                                } else {
                                    displayResults();
                                }
                            }
                        }, 1000);
                    }

                    // Display Results
                    function displayResults() {
                        let answeredQuestions = answerResults.filter(r => !r.skipped);
                        let totalAnswered = answeredQuestions.length;
                        let correctAnswers = answeredQuestions.filter(r => r.is_correct).length;
                        let totalTime = answerResults.reduce((sum, result) => sum + result.timeTaken, 0);

                        $('#correctCount').text(correctAnswers);
                        $('#totalTime').text(totalTime + 's');
                        $('#skippedCount').text(skippedQuestions.length);

                        let resultHtml = '';
                        answerResults.forEach(result => {
                            let className = result.skipped ? 'skipped-answer' : result.is_correct ? 'correct-answer' : 'wrong-answer';
                            resultHtml += `<div class="${className}">${result.question} - ${result.skipped ? 'Skipped' : result.is_correct ? 'Correct' : 'Incorrect'} (Time: ${result.timeTaken}s)</div>`;
                        });

                        $('#resultDetails').html(resultHtml);
                        $('#result').show();

                        $.ajax({
                            url: '{{ route('add-resultTimeAndAns') }}',
                            method: 'POST',
                            data: {
                                _token: $('input[name="_token"]').val(),
                                correctAnswers: correctAnswers,
                                totalTime: totalTime,
                                sessionEmail: sessionEmail
                            },
                            success: function (response) {
                                if (response.message === "addedDataSuccessfully") {
                                    $('#backButton').show();
                                }
                            },
                            error: function () {
                                Swal.fire('Error', 'Failed to save results.', 'error');
                            }
                        });
                    }

                    // Start timer for first question
                    startTimer($('#question-1 .next-question').data('question-id'), 2, 1);

                    // Next Question Handler
                    $('.next-question').click(function () {
                        let questionId = $(this).data('question-id');
                        let nextQuestion = $(this).data('next');
                        let questionIndex = nextQuestion - 1;
                        let selectedAnswer = $(`input[name="answers[${questionId}]"]:checked`).val();
                        let questionText = $(`#question-${questionIndex} p`).text();
                        let timeSpent = Math.round((Date.now() - startTime) / 1000);

                        if (!selectedAnswer) {
                            Swal.fire('Warning', 'Please select an answer.', 'warning');
                            return;
                        }
                        clearTimeout(timer);

                        $.ajax({
                            url: "{{ route('mcq-result') }}",
                            method: 'POST',
                            data: {
                                _token: $('input[name="_token"]').val(),
                                question_id: questionId,
                                answer: selectedAnswer
                            },
                            success: function (response) {
                                answerResults.push({
                                    id: questionId,
                                    question: questionText,
                                    is_correct: response.is_correct,
                                    skipped: false,
                                    timeTaken: timeSpent
                                });

                                $(`#question-${questionIndex}`).removeClass('active');
                                if ($(`#question-${nextQuestion}`).length) {
                                    $(`#question-${nextQuestion}`).addClass('active');
                                    updateProgress(nextQuestion);
                                    startTimer(
                                        $(`#question-${nextQuestion} .next-question`).data('question-id'),
                                        nextQuestion + 1,
                                        nextQuestion
                                    );
                                } else {
                                    displayResults();
                                }
                            },
                            error: function () {
                                Swal.fire('Error', 'An error occurred.', 'error');
                            }
                        });
                    });
                } else {
                    window.history.back();
                }
            });
        });
    </script>
</body>
</html>