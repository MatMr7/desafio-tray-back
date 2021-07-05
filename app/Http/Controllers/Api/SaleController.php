<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleIndexRequest;
use App\Http\Requests\SaleStoreRequest;
use App\Http\Resources\SaleResource;
use App\Models\{
    Sale,
    Seller
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyReportEmail;

class SaleController extends Controller
{

    protected $repository;

    public function __construct(Sale $model)
    {
        $this->repository = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SaleIndexRequest $request)
    {
        $sales = Seller::where('uuid',$request->route('seller_id'))->first()->sales();
        return SaleResource::collection($sales->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleStoreRequest $request)
    {
        $sale = $this->repository->create($request->validated());
        return new SaleResource($sale);
    }
}