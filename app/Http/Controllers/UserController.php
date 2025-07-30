<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\QuestionsAns;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function dashboard()
    {
        $allCategories = Categories::all();
        return view('user-dashboard', compact('allCategories'));
    }

    function showAllCategories()
    {
        $allCategories = Categories::all();
        return view('user-dashboard', compact('allCategories'));
    }

    function mcqPaper(Request $request, $id)
    {
        $question = QuestionsAns::where('category_id', $id)->get();
        return view('mcqPaper', compact('question'));
    }

    function mcqResult(Request $request)
    {
        $questionId = $request->input('question_id');
        $userAnswer = $request->input('answer');

        // Find the question and check if the answer is correct
        $question = QuestionsAns::find($questionId);

        if (!$question) {
            return response()->json(['is_correct' => false], 404);
        }
        $isCorrect = $question->correctAnswer == $userAnswer;

        return response()->json([
            'is_correct' => $isCorrect,
            'id' => $question->id
        ]);
    }

}
