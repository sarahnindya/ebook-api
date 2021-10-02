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
        return [
            "status" => "200",
            "message" => "Load data success",
            "data" => Book::all()
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Book::create([
            "title"=> $request->title,
            "description"=> $request->description,
            "author"=> $request->author,
            "publisher"=> $request->publisher,
            "date_of_issue"=> $request->date_of_issue,
        ]);

        return [
            "status" => "201",
            "message" => "Create data success",
            "data" => $data
        ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Book::find($id);
        if($data){

            return [
                "status" => "200",
                "message" => "Show Data Detail Success",
                "data" => $data
            ];

        }else{

            return [
                "status" => "201",
                "message" => "Data Not Found",
            ];

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = Book::find($id);

        $data -> title = $request->title;
        $data -> description= $request->description;
        $data -> author = $request->author;
        $data -> publisher = $request->publisher;
        $data -> date_of_issue = $request->date_of_issue;

        $data->save();

        return "Update Data Succsess";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Book::find($id);

        if($data){
            $data->delete();
            return[
                "status" => "204",
                "message" => "Remove success"
            ];
        }else{
            return[
                "status" => "404",
                "message" => "Data not found"
            ];
        }
    }
}
