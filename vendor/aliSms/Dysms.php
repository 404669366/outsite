<?php
/**
 * Created by PhpStorm.
 * User: 40466
 * Date: 2018/5/14
 * Time: 13:14
 */

namespace vendor\aliSms;


class Dysms
{
    private static $accessKeyId = 'LTAIa9knkx1EK94H';
    private static $accessKeySecret = 'MnB7RvKrCuLzflqTEjayyGr2A77di7';

    /**
     * 发送单条短信
     * @param string $tel
     * @param array $tpl
     * @param string $templateCode
     * @param string $signName
     * @return bool|\stdClass
     */
    public static function sendSms($tel = '', $tpl = [], $templateCode = 'SMS_150490675', $signName = '博瑞恩贝')
    {
        $params["PhoneNumbers"] = $tel;
        $params["SignName"] = $signName;
        $params["TemplateCode"] = $templateCode;
        $params['TemplateParam'] = json_encode($tpl, JSON_UNESCAPED_UNICODE);
        $helper = new SignatureHelper();
        $content = $helper->request(
            self::$accessKeyId,
            self::$accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",])
        );
        return $content;
    }
}