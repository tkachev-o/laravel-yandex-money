<?php

namespace TkachevO\Tests\LaravelYandexMoney\Facades;

use TkachevO\LaravelYandexMoney\YandexMoneyManager;
use TkachevO\LaravelYandexMoney\Facades\YandexMoney;
use TkachevO\Tests\LaravelYandexMoney\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class YandexMoneyTest extends AbstractTestCase
{
    use FacadeTrait;

    protected function getFacadeAccessor()
    {
        return 'yandexmoney';
    }

    protected function getFacadeClass()
    {
        return YandexMoney::class;
    }

    protected function getFacadeRoot()
    {
        return YandexMoneyManager::class;
    }
}
