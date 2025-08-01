<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\QuestionsAns;
use App\Models\Register;
use App\Models\ResultWithTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function dashboard()
    {
        $allCategories = Categories::all();
        $email = session('email');

        $resultsByDate = DB::table('result_with_times')
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(timeTakenSec) as total_time'),
                DB::raw('SUM(totalCorrectAns) as totalCorrectAns')
            )
            ->where('email', $email)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

            $dataFromSessionEmail = Register::where('email' , $email)->get();
            
        return view('user-dashboard', compact('allCategories', 'resultsByDate' , 'dataFromSessionEmail'));
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
    // ------
    function quizWithTimeout()
    {
        $allQuestion = QuestionsAns::inRandomOrder()->get();
        return view('quiz-withTimeout', compact('allQuestion'));
    }

    function mcqResultTimeOut(Request $request)
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

    function addResultTimeAndAns(Request $request)
    {
        $correctAnswers = $request->input('correctAnswers');
        $totalTime = $request->input('totalTime');
        $sessionEmail = $request->input('sessionEmail');

        $storeUserResult = new ResultWithTime;
        $storeUserResult->email = $sessionEmail;
        $storeUserResult->totalCorrectAns = $correctAnswers;
        $storeUserResult->timeTakenSec = $totalTime;
        $storeUserResult->save();

        return response()->json([
            'message' => 'addedDataSuccessfully'
        ]);
    }

    public function listOfAllUser(Request $request)
    {
        $query = ResultWithTime::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%')
                    ->orWhere('timeTakenSec', $search);
            });
        }

        $allRankedbased = $query->orderBy('timeTakenSec', 'desc')->get();

        return view('list-userRanked', compact('allRankedbased'));
    }

    public function listOfAllUser_user(Request $request)
    {
        $query = ResultWithTime::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%')
                    ->orWhere('timeTakenSec', $search);
            });
        }

        $allRankedbased = $query->orderBy('timeTakenSec', 'desc')->get();

        return view('listOfAllUser_user', compact('allRankedbased'));
    }

    function changePassword(Request $request)
    {
      
    $email = Session::get('email');
    // Retrieve user by email
    $user = Register::where('email', $email)->first();

    if (!$user) {
        return back()->with('error', 'User not found.');
    }
    // Hash the password before saving
    $user->password = $request->newPassword;
     $user->confirmPasword = $request->newPassword;
    $user->save();
    return back()->with('success', 'Password changed successfully.');
    }


}
