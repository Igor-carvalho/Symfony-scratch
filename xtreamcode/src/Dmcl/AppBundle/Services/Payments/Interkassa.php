<?php

namespace Dmcl\AppBundle\Services\Payments;

/**
 * Description of Interkassa
 *
 * @author dmanuelcl@gmail.com
 */
class Interkassa {

    function processIpn($shop_id, $secret_key) {
        $status_data = $_POST; 
        if ($shop_id != $status_data['ik_shop_id']) {
            error_log('Shop ids does not match');
            return false;
        }
        $sing_hash_str = $status_data['ik_shop_id'] . ':' .
                $status_data['ik_payment_amount'] . ':' .
                $status_data['ik_payment_id'] . ':' .
                $status_data['ik_paysystem_alias'] . ':' .
                $status_data['ik_baggage_fields'] . ':' .
                $status_data['ik_payment_state'] . ':' .
                $status_data['ik_trans_id'] . ':' .
                $status_data['ik_currency_exch'] . ':' .
                $status_data['ik_fees_payer'] . ':' .
                $secret_key;
        $sign_hash = strtoupper(md5($sing_hash_str));
        return ($status_data['ik_sign_hash'] === $sign_hash);
    }

}
