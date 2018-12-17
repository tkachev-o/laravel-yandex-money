<?php

namespace TkachevO\LaravelYandexMoney;

use YandexMoney\API;
use Illuminate\Contracts\Config\Repository;

class YandexMoneyManager
{
    /**
     * The config instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The YandexMoney client instance.
     *
     * @var \YandexMoney\API
     */
    protected $api;

    /**
     * Create a new manager instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Get the config instance.
     *
     * @return \Illuminate\Contracts\Config\Repository
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get the AmoCRM client instance.
     *
     * @return \YandexMoney\API
     */
    public function getClient()
    {
        if (!$this->api instanceof API) {
            $this->api = new API(
                $this->config->get('yandex.money.access.token')
            );
        }
        return $this->api;
    }

}