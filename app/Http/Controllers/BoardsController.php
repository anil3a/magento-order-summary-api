<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pageurls;
use App\Users;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class BoardsController extends Controller
{
    /**
     * Display a listing of the Users with last url.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * Display a listing of all visitors with ip address and cookie id.
     * @param integer GET['limit']  limiting number of rows
     * @param integer GET['visited_at']  limiting number of rows
     *
     * @return \Illuminate\Http\Response
     */
    public function pagevisits()
    {
        $users = array();
        $limit = 20;
        if ( Input::get('limit') ) {
            $limit = Input::get('limit');
        }
        
        $createddaterange_from = false;
        if ( Input::get('visited_from') ) {
            $createddaterange_from = Input::get('visited_from');
        }

        $createddaterange_to = false;
        if ( Input::get('visited_to') ) {
            $createddaterange_to = Input::get('visited_to');
        }

        $orderby = 'users.id';
        if ( Input::get('orderby') )
        {
            $orderByFields = array( 
                                'users.id','users.quote_id','users.order_id','users.page_id',
                                'users.grand_total','users.email','users.delivery_type',
                                'users.delivery_date','users.delivery_address','users.quantity',
                                'users.created_at','users.updated_at','users.cookie_id','users.ip',
                                'users.agent','pageurls.user_id','pageurls.url',
                                'pageurls.created_at','pageurls.id'
            );

            if ( in_array( Input::get('orderby'), $orderByFields ) )
            {
                $orderby = Input::get('orderby');
            }
        }

        $sortby = 'desc';
        if ( Input::get('sortby') ) {
            $sortbys = strtolower( Input::get('sortby') );
            if ( 'desc' == $sortbys || 'asc' == $sortbys ) {
                $sortby = $sortbys;
            }
        }

        $query = DB::table('pageurls')
            ->select(   'pageurls.user_id','pageurls.url','pageurls.created_at as pagecreated_at',
                        'users.cookie_id','users.grand_total','users.ip',
                        'users.created_at as usercreated_at','users.updated_at as userupdated_at',
                        'users.quote_id','users.order_id','users.quantity','users.agent',
                        'users.delivery_date','users.page_id'
            )
            ->leftJoin('users', function($joinpageurl){
                $joinpageurl->on('pageurls.user_id', '=', 'users.id');
            });

        if ( !empty( $createddaterange_from ) )
        {
            $query->where( 'pageurls.created_at', '>', $createddaterange_from );
        }

        if ( !empty( $createddaterange_to ) )
        {
            $query->where( 'pageurls.created_at', '<', $createddaterange_to );
        }


        $users = $query->orderBy( $orderby, $sortby )->take( $limit )->get();

        return response()->json( [ 'data' => $users, 'status' => 1 ] );
    }

    
}