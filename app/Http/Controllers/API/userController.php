<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;

class userController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $user = User::findOrFail($id);

            return  response()->json(['user' => $user] ,200);

        } catch (\Exception $e){
            return response([
                'message' => 'Something went wrong in UserController.show',
                'error'   => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {

        try {
            $user = User::findOrFail($id);

            if ($request->hasFile('image')){
                (new ImageService)->updateImage($user , $request , '/images/users/' ,'update');
            }

            $user->first_name   = $request->first_name;
            $user->last_name    = $request->last_name;
            $user->location     = $request->location;
            $user->description  = $request->description;

            $user->save();

            return  response()->json('User details updated' ,200);

        } catch (\Exception $e){
            return response([
                'message' => 'Something went wrong in UserController.update',
                'error'   => $e->getMessage()
            ], 400);
        }
    }


}
