<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Questionnaire;
class QuestionnaireController extends Controller
{
    public function index(){
        $questions = Questionnaire::all();
        return view('questionnaire', compact('questions'));

    }
    public function filter(request $request){
        $query = Product::query();
foreach($request->input('responses',[]) as $questionId => $answer){
    $query->where('category',$answer);
}
$products = $query->get();

return view('products', compact('products'));
    }
}
