<?php
namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlayerController extends Controller
{
    public function show($id)
    {
        $player = Player::findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $player
        ]);
}
    public function index()
    {
        $players = Player::all();
        return response()->json(['players' => $players]);
    }

    public function destroy($id)
    {
        $player = Player::find($id);
        if ($player) {
            $player->delete();
            return response()->json(['message' => 'Player deleted successfully']);
        } else {
            return response()->json(['message' => 'Player not found'], 404);
        }
    }

    public function player()
    {
        $players = Player::all();
        return response()->json([
            'status' => true,
            'data' => $players
        ]);
    }
    
    public function playeradd(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'cin' => 'required|unique:players,cin',
            'role' => 'required',
            'team' => 'required',
            'score' => 'required|integer',
        ]);

        $player = Player::create($incomingFields);

        return response()->json([
            'status' => true,
            'data' => $player
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate input if needed
        $validatedData = $request->validate([
            'name' => 'required|string',
            'cin' => 'required|string',
            'role' => 'required|string',
            'team' => 'required|string',
            'score' => 'required|numeric',
        ]);
    
        // Find the player by ID
        $player = Player::findOrFail($id);
    
        // Update player attributes
        $player->name = $validatedData['name'];
        $player->cin = $validatedData['cin'];
        $player->role = $validatedData['role'];
        $player->team = $validatedData['team'];
        $player->score = $validatedData['score'];
    
        // Save the updated player
        $player->save();
    
        // Return a response indicating success
        return response()->json(['message' => 'Player updated successfully', 'player' => $player]);
    }
    

    public function playerDelete($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return response()->json([
            'status' => true,
            'data' => $player
        ]);
    }
}
