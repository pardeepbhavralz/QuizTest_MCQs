<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paper</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        .exam-form {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .question-block {
            margin-bottom: 30px;
            display: none;
        }

        .question-block.active {
            display: block;
        }

        .question-block p {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .question-block label {
            display: block;
            margin-bottom: 8px;
            padding: 8px 12px;
            background-color: #f0f0f0;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .question-block label:hover {
            background-color: #e0e0e0;
        }

        .question-block input[type="radio"] {
            margin-right: 10px;
        }

        button[type="button"] {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button[type="button"]:hover {
            background-color: #45a049;
        }

        #result {
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
        }

        .correct-answer {
            background-color: #d4edda !important;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .wrong-answer {
            background-color: #f8d7da !important;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .skipped-answer {
            background-color: #fff3cd !important;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .timer {
            font-size: 16px;
            color: #dc3545;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- <div id="output" style="font-size: 24px; font-weight: bold;"></div> -->
    <div class="exam-form">
        @csrf
        @foreach ($question as $index => $question_data)
            <div class="question-block" id="question-{{ $index + 1 }}">
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

    <script>
        function countOneByOne() {
            let count = 1;
            let interval = setInterval(function () {
                $('#output').text(count);
                count++;
                if (count > 10) {
                    clearInterval(interval);
                }
            }, 1000);
        }

        $(document).ready(function () {
            countOneByOne();
            // Show first question
            $('#question-1').addClass('active');
            // Store results for each question
            let answerResults = [];
            let skippedQuestions = [];
            let timer;

            // Function to start the timer for the current question
            function startTimer(questionId, nextQuestion, questionIndex) {
                clearTimeout(timer); // Clear any existing timer
                let timeLeft = 10; // 10 seconds
                $(`#timer-${questionIndex}`).text(`Time remaining: ${timeLeft} seconds`);

                timer = setInterval(function () {
                    timeLeft--;
                    $(`#timer-${questionIndex}`).text(`Time remaining: ${timeLeft} seconds`);

                    if (timeLeft <= 0) {
                        clearInterval(timer); // Clear the timer
                        // Mark question as skipped
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
                            // Start timer for the next question
                            startTimer(
                                $(`#question-${nextQuestion} .next-question`).data('question-id'),
                                nextQuestion + 1,
                                nextQuestion
                            );
                        } else {
                            // Display results
                            displayResults();
                        }
                    }
                }, 1000); // Update every second
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
                    alert('Please select an answer before proceeding.');
                    return;
                }

                // Clear the timer since the user answered
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
                            // Start timer for the next question
                            startTimer(
                                $(`#question-${nextQuestion} .next-question`).data('question-id'),
                                nextQuestion + 1,
                                nextQuestion
                            );
                        } else {
                            // Display results
                            displayResults();
                        }
                    },
                    error: function () {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>