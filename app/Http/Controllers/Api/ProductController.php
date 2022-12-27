<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Handler\Proxy;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $unit_id)
    {
        $product = Product::where('id','=',$id)->with('imagePath')->first();
        if ($unit_id) {
            // $total_quantity_by_unit_id = $this->calculateTotalQuantityByUnitId($product, $unit_id);
            
            $product->getTotalQuantityByUnitAttribute($unit_id);
            return $this->sendResponse($product, "success");      

            // return $this->sendResponse([
            //     "name" => $product->name,
            //     "total_quantity_by_unit_id" => $total_quantity_by_unit_id,
            // ], "success");      
        }

        return $this->sendResponse($product, "success");      
    }

    /*
    * Calculate total quantity by specific unit
    */
    public function calculateTotalQuantityByUnitId(Product $product, int $unit_id)
    {
        $required_unit = Unit::where('id',"=", $unit_id)->first();
        foreach ($product->units as $unit) {
            $arr[] =  $unit->modifier * $unit->pivot->amount;
         }
        $total_quantity_in_grams = array_sum ($arr) ;
        $total_quantity_by_unit_id = $total_quantity_in_grams / $required_unit->modifier;
       
        return $total_quantity_by_unit_id;
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
