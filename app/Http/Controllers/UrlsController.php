<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pageurls;

class UrlsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $urls = Pageurls::all();
        return response()->json( [ 'data' => $urls, 'status' => 1 ] );
    }

    /**
     * Get the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $url = Pageurls::where('id', $id)->get();
        
        if( !empty($url) ){
            return response()->json( [ 'data' => $url, 'status' => 1 ] );
        } else {
            return response()->json( [ 'data' => '', 'status' => 0 ] );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // user_id is always required & url
        $this->validate($request, [
            'user_id' => 'required',
            'url' => 'required'
        ]);

        $url = new Pageurls();
        
        $url->user_id = $request->user_id;
        $url->url = $request->url;

        $url->save();

        return response()->json( [ 'data' => $url, 'status' => 1 ] );
        
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
        // id is always required
        $this->validate($request, [
            'id' => 'required'
        ]);

        $url = Pageurls::find($id);

        $url->user_id = $request->user_id;
        $url->url = $request->url;

        $url->save();

        return response()->json( [ 'data' => $url, 'status' => 1 ] );
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
        if( Pageurls::destroy( $id ) ){
            return response()->json( [ 'data' => $id, 'status' => 1 ] );
        } else {
            return response()->json( [ 'data' => $id, 'status' => 0 ] );
        }
    }
}