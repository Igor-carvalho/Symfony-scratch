<?php

namespace Dmcl\AppBundle\Services\Payments;

/**
 * Description of MoneyBookers
 *
 * @author dmanuelcl@gmail.com
 */
class MoneyBookers {

    function processIpn($MBEmail, $secretWord) { 
        // Validate the Moneybookers signature
        $concatFields = $_POST['merchant_id']
                . $_POST['transaction_id']
                . strtoupper(md5($secretWord))
                . $_POST['mb_amount']
                . $_POST['mb_currency']
                . $_POST['status'];


// Ensure the signature is valid, the status code == 2,
// and that the money is going to you
        if (strtoupper(md5($concatFields)) == $_POST['md5sig'] && $_POST['status'] == 2 && $_POST['pay_to_email'] == $MBEmail) {
            return true;
        } else {
            return false;
        }
    }

}
