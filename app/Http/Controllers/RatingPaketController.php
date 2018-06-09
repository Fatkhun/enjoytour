<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RatingPaket;
use Auth;
use App\User;
use Illuminate\Auth\RequestGuard;
class RatingPaketController extends Controller
{

    /**
         * Create a new auth instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->middleware('auth');
        }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rating = RatingPaket::where('user_id', Auth::user()->id)->get();
        $res['success'] = true;
        $res['message'] = 'Success get all rating';
        $res['result'] = $rating;
        return response($res);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $rating = new RatingPaket;
          $rating->user_id = Auth::user()->id;
          $rating->nama_wisata = $request->input('nama_wisata');  
          $rating->nama = $request->input('nama');
          $rating->rating = $request->input('rating');
          $rating->review = $request->input('review');
          if($rating->save()){
            $res['success'] = true;
            $res['message'] = 'Success add new rating';
            $res['result'] = $rating;
            return response($res);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $rating = RatingPaket::where('id',$id)->first();
              if ($rating !== null) {
                $res['success'] = true;
                $res['message'] = 'Find rating';
                $res['result'] = $rating;
                return response($res);
              }else{
                $res['success'] = false;
                $res['message'] = 'Rating not found!';
                return response($res);
              }
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
        if ($request->has('rating') || $request->has('review')) {
            $rating = RatingPaket::where('id', $id)->first();
            $rating->user_id = Auth::user()->id;
            $rating->nama_wisata = $request->input('nama_wisata');
            $rating->nama = $request->input('nama');
            $rating->rating = $request->input('rating');
            $rating->review = $request->input('review');
            if ($rating->save()) {
                $res['success'] = true;
                $res['message'] = 'Success update rating';
                $res['result'] = $rating;
                return response($res);
            }
        }else{
          $res['success'] = false;
          $res['message'] = 'Please fill field!';
          return response($res);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rating = RatingPaket::where('id',$id)->first();
              if ($rating->delete($id)) {
                  $res['success'] = true;
                  $res['message'] = 'Success delete rating';
                  $res['result'] = $rating;
                  return response($res);
              }else{
                    $res['success'] = false;
                    $res['message'] = 'Failed delete rating!';
                    return response($res);
              }
    }
}
