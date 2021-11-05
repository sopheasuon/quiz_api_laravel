<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::get();
        return Book::paginate(5);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'min:3|max:10',
            'body' => 'min:3|max:50',
        
        ]);
        
        $book = new Book();
        $book-> title= $request->title;
        $book-> body= $request->body;
        $book->save();

        return response()->json(['message' => 'Updated'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'title' => 'required|unique:book|max:10|min:3',
            'body' => 'required|uniques:book|max:50|min:3'
        ]);
        
        $book = Book::findOrFail($id);
        $book-> title= $request->title;
        $book-> body= $request->body;
        $book->save();

        return response()->json(['message' => 'Updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::destroy($id);
        if($book == 1){
            return response()->json(['message' => 'Deleted sucessfully'], 200);
        }else{
            return response()->json(['message' => 'Cannot deleted '], 404);
        }
    }
}
