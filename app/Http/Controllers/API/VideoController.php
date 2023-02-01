<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Youtube\StoreYoutubeRequest;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function store(StoreYoutubeRequest $request)
    {
        try {
            $yt = new Video();


            $yt->user_id = $request->get('user_id');
            $yt->title   = $request->get('title');
            $yt->url     = env("YT_EMBED_URL") . $request->get('url') . "?autoplay=0";

            return response()->json('New Youtube link saved!', 200);

        }catch (\Exception $e){
            return response([
                'message' => 'Something went wrong in VideoController.store',
                'error'   => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     ** @param  int $user_id
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $user_id)
    {
        try {
            $videosByUser = Video::where('user_id', $user_id)->get();
            return response()->json(['videos_by_user' => $videosByUser], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in YoutubeController.show',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *@param  int $id
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $yt = Video::findOrFail($id);
            $yt->delete();

            return response()->json('Video deleted', 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Something went wrong in VideoController.destroy',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
