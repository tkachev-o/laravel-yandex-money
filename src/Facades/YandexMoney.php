<?php
/**
 * Created by PhpStorm.
 * User: tkachev
 * Date: 17.12.2018
 * Time: 11:35
 */

namespace TkachevO\LaravelYandexMoney\Facades;

use Illuminate\Support\Facades\Facade;

class YandexMoney extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'yandexmoney';
    }
}