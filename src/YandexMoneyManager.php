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
    protected $client;

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
        if (!$this->client instanceof API) {
            $this->client = new API(
                $this->config->get('yandexmoney.access_token')
            );
        }
        return $this->client;
    }

    /**
     * Magic call method
     *
     * @param $method
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (method_exists($this->client, $method)) {
            return call_user_func_array([$this->client, $method], $arguments);
        }
        throw  new \BadMethodCallException(sprintf('Method [%s] does not exist.', $method));
    }

}