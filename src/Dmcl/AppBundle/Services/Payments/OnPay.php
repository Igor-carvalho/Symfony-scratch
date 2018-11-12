<?php

namespace Dmcl\AppBundle\Services\Payments;

use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Description of OnPay
 *
 * @author dmanuelcl@gmail.com
 */
class OnPay {

    function processIpn($secret, $sumMd5, $curency, $itemId, $cost) {
        $status = false;
        
        if (isset($_REQUEST['type'])) {
            if ($_REQUEST['type'] == 'check') {
                $order_amount = $_REQUEST['order_amount'];
                $pay_for = $_REQUEST['pay_for'];
                $md5 = $_REQUEST['md5'];
                $checkMd5 = md5("fix;$sumMd5;$curency;$itemId;yes;$secret");
                if ($checkMd5 == $md5 && $order_amount == $cost && $pay_for == $itemId) {
                    $status = true;
                }
            }
        }
        return $status;
    }

}
