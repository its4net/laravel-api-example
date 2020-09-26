<?php

namespace App\StockApi;

use Illuminate\Support\Facades\Http;

class StockQuote
{
    /*
     * The stock symbol
     * @var string
     */
    public $symbol;
    
   /**
    * The stock price
    * @var float
    */
    public $price;
    
    /**
     * Stock trading volume
     * @var integer
     */
    public $volume;
       
    /**
     * Retrieve the price and volume for the give stock symbol
     * @return \App\Models\Stock
     */
    public function getStockQuote($symbol)
    {
        $response = Http::get('https://www.alphavantage.co/query',[
            'function' => 'GLOBAL_QUOTE',
            'symbol' => $symbol,
            'apikey' => config('app.stockapikey')
        ]);
        
        if ($response->successful() && !empty($response['Global Quote'])) {
            $this->price = $response["Global Quote"]["05. price"];
            $this->volume = $response["Global Quote"]["06. volume"];
            $this->symbol = $symbol;
            return $this;
        }
        
        return false;
    }
}
