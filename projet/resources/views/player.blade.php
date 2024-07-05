<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Centering vertically */
            height: 150vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-bottom: 20px; /* Space between form and table */
        }

        table {
            width: 100%;
            max-width: 500px;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dddddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        h1 {
            margin-bottom: 20px;
            color: #333333;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555555;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .question p {
            margin-bottom: 10px;
            color: #555555;
        }

        .question input[type="radio"] {
            margin-right: 10px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .update-btn, .delete-btn {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 5px;
            cursor: pointer;
        }

        .update-btn:hover {
            background-color: #0056b3;
        }

        .delete-btn {
            background-color: #dc3545;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }

        #result {
            margin-top: 20px;
            color: #333333;
        }
    </style>
</head>
<body>
    <form action="{{ route('playeradd') }}" method="POST" id="quiz-form">
        @csrf
        <h1>Player Registration</h1>
        <label for="uname"><b>Name</b></label>
        <input type="text" placeholder="Enter your name" name="name" required>

        <label for="role"><b>Role</b></label>
        <input type="text" placeholder="Enter your role" name="role" required>

        <label for="cin"><b>CIN</b></label>
        <input type="text" placeholder="Enter your CIN" name="cin" required>

        <label for="team">Choose a team:</label>
        <select id="team" name="team" required>
            <option value="team1">Team 1</option>
            <option value="team2">Team 2</option>
        </select>

        <div id="quiz-container">
            <h1>Man of the Match Quiz</h1>

            <div class="question" id="question1">
                <p>Make a goal</p>
                <input type="radio" name="q1" value="a" required> a) Yes
                <input type="radio" name="q1" value="b" required> b) No
            </div>

            <div class="question" id="question2">
                <p>Make an assist</p>
                <input type="radio" name="q2" value="a" required> a) Yes
                <input type="radio" name="q2" value="b" required> b) No
            </div>

            <div class="question" id="question3">
                <p>Key Passes and Crosses:</p>
                <input type="radio" name="q3" value="a" required> a) More than 80%
                <input type="radio" name="q3" value="b" required> b) Less than 80%
            </div>

            <div class="question" id="question4">
                <p>Defensive Contributions:</p>
                <input type="radio" name="q4" value="a" required> a) Win most of duels
                <input type="radio" name="q4" value="b" required> b) Not
            </div>

            <div class="question" id="question5">
                <p>Make correct interceptions</p>
                <input type="radio" name="q5" value="a" required> a) More than 80%
                <input type="radio" name="q5" value="b" required> b) Less than 80%
            </div>

            <div class="question" id="question6">
                <p>Make a penalty</p>
                <input type="radio" name="q6" value="a" required> a) Yes
                <input type="radio" name="q6" value="b" required> b) No
            </div>

            <div class="question" id="question7">
                <p>Leadership and Influence:</p>
                <input type="radio" name="q7" value="a" required> a) Demonstrating leadership qualities
                <input type="radio" name="q7" value="b" required> b) Not
            </div>

            <div class="question" id="question8">
                <p>Moment of Brilliance:</p>
                <input type="radio" name="q8" value="a" required> a) Executing a game-changing moment
                <input type="radio" name="q8" value="b" required> b) Not
            </div>

            <div class="question" id="question9">
                <p>Set Piece Mastery</p>
                <input type="radio" name="q9" value="a" required> a) Excellence in taking set pieces
                <input type="radio" name="q9" value="b" required> b) Not
            </div>

            <input type="hidden" name="score" id="score">
            <button type="button" onclick="submitQuiz()">Add Player</button>
            <div id="result"></div>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>CIN</th>
                <th>Team</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>{{ $player->name }}</td>
                <td>{{ $player->role }}</td>
                <td>{{ $player->cin }}</td>
                <td>{{ $player->team }}</td>
                <td>{{ $player->score }}</td>
                <td>
                    <form action="{{ route('player.update', $player->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name" value="{{ $player->name }}">
                        <input type="hidden" name="role" value="{{ $player->role }}">
                        <input type="hidden" name="cin" value="{{ $player->cin }}">
                        <input type="hidden" name="team" value="{{ $player->team }}">
                        <input type="hidden" name="score" value="{{ $player->score }}">
                        <button type="submit" class="update-btn">Update</button>
                    </form>
                    <form action="{{ route('player.delete', $player->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        function calculateScore() {
            var score = 0;
            var q1Answer = document.querySelector('input[name="q1"]:checked');
            if (q1Answer && q1Answer.value === "a") {
                score++;
            }
            var q2Answer = document.querySelector('input[name="q2"]:checked');
            if (q2Answer && q2Answer.value === "a") {
                score++;
            }
            var q3Answer = document.querySelector('input[name="q3"]:checked');
            if (q3Answer && q3Answer.value === "a") {
                score++;
            }
            var q4Answer = document.querySelector('input[name="q4"]:checked');
            if (q4Answer && q4Answer.value === "a") {
                score++;
            }
            var q5Answer = document.querySelector('input[name="q5"]:checked');
            if (q5Answer && q5Answer.value === "a") {
                score++;
            }
            var q6Answer = document.querySelector('input[name="q6"]:checked');
            if (q6Answer && q6Answer.value === "a") {
                score++;
            }
            var q7Answer = document.querySelector('input[name="q7"]:checked');
            if (q7Answer && q7Answer.value === "a") {
                score++;
            }
            var q8Answer = document.querySelector('input[name="q8"]:checked');
            if (q8Answer && q8Answer.value === "a") {
                score++;
            }
            var q9Answer = document.querySelector('input[name="q9"]:checked');
            if (q9Answer && q9Answer.value === "a") {
                score++;
            }
            return score;
        }

        function submitQuiz() {
            var score = calculateScore();
            document.getElementById("score").value = score;
            document.getElementById("quiz-form").submit();
        }
    </script>
</body>
</html>
