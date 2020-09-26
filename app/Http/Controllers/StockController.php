<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockApi\StockQuote;

class StockController extends Controller
{
    /**
     * Controller constructor
     */
    public function __construct()
    {
        //$this->middleware('auth:api');
    }
    
    /**
     * Lookup the price of a stock symbol
     * 
     * @param StockQuote $stock
     * @param string $symbol
     * @param float $price
     * @return \Illuminate\Http\Response
     */
    public function stockLookup(StockQuote $stock, string $symbol, float $price)
    {
        if ($stock = $stock->getStockQuote($symbol))
        {
            return response()->json($stock,200);
        } else {
            return response()->json(['error' => 'Symbol not found'],404);
        }
        
        
    }
}
