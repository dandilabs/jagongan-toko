<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    public function data()
    {
        $category_data = Category::orderBy('id_category','desc')->get();

        return datatables()
        ->of($category_data)
        ->addIndexColumn()
        ->addColumn('action' , function ($category_data) {
            return '
            <div class="btn-group">
                <button onclick="editForm(`'. route('category.update', $category_data->id_category) .'`)" class="btn btn-xs btn-info btn-flat"> <i class="fa fa-pencil"></i></button>
                <button onclick="deleteData(`'. route('category.destroy', $category_data->id_category) .'`)" class="btn btn-xs btn-danger btn-flat"> <i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['action'])
        ->make(true);
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
        $category_data = New Category();
        $category_data->name_category = $request->name_category;
        $category_data->save();

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category_data = Category::find($id);
        return response()->json($category_data);
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
        $category_data = Category::find($id);
        $category_data->name_category = $request->name_category;
        $category_data->update();

        return response()->json('Data berhasil diperbarui', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category_data = Category::find($id);
        $category_data->delete();

        return response(null, 204);
    }
}
