<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function checkAnswer(Request $request)
    {
        
        $userResponse = strtolower(trim(preg_replace('/\s+/', '', $request->input('user_response'))));
    
        
        $correctAnswer = strtolower(trim(preg_replace('/\s+/', '', env('CIANURO_DEV_ANSWER'))));
    
        if ($userResponse === $correctAnswer) {
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors(['message' => 'Spiacente... non sono autorizzato ad aiutarti']);
        }
    }
}