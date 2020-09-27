<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockApi\StockQuote;
use App\Notifications\StockLoss;
use App\Notificaitons\StockGain;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Controller constructor
     */
    public function __construct()
    {
        $this->middleware('auth:api');
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
            if ($stock->price > $price) {
                $gainPercent = round((($stock->price / $price) - 1) * 100,2); 
                Auth:user()->notify(new StockGain($stock,$gainPercent));
            } else if ($stock->price < $price) {
                $lossPercent = round((1 - ($stock->price / $price)) * 100,2);
                Auth::user()->notify(new StockLoss($stock,$lossPercent));
            }
            return response()->json($stock,200);
        } else {
            return response()->json(['error' => 'Symbol not found'],404);
        }
        
        
    }
}
