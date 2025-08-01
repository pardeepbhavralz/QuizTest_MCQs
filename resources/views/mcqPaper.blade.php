<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paper</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        /* Reset and Base Styles */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            line-height: 1.6;
            color: #1f2937;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: #1e293b;
            color: #ffffff;
            padding: 24px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 2rem;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
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

        .sidebar .nav-links a:hover {
            background-color: #334155;
            color: #ffffff;
        }

        .sidebar .nav-links a i {
            font-size: 1.1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 32px;
            flex-grow: 1;
            background-color: #f8fafc;
            min-height: 100vh;
        }

        .main-header {
            background-color: #ffffff;
            padding: 20px 32px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0;
        }

        .main-header h1 a {
            color: #1e293b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .main-header h1 a:hover {
            color: #3b82f6;
        }

        /* Quiz Form Styling */
        .exam-form {
            max-width: 800px;
            margin: 0 auto;
        }

        .question-block {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            display: none;
            transition: all 0.3s ease;
        }

        .question-block.active {
            display: block;
        }

        .question-block p {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .timer {
            font-size: 1rem;
            font-weight: 500;
            color: #dc2626;
            background-color: #fef2f2;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center;
        }

        /* Custom Radio Buttons */
        .question-block label {
            display: block;
            padding: 12px 16px;
            margin-bottom: 8px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }

        .question-block label:hover {
            background-color: #f1f5f9;
            border-color: #3b82f6;
        }

        .question-block input[type="radio"] {
            margin-right: 12px;
            accent-color: #3b82f6;
        }

        .question-block input[type="radio"]:checked + label {
            background-color: #e6f0ff;
            border-color: #3b82f6;
        }

        /* Next Button */
        .next-question {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            display: block;
            margin: 16px auto 0;
        }

        .next-question:hover {
            background-color: #2563eb;
        }

        /* Return Button */
        #returnBtn {
            background-color: #dc2626;
            color: #ffffff;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-bottom: 24px;
        }

        #returnBtn:hover {
            background-color: #b91c1c;
        }

        /* Result Section */
        #result {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        #result p {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 16px;
        }

        .correct-answer {
            color: #15803d;
            background-color: #f0fdf4;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .wrong-answer {
            color: #b91c1c;
            background-color: #fef2f2;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .skipped-answer {
            color: #ca8a04;
            background-color: #fefce8;
            padding: 8px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-260px);
                width: 220px;
                z-index: 1000;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 24px;
            }

            .toggle-sidebar {
                display: block;
                position: fixed;
                top: 16px;
                left: 16px;
                z-index: 1001;
                background-color: #1e293b;
                color: #ffffff;
                border: none;
                padding: 12px;
                border-radius: 8px;
                font-size: 1.1rem;
                cursor: pointer;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            .main-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }

            .question-block {
                padding: 20px;
            }

            .modal-dialog {
                margin: 16px;
            }
        }

        @media (min-width: 769px) {
            .toggle-sidebar {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="toggle-sidebar">☰ Menu</button>
    <aside class="sidebar">
        <h2>Quiz Dashboard</h2>
        <nav>
            <ul class="nav-links">
                <li><a href="">Home</a></li>
                <li><a href="{{ route('quiz-withTimeout') }}">Quiz with Mix-Technology Based</a></li>
                <li><a href="{{ route('listOfAllUser_user') }}">List of candidate with top rank</a></li>
                @if(Session::get('email'))
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
            </ul>
        </nav>
    </aside>

    <div class="main-content">
        <div class="existsDiv">
            <input type="button" value="Return to main dashboard" id="returnBtn">
        </div>
        <div class="exam-form">
            @csrf
            @foreach ($question as $index => $question_data)
                <div class="question-block {{ $index == 0 ? 'active' : '' }}" id="question-{{ $index + 1 }}">
                    <div class="timer" id="timer-{{ $index + 1 }}">Time remaining: 10 seconds</div>
                    <p>Q{{ $index + 1 }}. {{ $question_data->question }}</p>
                    <label>
                        <input type="radio" name="answers[{{ $question_data->id }}]" value="optionA" required>
                        {{ $question_data->optionA }}
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $question_data->id }}]" value="optionB">
                        {{ $question_data->optionB }}
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $question_data->id }}]" value="optionC">
                        {{ $question_data->optionC }}
                    </label>
                    <label>
                        <input type="radio" name="answers[{{ $question_data->id }}]" value="optionD">
                        {{ $question_data->optionD }}
                    </label>
                    <button type="button" class="next-question" data-question-id="{{ $question_data->id }}"
                        data-next="{{ $index + 2 }}">Next</button>
                </div>
            @endforeach
            <div id="result" style="display: none;"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            // Toggle Sidebar for Mobile
            $('.toggle-sidebar').click(function () {
                $('.sidebar').toggleClass('active');
            });

            let answerResults = [];
            let skippedQuestions = [];
            let timer;

            // Function to start the timer for the current question
            function startTimer(questionId, nextQuestion, questionIndex) {
                clearTimeout(timer);
                let timeLeft = 10;
                $(`#timer-${questionIndex}`).text(`Time remaining: ${timeLeft} seconds`);

                timer = setInterval(function () {
                    timeLeft--;
                    $(`#timer-${questionIndex}`).text(`Time remaining: ${timeLeft} seconds`);

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        skippedQuestions.push(questionId);
                        let questionText = $(`#question-${questionIndex} p`).text();
                        answerResults.push({
                            id: questionId,
                            question: questionText,
                            is_correct: false,
                            skipped: true
                        });

                        // Move to the next question
                        $(`#question-${questionIndex}`).removeClass('active');
                        if ($(`#question-${nextQuestion}`).length) {
                            $(`#question-${nextQuestion}`).addClass('active');
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

            // Function to display results
            function displayResults() {
                let answeredQuestions = answerResults.filter(r => !r.skipped);
                let totalAnswered = answeredQuestions.length;
                let correctAnswers = answeredQuestions.filter(r => r.is_correct).length;

                let resultHtml = `<p>Quiz completed! Correct answers: ${correctAnswers} out of ${totalAnswered} (Skipped: ${skippedQuestions.length})</p>`;

                answerResults.forEach(result => {
                    let className;
                    if (result.skipped) {
                        className = 'skipped-answer';
                        resultHtml += `<div class="${className}">${result.question} - Skipped</div>`;
                    } else {
                        className = result.is_correct ? 'correct-answer' : 'wrong-answer';
                        resultHtml += `<div class="${className}">${result.question} - ${result.is_correct ? 'Correct' : 'Incorrect'}</div>`;
                    }
                });

                $('#result').html(resultHtml).show();
                $('.exam-form').hide(); // Hide quiz form after results
            }

            // Start timer for the first question
            startTimer($('#question-1 .next-question').data('question-id'), 2, 1);

            // Handle next question button click
            $('.next-question').click(function () {
                let questionId = $(this).data('question-id');
                let nextQuestion = $(this).data('next');
                let questionIndex = nextQuestion - 1;
                let selectedAnswer = $(`input[name="answers[${questionId}]"]:checked`).val();
                let questionText = $(`#question-${questionIndex} p`).text();

                if (!selectedAnswer) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Answer Selected',
                        text: 'Please select an answer before proceeding.',
                        confirmButtonColor: '#3b82f6'
                    });
                    return;
                }
                clearTimeout(timer);

                // Send answer to server
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
                            skipped: false
                        });

                        $(`#question-${questionIndex}`).removeClass('active');

                        if ($(`#question-${nextQuestion}`).length) {
                            $(`#question-${nextQuestion}`).addClass('active');
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again.',
                            confirmButtonColor: '#3b82f6'
                        });
                    }
                });
            });

            // Return Button
            $('#returnBtn').click(function () {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to continue this Quiz test!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, exit it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.history.back();
                    }
                });
            });
        });
    </script>
</body>

</html>