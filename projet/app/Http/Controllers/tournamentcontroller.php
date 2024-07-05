<?php

namespace App\Http\Controllers;

use App\Models\Tournois;
use Illuminate\Http\Request;

class TournamentController extends Controller
{
    public function tournament()
    {
        $tournaments = Tournois::all();
        return view('tournament', compact('tournaments'));
    }

    public function addTournament(Request $request)
    {
        $validatedData = $request->validate([
            'tournamentname' => 'required|string|max:255',
            'stadiumname' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|string|max:255',
            'prize' => 'required|string|max:255',
        ]);

        $tournois = new Tournois();
        $tournois->tournamentname = $validatedData['tournamentname'];
        $tournois->stadiumname = $validatedData['stadiumname'];
        $tournois->date = $validatedData['date'];
        $tournois->price = $validatedData['price'];
        $tournois->prize = $validatedData['prize'];
        $tournois->save();

        return response()->json(['message' => 'Tournament added successfully'], 200);
    }

    public function updateTournament(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tournamentname' => 'required|string|max:255',
            'stadiumname' => 'required|string|max:255',
            'date' => 'required|date',
            'price' => 'required|string|max:255',
            'prize' => 'required|string|max:255',
        ]);

        $tournois = Tournois::findOrFail($id);
        $tournois->update($validatedData);

        return response()->json(['message' => 'Tournament updated successfully'], 200);
    }

    public function deleteTournament($id)
    {
        $tournois = Tournois::findOrFail($id);
        $tournois->delete();

        return response()->json(['message' => 'Tournament deleted successfully'], 200);
    }
}
