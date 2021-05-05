<?php

namespace Tartan\IranianSms\Adapter;

use Illuminate\Support\Facades\Config;
use Samuraee\EasyCurl\EasyCurl;

class SmsIr extends AdapterAbstract implements AdapterInterface
{
    public  $gateway_url = 'https://ws.sms.ir/';

    private $credential = [
        'apiKey'   => '',
        'lineNo'   => '',
        'secretKey' => '',
    ];

    public function __construct($account = null)
    {
        if (is_null($account)) {
            $this->gateway_url          = config('iranian_sms.smsir.gateway');
            $this->credential['apiKey']   = config('iranian_sms.smsir.api_key');
            $this->credential['secretKey']   = config('iranian_sms.smsir.secret_key');
            $this->credential['lineNo'] = config('iranian_sms.smsir.line_no');
        } else {
            $this->gateway_url          = config("iranian_sms.smsir.{$account}.gateway");
            $this->credential['apiKey']   = config("iranian_sms.smsir.{$account}.api_key");
            $this->credential['secretKey']   = config("iranian_sms.smsir.{$account}.secret_key");
            $this->credential['lineNo'] = config("iranian_sms.smsir.{$account}.line_no");
        }

    }

    public function send(string $number, string $message)
    {
        $number = $this->filterNumber($number);

        $curl = $this->getCurl();
        $body   = [
            'Messages' => [$message],
            'MobileNumbers' => [$number],
            'LineNumber' => $this->credential['lineNo']
        ];

        $curl->addHeader('x-sms-ir-secure-token', self::getToken());
        $result = $curl->rawPost($this->gateway_url . 'api/MessageSend', json_encode($body));

        return json_decode($result,true);
    }


    public function sendUltraFast(string $number, $parameters, $templateId)
    {
        $number = $this->filterNumber($number);

        $params = [];
        foreach ($parameters as $key => $value) {
            $params[] = ['Parameter' => $key, 'ParameterValue' => $value];
        }

        $curl = $this->getCurl();
        $body   = ['ParameterArray' => $params,'TemplateId' => $templateId,'Mobile' => $number];
        $curl->addHeader('x-sms-ir-secure-token', self::getToken());
        $result = $curl->rawPost($this->gateway_url . 'api/UltraFastSend', json_encode($body));

        return json_decode($result,true);
    }

    private function getToken()
    {
        $curl = $this->getCurl();
        $body = ['UserApiKey' => $this->credential['apiKey'],'SecretKey' => $this->credential['secretKey'],'System'=>'laravel_v_1_4'];
        $result = $curl->rawPost($this->gateway_url.'api/Token', json_encode($body));
        return json_decode($result,true)['TokenKey'];
    }

    public function getCurl(): EasyCurl
    {
        $curl = parent::getCurl();
        $curl->addHeader('Content-type', 'application/json');
        $curl->addHeader('Accept', 'application/json, */*');
        return $curl;
    }
}
