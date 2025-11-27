<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProdcutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Product::orderBy('name', 'ASC');

            return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('action', function ($item){
                        $buttons = '<div class="d-flex gap-2 btn-icon-list">';

                        // Jika user role = 'adm', tampilkan tombol edit dan delete
                        if (auth()->user()->role === 'adm') {
                            $buttons .= '
                                <a id="edit" class="btn btn-warning btn-circle" data-id="' . $item->id . '">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a id="delete" class="btn btn-danger btn-circle" data-id="' . $item->id . '">
                                    <i class="fas fa-trash"></i>
                                </a>
                            ';
                        }
                        
                        $buttons .= '
                            <a id="addchart" class="btn btn-success btn-circle" data-id="' . $item->id . '">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                        ';

                        $buttons .= '</div>';

                        return $buttons;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        Product::create($validateData);

        return response()->json([
            'success' => true,
            'message' => 'Product berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $validateData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ]);

        $product->update($validateData);

        return response()->json(['success' => true, 'message' => 'User berhasil diperbarui!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

         $product->delete();

         return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
    }
}
