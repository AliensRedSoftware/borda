<?php

/**
 * Яндекс модуль
 * 0.15v
 */
class yandex {
    
    /**
     * Возвращает форму доната
     * $account - Номер кошелька
     * $text - Назначение перевода
     * $pay - стандартная сумма перевода
     * $width - Ширина формы
     * $height - Высота формы
     */
    public function donate(array $options = [
            'account' => 410018314785030 ,
            'text' => "На таблеточки" ,
            'pay' => 10 ,
            'width' => 420 , 
            'height' => 223 ,
            'content' => null
        ]) {
        $optionsOLD = [
            'account' => 410018314785030 ,
            'text' => "На таблеточки" ,
            'pay' => 10 ,
            'width' => 420 ,
            'height' => 223 ,
            'content' => null
        ];
        $account = $options['account'];
        $text = $options['text'];
        $pay = $options['pay'];
        $width = $options['width'];
        $height = $options['height'];
        $content = $options['content'];
        if ($account == null) {
            $account = $optionsOLD['account'];
        }
        if ($text == null) {
            $text = $optionsOLD['text'];
        }
        if ($pay == null) {
            $pay = $optionsOLD['pay'];
        }
        if ($width == null) {
            $width = $optionsOLD['width'];
        }
        if ($height == null) {
            $height = $optionsOLD['height'];
        }        
        if ($content == null) {
            $content = $optionsOLD['content'];
        }
        return "<iframe src='https://money.yandex.ru/quickpay/shop-widget?writer=seller&targets=$text&targets-hint=&default-sum=$pay&button-text=11&payment-type-choice=on&mobile-payment-type-choice=on&hint=&successURL=&quickpay=shop&account=$account' style=\"width:$width;\" height='$height' frameborder='0' allowtransparency='true' scrolling='yes'></iframe>$content";
    }
}