<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = Users::all();
        return response()->json( [ 'data' => $users, 'status' => 1 ] );
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
        $user = Users::where('id', $id)->get();
        
        if( !empty($user['items']) ){
            return response()->json( [ 'data' => $user, 'status' => 1 ] );
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
        // Quote id is always required
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $user = new Users();
        
        $user->quote_id = $request->quote_id;

        if ( !empty( $request->order_id ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->page_id ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->grand_total ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->email ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->delivery_type ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->delivery_date ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->delivery_address ) )
        {
            $user->delivery_address = $request->delivery_address;
        }
        $user->save();

        return response()->json( [ 'data' => $user, 'status' => 1 ] );
        
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
        // Quote id is always required
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $user = Users::find($id);

        $user->quote_id = $request->quote_id;

        if ( !empty( $request->order_id ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->page_id ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->grand_total ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->email ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->delivery_type ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->delivery_date ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->delivery_address ) )
        {
            $user->delivery_address = $request->delivery_address;
        }
        
        $user->save();

        return response()->json( [ 'data' => $user, 'status' => 1 ] );
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
        if( Users::destroy( $id ) ){
            return response()->json( [ 'data' => $id, 'status' => 1 ] );
        } else {
            return response()->json( [ 'data' => $id, 'status' => 0 ] );
        }
    }
}