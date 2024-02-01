<?php

// workerSelect()

use App\Models\CoinType;

if(!function_exists('defaultCoin')){
    function defaultCoin (){

        $defaultCoin = CoinType::where('default','=',1)->first();
        if (!$defaultCoin) {
            $defaultCoin = CoinType::first();
        }
        return $defaultCoin;
    }
}
if(!function_exists('defaultCoinId')){
    function defaultCoinId (){
        $defaultCoin = CoinType::select('id')->where('default','=',1)->first();
        if (!$defaultCoin) {
            $defaultCoin = CoinType::first();
        }
        $defaultCoinId = $defaultCoin->id;
        return $defaultCoinId;
    }
}


