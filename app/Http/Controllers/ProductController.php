<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_data = Category::all()->pluck('name_category','id_category');
        return view('product.index', compact('category_data'));
    }

    public function data()
    {
        $product_data = Product::leftJoin('category', 'category.id_category','product.id_category')
        ->select('product.*', 'name_category')
        ->orderBy('kode_product','asc')
        ->get();

        return datatables()
        ->of($product_data)
        ->addIndexColumn()
        ->addColumn('select_all', function ($product) {
            return '
                <input type="checkbox" name="id_product[]" value="'.$product->id_product .'">
            ';
        })
        ->addColumn('kode_product', function ($product) {
            return '<span class="label label-success">'. $product->kode_product .'</span>';
        })
        ->addColumn('harga_beli', function ($product) {
            return format_uang($product->harga_beli);
        })
        ->addColumn('harga_jual', function ($product) {
            return format_uang($product->harga_jual);
        })
        ->addColumn('stock', function ($product) {
            return format_uang($product->stock);
        })
        ->addColumn('action' , function ($product_data) {
            return '
            <div class="btn-group">
                <button onclick="editForm(`'. route('product.update', $product_data->id_product) .'`)" class="btn btn-xs btn-info btn-flat"> <i class="fa fa-pencil"></i></button>
                <button onclick="deleteData(`'. route('product.destroy', $product_data->id_product) .'`)" class="btn btn-xs btn-danger btn-flat"> <i class="fa fa-trash"></i></button>
            </div>
            ';
        })
        ->rawColumns(['action','kode_product','select_all'])
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
        $product = Product::latest()->first();
        $request['kode_product'] = 'P' . tambah_nol_didepan((int)$product->id_product +1, 6);
        $product = Product::create($request->all());

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
        $product = Product::find($id);
        return response()->json($product);
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
        $product = Product::find($id);
        $product->update($request->all());
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
        $product = Product::find($id);
        $product->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_product as $id) {
            $product = Product::find($id);
            $product->delete();
        }
        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $data_product = array();
        foreach ($request->id_product as $id) {
            $product = Product::find($id);
            $data_product [] = $product;
        }

        $no = 1;
        $pdf = PDF::loadView('product.barcode', compact('data_product','no'));
        $pdf->setPaper('A4' , 'potrait');
        return $pdf->stream('product.pdf');
    }
}
