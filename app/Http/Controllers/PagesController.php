<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Funnelpages;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $funnelpages = Funnelpages::all();
        return response()->json( [ 'data' => $funnelpages, 'status' => 1 ] );
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
        $funnelpage = Funnelpages::where('id', $id)->get();
        
        if( !empty($funnelpage) ){
            return response()->json( [ 'data' => $funnelpage, 'status' => 1 ] );
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
        // id is always required and unique & title
        $this->validate($request, [
            'id' => 'required|unique:funnelpages',
            'title' => 'required'
        ]);

        $funnelpage = new Funnelpages();
        
        $funnelpage->id = $request->id;
        $funnelpage->title = $request->title;

        if ( !empty( $request->input('url') ) )
        {
            $funnelpage->url = $request->url;
        }
        if ( !empty( $request->input('active') ) )
        {
            $funnelpage->active = $request->active;
        }
        $funnelpage->save();

        return response()->json( [ 'data' => $funnelpage, 'status' => 1 ] );
        
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
        // id is always required and unique & title
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $funnelpage = Funnelpages::find($id);

        $funnelpage->id = $request->id;

        if ( !empty( $request->input('title') ) )
        {
            $funnelpage->title = $request->title;
        }
        if ( !empty( $request->input('url') ) )
        {
            $funnelpage->url = $request->url;
        }
        if ( !empty( $request->input('active') ) )
        {
            $funnelpage->active = $request->active;
        }

        $funnelpage->save();

        return response()->json( [ 'data' => $funnelpage, 'status' => 1 ] );
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
        if( Funnelpages::destroy( $id ) ){
            return response()->json( [ 'data' => $id, 'status' => 1 ] );
        } else {
            return response()->json( [ 'data' => $id, 'status' => 0 ] );
        }
    }
}