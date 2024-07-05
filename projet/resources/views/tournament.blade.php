<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 300vh;
        }
        .form-container {
            width: 90%;
            max-width: 900px;
            display: flex;
            justify-content: space-around;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .container {
            width: 100%;
            padding: 30px;
            box-sizing: border-box;
        }
        input[type=text], input[type=password], input[type=date], input[type=email] {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #218838;
        }
        .update-btn, .delete-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 5px;
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
    </style>
</head>
<body>
    <div class="form-container">
        <div class="container">
            <form action="{{ route('tournament.add') }}" method="POST">
                @csrf
                <label for="tournamentname"><b>Tournament Name</b></label>
                <input type="text" placeholder="Tournament Name" name="tournamentname" required>

                <label for="stadiumname"><b>Stadium Name</b></label>
                <input type="text" placeholder="Stadium Name" name="stadiumname" required>

                <label for="date"><b>Date</b></label>
                <input type="date" name="date" required>

                <label for="price"><b>Participation Price</b></label>
                <input type="text" placeholder="Participation Price" name="price" required>

                <label for="prize"><b>Winners Prize</b></label>
                <input type="text" placeholder="Winners Prize" name="prize" required>

                <button type="submit">Add Tournament</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            </form>
            @foreach($tournaments as $tournament)
                <div>
                    <form action="{{ route('tournament.update', $tournament->id) }}" method="POST">
                        @csrf
                        <input type="text" name="tournamentname" value="{{ $tournament->tournamentname }}" required>
                        <input type="text" name="stadiumname" value="{{ $tournament->stadiumname }}" required>
                        <input type="date" name="date" value="{{ $tournament->date }}" required>
                        <input type="text" name="price" value="{{ $tournament->price }}" required>
                        <input type="text" name="prize" value="{{ $tournament->prize }}" required>
                        <button type="submit" class="update-btn">Update</button>
                    </form>
                    <form action="{{ route('tournament.delete', $tournament->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="delete-btn">Delete</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
