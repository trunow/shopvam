<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        # authorize
        if(!app('current_user_permiss')->check('index')) abort(403);

        if($request->restore) Product::onlyTrashed()->restore();

        $per_page = ($request->has('per_page') && (!$request->per_page || $request->per_page>1000))
            ? 1000
            : ($request->per_page ?? 10);
        $order_by = $request->order_by && $request->order_by=="▼" ? 'desc' : 'asc';
        $sort_by = $request->q ? 'name' : 'id';

        $products = Product::bySearch($request->q);
        if($per_page === 1000) $products = $products->withTrashed();
        $products = $products->orderBy($sort_by, $order_by);
        $products = $products->paginate($per_page);
        $products = $products->appends($request->input());
        return view('products.index', compact('products'));
    }

    /**
     * Display the creating resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        # authorize
        if(!app('current_user_permiss')->check('create')) abort(403);

        return view('products.create');

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->input());
        return redirect()->route('products.show', $product)->with('status', 'Продукт добавлен успешно');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        # authorize
        if(!app('current_user_permiss')->check('show')) abort(403);

        return view('products.show', ['product' => $product]);
    }

    /**
     * Display the resource editor.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->input());
        return redirect()->route('products.show', $product)->with('status', 'Продукт обновлён успешно');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        # TODO DestroyProductRequest
        # authorize
        if(!app('current_user_permiss')->check('destroy')) abort(403);

        $product->delete();
        return redirect()->route('products.index')->with('status', 'Продукт удалён успешно');
    }
}
