<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\QuestionsAns;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function mainDashboard()
    {
        $allCategoriesFetch = Categories::get();
        return view('admin-dashboard ', compact('allCategoriesFetch'));
    }
    function categories()
    {
        // Fetch all categories
        $allCategoriesFetch = Categories::get();
        return view('categories', compact('allCategoriesFetch'));

    }
    public function categoriesAdd(Request $request)
    {
       
        // Validate input
        $validation = $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Please enter a category name.',
        ]);

        $categories = new Categories;
        $categories->name = $request->name;
        $categories->save();

        return back()->with('success', 'Category Added');
    }


    public function deletCategories(Request $request)
    {
        $categoryId = $request->input('id');
        $category = Categories::find($categoryId);

        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category_deleted_successfully']);
        }

        return response()->json(['message' => 'Category not found.'], 404);
    }

    function searchCategories(Request $request)
    {
        $searchValue = $request->input('searchValue');
        $value = Categories::where('name', $searchValue)->first();
        if ($value) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    function getCategoryContent(Request $request)
    {
        $getContent = $request->input('id');
        return $getContent;

    }

    public function addMcq(Request $request)
    {
        parse_str($request->formData, $parsedData);
        // Access category_id if needed
        $categoryId = $parsedData['category_id'] ?? null;
        $question = $parsedData['question'] ?? null;
        $optionA = $parsedData['optionA'] ?? null;
        $optionB = $parsedData['optionB'] ?? null;
        $optionC = $parsedData['optionC'] ?? null;
        $optionD = $parsedData['optionD'] ?? null;
        $correctAnswer = $parsedData['correctAnswer'] ?? null;

        $newQuestion = new QuestionsAns();
        $newQuestion->category_id = $categoryId;
        $newQuestion->question = $question;
        $newQuestion->optionA = $optionA;
        $newQuestion->optionB = $optionB;
        $newQuestion->optionC = $optionC;
        $newQuestion->optionD = $optionD;
        $newQuestion->correctAnswer = $correctAnswer;
        $newQuestion->save();
        return response()->json([
            'success' => 'success'
        ]);

    }
}
