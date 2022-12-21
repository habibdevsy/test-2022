<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends BaseController
{
   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        if($request->o_type == 'user'){
            $user = User::find($request->o_id);
            if ($user) {
                $image = Image::create([
                    'path' => $request->path,
                    'description' => $request->description,
                    'o_id' => $request->o_id,
                    'o_type' => 'user',
                ]);
                return $this->sendResponse($image, "success");      
            }
            return $this->sendError("the user not found!", "error");      
        }
        if($request->o_type == 'product') {
            $product = Product::find($request->o_id);
            if ($product) {
               $image = Image::create([
                    'path' => $request->path,
                    'description' => $request->description,
                    'o_id' => $request->o_id,
                    'o_type' => 'product',
                ]);
                return $this->sendResponse($image, "success");      
            }
            return $this->sendError("the product not found!", "error");      
        }

        return $this->sendError("error", "error");      
    }
}
