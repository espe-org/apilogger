<?php

namespace AWT\Http\Controllers;

use AWT\Contracts\ApiLoggerInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class ApiLogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ApiLoggerInterface $logger)
    {
        /** @var Collection $apilogs */
        $apilogs = $logger->getLogs();
        if(count($apilogs)>0){
            $apilogs = $apilogs->map(function($elem, $key) {
                $elem['response_data'] = json_decode($elem['response_data'], true);
                $elem['payload'] = json_decode($elem['payload'], true);
                return $elem;
            });
            $apilogs = $apilogs->sortByDesc('created_at');
        } else {
            $apilogs = [];
        }
        //var_dump($apilogs->toArray());die();
        return view('apilog::index',compact('apilogs'));

    }
    public function delete(ApiLoggerInterface $logger)
    {
        $logger->deleteLogs();

        return redirect()->back();

    }

}
