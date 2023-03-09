<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    public function data()
    {
        $product_data = Product::orderBy('id_product','desc')->get();

        return datatables()
        ->of($product_data)
        ->addIndexColumn()
        ->addColumn('action' , function ($product_data) {
            return '
            <div class="btn-group">
                <button onclick="editForm(`'. route('product.update', $product_data->id_product) .'`)" class="btn btn-xs btn-info btn-flat"> <i class="fa fa-pencil"></i></button>
                <button onclick="deleteData(`'. route('product.destroy', $product_data->id_product) .'`)" class="btn btn-xs btn-danger btn-flat"> <i class="fa fa-trash"></i></button>
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
        $product_data = New Product();
        $product_data->name_category = $request->name_category;
        $product_data->save();

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
