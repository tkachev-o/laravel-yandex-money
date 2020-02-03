# Laravel Yandex.Money SDK PHP

**Laravel Yandex.Money SDK PHP** - ServiceProvider и Facade для **Laravel 5** предоставляющие интеграцию библиотеки [yandex-money-sdk-php](https://github.com/yandex-money/yandex-money-sdk-php).

Небольшой пример с использованием запроса платежа:

```php
<?php

namespace App\Jobs;

use App\User;
use App\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Log;
...
use TkachevO\LaravelYandexMoney\YandexMoneyManager;

class ProcessRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;

    /**
     * Create a new job instance.
     *
     * @param Payment $payment
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Repository $config)
    {

        // Добавим токен в репозиторий
        $config->set('yandexmoney.access_token', 'YOUR_TOKEN_STRING');

        // Инициализируем клиент
        $api = new YandexMoneyManager($config);
        $client = $api->getClient();
        
        // Зарегистриуем запрос платежа 
        $request = $client->requestPayment(array(
            "pattern_id" => "phone-topup",
            "phone-number" => $payment->recipient->phone,
            "amount" => $payment->amount,
        ));
        
        // Что-нибудь сделаем с ответом
        $status = $request->status;
    }
}
