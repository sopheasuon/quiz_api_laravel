<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Http\Resources\AuthorResource;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return AuthorResource::collection(Author::orderBy('id', 'desc')->get());
        // return Author::with("book");
        return AuthorResource::paginate(3);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'min:3|max:10',
            'age' => 'min:1|max:10'
        ]);

        $author = new Author();
        $author->name = $request->name;
        $author->age = $request->age;
        $author->province = $request->province;
        $author->save();

        return response()->json(['message' => 'Created'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Author::findOrFail($id);
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
            'name' => 'max:10|min:3',
            'age' => 'max:10|min:1'
        ]);

        $author = Author::findOrFail($id);
        $author->name = $request->title;
        $author->age = $request->age;
        $author->province = $request->province;
        $author->save();

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
        $author = Author::destroy($id);
        if($author == 1){
            return response()->json(['message' => 'Deleted sucessfully'], 200);
        }else{
            return response()->json(['message' => 'Cannot deleted '], 404);
        }
    }
}
