<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'type', 'user'])->get();
        $categories = Category::all();
        $types = Type::all();
        $productTest = [
            "description" => "Produto na cor xcolor, Modelo UNKNOW, Fabricante FABS. Em perfeito estado de conservação",
            "amount" => 1,
            "images" => "img.png",
            "category_id" => 1,
            "type_id" => 1
        ];
        return view('dashboard.products.home',
            [
                "title" => "Produtos", "products" => $products, "categories" => $categories, "types" => $types,
                "productTest" => $productTest
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "asdasd";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile("images") && $request->file("images")->isValid()) {
            $product = $request->only('description', 'amount', 'images', 'category_id', 'type_id');
            $request->validate([
                "category_id" => "required",
                "type_id" => "required",
                "amount" => "required",
                "images" => "mimes:jpg,jpeg,bmp,png,webp|max:2048",
                "description" => "required",
            ]);
            $upload = $request->images->storeAs('product_images', $product["images"]->getClientOriginalName(),
                'public');
            if ($upload) {
                $p = new Product();
                $p->forceFill([
                    "category_id" => $product["category_id"],
                    "type_id" => $product["type_id"],
                    "amount" => $product["amount"],
                    "images" => $product["images"]->getClientOriginalName(),
                    "user_id" => auth()->user()->id,
                    "description" => $product["description"],
                ]);
                $p->save();
                return redirect()->back();
            }
            return redirect()->back()->withErrors(["upload" => "Falha ao fazer upload"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $types = Type::all();
        $productTest = [
            "description" => "Produto na cor xcolor, Modelo UNKNOW, Fabricante FABS. Em perfeito estado de conservação",
            "amount" => 1,
            "images" => "img.png",
            "category_id" => 1,
            "type_id" => 1
        ];
        return view("dashboard.products.edit", [
            "title" => "Editando Produto", "categories" => $categories, "types" => $types, "product" => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile("images") && $request->file("images")->isValid()) {
            $reqParams = $request->only('description', 'amount', 'images', 'category_id', 'type_id');
            $reqParams["images"] = $request->file("images")->getClientOriginalName();
            $request->validate([
                "category_id" => "required",
                "type_id" => "required",
                "amount" => "required",
                "images" => "mimes:jpg,jpeg,bmp,png,webp|max:2048",
                "description" => "required",
            ]);
            $upload = $request->images->storeAs('product_images', $reqParams["images"], 'public');
            if ($upload && $product->update($reqParams)) {
                return redirect()->route('createProduct');
            }
        }
        return redirect()->back()->withErrors(["update" => "Erro ao tentar atualizar o produto"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
