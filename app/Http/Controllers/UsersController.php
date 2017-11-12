<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use App\Pageurls;
use App\Options;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    protected $options;

    public function __construct()
    {
        if ( empty( $this->options ) )
        {
            $opts = new Options();
            $this->options = $opts->getCachedOptions();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$users = Users::orderBy('id', 'desc')->take(20)->get();
        $limit = 20;
        if ( Input::get('limit') ) {
            $limit = Input::get('limit');
        }

        $users = DB::table('users')
            ->select('users.*', 'pageurls.url' )
            ->leftJoin('pageurls', function($joinpageurl){
                $joinpageurl->on('users.id', '=', 'pageurls.user_id')
                ->on('pageurls.id', '=', 
                       DB::raw('(select max(id) from pageurls where user_id = users.id)'));
            })
            ->where("users.page_id", ">", "4")
            ->orderBy('users.id', 'desc')->take( $limit )->get();

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
        
        if( !empty($user) ){
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

        if ( !empty( $request->input('order_id') ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->input('page_id') ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->input('grand_total') ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->input('email') ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->input('delivery_type') ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->input('delivery_date') ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->input('delivery_address') ) )
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
    public function update(Request $request, $quote_id)
    {
        // Quote id is always required
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $user = Users::where('quote_id', $quote_id)->get();
        //where('about', 'data')->firstOrFail();

        $user->quote_id = $request->quote_id;

        if ( !empty( $request->input('order_id') ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->input('page_id') ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->input('grand_total') ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->input('email') ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->input('delivery_type') ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->input('delivery_date') ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->input('delivery_address') ) )
        {
            $user->delivery_address = $request->delivery_address;
        }
        
        $user->save();

        return response()->json( [ 'data' => $user, 'status' => 1 ] );
    }

    /**
     * Create or update the specified resource in storage by QUOTE
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function savebyquote(Request $request, $quote_id)
    {
        // Quote id is always required
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $user = Users::where('quote_id', $quote_id)->first();
        //where('about', 'data')->firstOrFail();

        if ( empty( $user ) )
        {
            $user = new Users();
        }

        $user->quote_id = $request->quote_id;

        if ( !empty( $request->input('order_id') ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->input('page_id') ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->input('grand_total') ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->input('email') ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->input('delivery_type') ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->input('delivery_date') ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->input('delivery_address') ) )
        {
            $user->delivery_address = $request->delivery_address;
        }
        if ( !empty( $request->input('quantity') ) )
        {
            $user->quantity = $request->quantity;
        }
        
        $user->save();

        if ( !empty( $request->input('sparkle_currenturl') ) )
        {
            $url = new Pageurls();
        
            $url->user_id = $user->id;
            $url->url = $request->sparkle_currenturl;

            $url->save();
        }


        return response()->json( [ 'data' => $user, 'status' => 1 ] );
        
    }

    /**
     * Create or update the specified resource in storage by USER ID
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request, $id)
    {
        // Quote id is always required
        $this->validate($request, [
            'quote_id' => 'required'
        ]);

        $user = Users::where('id', $id)->first();
        //where('about', 'data')->firstOrFail();

        if ( empty( $user ) )
        {
            $user = new Users();
        }

        $user->quote_id = $request->quote_id;

        if ( !empty( $request->input('order_id') ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->input('page_id') ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->input('grand_total') ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->input('email') ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->input('delivery_type') ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->input('delivery_date') ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->input('delivery_address') ) )
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

    /**
     * Create or update the specified resource in storage by CO
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function savebycookie(Request $request, $cookie_id)
    {
        // Quote id is always required
        $this->validate($request, [
            'cookie_id' => 'required'
        ]);

        if ( !empty( $request->input('ip') ) && !empty( $this->options['whitelist_board'] ) )
        {
            $ips = explode( ",", $this->options['whitelist_board'] );

            foreach ( $ips as $ip )
            {
                if ( $ip = $request->input('ip') )
                {
                    return false;
                }
            }
        }

        if ( !empty( $request->input('quote_id') ) )
        {
            $user = Users::where('cookie_id', $cookie_id)->where('quote_id',$request->input('quote_id'))->first();
        } else 
        {
            $user = Users::where('cookie_id', $cookie_id)->first();
        }
        //where('about', 'data')->firstOrFail();

        if ( empty( $user ) )
        {
            $user = new Users();
        }

        $user->cookie_id = $request->cookie_id;
        if ( !empty( $request->input('ip') ) )
        {
            $user->ip = $request->ip;
        }
        if ( !empty( $request->input('agent') ) )
        {
            $user->agent = $request->agent;
        }

        if ( !empty( $request->input('quote_id') ) )
        {
            $user->quote_id = $request->quote_id;
        }
        if ( !empty( $request->input('order_id') ) )
        {
            $user->order_id = $request->order_id;
        }
        if ( !empty( $request->input('page_id') ) )
        {
            $user->page_id = $request->page_id;
        }
        if ( !empty( $request->input('grand_total') ) )
        {
            $user->grand_total = $request->grand_total;
        }
        if ( !empty( $request->input('email') ) )
        {
            $user->email = $request->email;
        }
        if ( !empty( $request->input('delivery_type') ) )
        {
            $user->delivery_type = $request->delivery_type;
        }
        if ( !empty( $request->input('delivery_date') ) )
        {
            $user->delivery_date = $request->delivery_date;
        }
        if ( !empty( $request->input('delivery_address') ) )
        {
            $user->delivery_address = $request->delivery_address;
        }
        if ( !empty( $request->input('quantity') ) )
        {
            $user->quantity = $request->quantity;
        }
        
        $user->save();

        if ( !empty( $request->input('sparkle_currenturl') ) )
        {
            $url = new Pageurls();
        
            $url->user_id = $user->id;
            $url->url = $request->sparkle_currenturl;

            $url->save();
        }


        return response()->json( [ 'data' => $user, 'status' => 1 ] );
        
    }
}