<?php

namespace App\Http\Controllers;


use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $productsModel;
    protected $_model;
    protected $tableName;
    protected $routeResourceName = "products";

    public function __construct(Products $products)
    {

        $this->_model        = $products;
        $this->productsModel = $products;
        $this->tableName     = $products->getTable();
    }

    public function index()
    {
        return view($this->routeResourceName . '.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = $this->_model;
        return view($this->routeResourceName . '.create', ["model" => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => "required",
            'price' => "required"
        ]);

        try {
            // Start Transaction
            DB::beginTransaction();
            $this->_model = new Products($request->all());

            if (!$this->_model->save())
                throw new \Exception('Exception Save');

            DB::commit();
            $request->session()->flash('success', 'Products Successfully Save.');
            return redirect(route("products.index"));

        } catch (\Exception $exception) {
            DB::rollBack();
            $request->session()->flash('error', $exception->getMessage());
        }

        return back()->withInput($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {

    }

    public function anyData()
    {
        $data = Products::get();
        return Datatables::of($data)
            ->addColumn('action', function ($data) {
            return $this->actionButtons($data);
        })->make(true);
    }

    private function actionButtons($data)
    {
        $return = '<span class="badge badge-light">
                        <a href="' . route('products.edit', $data->id) . '" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a></span>
                        <a href="' . route('products.delete', $data->id) . '" title="Edit">
                            <i class="fas fa-trash-alt"></i>
                        </a></span>';

        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = $this->_model->findOrFail($id);
        return view($this->routeResourceName . '.create', ["model" => $model]);
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
        $this->validate($request, [
            'title' => "required",
            'price' => "required"
        ]);
        try {
            // Start Transaction
            DB::beginTransaction();
                Products::where('id',$id)->update([
                    'title'         => $request->title,
                    'price'         => $request->price,
                    'description'  => $request->description,
                ]);
            DB::commit();
            $request->session()->flash('success', 'Update Successfully');
            return redirect(route("products.index"));

        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
            $request->session()->flash('error', $exception->getMessage());
        }

        return back()->withInput($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Products::find($id)->delete();
            return  back()->withSuccess('Products Deleted');
        } catch (\Exception $ex) {
            return back()->withError($ex->getMessage() . ' Line No.' . $ex->getLine());
        }
    }
}
