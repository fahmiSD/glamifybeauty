<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return Reviews::all()->sortByDesc("upvotes");
        return Reviews::join('users', 'users.id','=','reviews.user_id')->get(['reviews.id', 'users.username','description','button','purpose','scores','upvotes'])->sortByDesc("upvotes");
    }

    /**
     * Show the form for creating a new resource.
     */

    public function top_review(){
        return Reviews::join('users', 'users.id','=','reviews.user_id')->get(['reviews.id', 'users.username','description','button','purpose','scores','upvotes'])->sortByDesc("upvotes")->first();
    }
     
    public function count_reviews(){
        return Reviews::all()->count();
    }

    public function add_review()
    {
        $validator = Validator::make(request()->all(),[
            'user_id' => 'required',
            'description'=> 'required', 
            'purpose' => 'required',
            'scores' => 'required'
         ]);
         
         if($validator->fails()){
            return response()->json([
                'message' => $validator->messages()
            ], 400);
        }

        $review = Reviews::create([
            'user_id' => request('user_id'),
            'description' => request('description'),
            'purpose' => request('purpose'),
            'scores' => request('scores'),
            'upvotes' => 1
        ]);
        
        if($review){
            return response()->json(['message' => 'Successfully add review'],200);
        }else{
            
            return response()->json(['message' => 'Failed add review'],400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function upvote()
    {
        $review = Reviews::where('id', request('id'))->first();
        $jmlh = $review->upvotes;
        $upvote = Reviews::where('id', request('id'))->update(['upvotes' => $jmlh+1]);
        
        if($upvote){
            $button = Reviews::where('id', request('id'))->update(['button' => request('button')]);
            if($button){
                return response()->json(['message' => 'Successfully upvotes review'],200);    
            }
        }else{
            return response()->json(['message' => 'Failed upvotes review', 'id' => request('id'), 'upvote' => $jmlh],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reviews $reviews)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $reviews)
    {
        //
    }
}