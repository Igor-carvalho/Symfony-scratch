<?php

namespace Dmcl\AppBundle\Services\Payments;

define('WM_GET', 0);
define('WM_POST', 1);
define('WM_LINK', 2);

define('WM_RES_OK', 0);
define('WM_RES_FAIL', 1);
define('WM_RES_NOPARAM', 2);

define('WM_ALL_SUCCESS', 0);
define('WM_ALL_FAIL', 1);
define('WM_SUCCESS_FAIL', 2);

define('WM_RF_ERR1', 'The required parameter payee_purse is missing or incorrect');
define('WM_RF_ERR2', 'The required parameter payment_amount is missing or incorrect');
define('WM_RF_ERR3', 'The optional parameter payment_no is incorrect');
define('WM_RF_ERR4', 'The optional parameter payment_desc is incorrect');
define('WM_RF_ERR5', 'The optional parameter sim_mode is incorrect');
define('WM_RF_ERR6', 'The optional parameter result_url is incorrect');
define('WM_RF_ERR7', 'The optional parameter success_url is incorrect');
define('WM_RF_ERR8', 'The optional parameter success_method is incorrect');
define('WM_RF_ERR9', 'The optional parameter fail_url is incorrect');
define('WM_RF_ERR10', 'The optional parameter fail_method is incorrect');
define('WM_RF_ERR11', 'The optional parameter payment_creditdays is incorrect');

define('WM_PRF_REALMODE', 0);
define('WM_PRF_TESTMODE', 1);
 

/**
 * Description of WebMoney
 *
 * @author dmanuelcl@gmail.com
 */
class WebMoney {
    
    public function __construct() {
        ;
    }

    var $payee_purse = '';
    var $payment_amount = '';
    var $payment_no = '';
    var $mode = '';
    var $sys_invs_no = '';
    var $sys_trans_no = '';
    var $payer_purse = '';
    var $payer_wm = '';
    var $paymer_number = '';
    var $paymer_email = '';
    var $telepat_phonenumber = '';
    var $telepat_orderid = '';
    var $payment_creditdays = '';
    var $hash = '';
    var $sys_trans_date = '';
    var $secret_key = '';
    var $extra_fields = array();
     

    function processIpn() {
        if (!isset($_POST['LMI_PAYMENT_NO']) ||(isset($_POST['LMI_PREREQUEST']) && $_POST['LMI_PREREQUEST'] == 1)) {
            return WM_RES_NOPARAM;
        }
        $this->payee_purse = @$_POST['LMI_PAYEE_PURSE'];
        $this->payment_amount = @$_POST['LMI_PAYMENT_AMOUNT'];
        $this->payment_no = @$_POST['LMI_PAYMENT_NO'];
        $this->mode = @$_POST['LMI_MODE'];
        $this->sys_invs_no = @$_POST['LMI_SYS_INVS_NO'];
        $this->sys_trans_no = @$_POST['LMI_SYS_TRANS_NO'];
        $this->payer_purse = @$_POST['LMI_PAYER_PURSE'];
        $this->payer_wm = @$_POST['LMI_PAYER_WM'];
        $this->paymer_number = @$_POST['LMI_PAYMER_NUMBER'];
        $this->paymer_email = @$_POST['LMI_PAYMER_EMAIL'];
        $this->telepat_phonenumber = @$_POST['LMI_TELEPAT_PHONENUMBER'];
        $this->telepat_orderid = @$_POST['LMI_TELEPAT_ORDERID'];
        $this->payment_creditdays = @$_POST['LMI_PAYMENT_CREDITDAYS'];
        $this->hash = @$_POST['LMI_HASH'];
        $this->sys_trans_date = @$_POST['LMI_SYS_TRANS_DATE'];
        $this->secret_key = @$_POST['LMI_SECRET_KEY'];
        foreach ($_POST as $field => $value) {
            if (substr($field, 0, 4) != 'LMI_') {
                $this->extra_fields[$field] = $value;
            }
        }
    }

    function CheckMD5($payee_purse, $payment_amount, $payment_no, $secret_key) {
        $key = $payee_purse . $payment_amount . $payment_no;
        $key .= $this->mode . $this->sys_invs_no . $this->sys_trans_no;
        $key .= $this->sys_trans_date . $secret_key . $this->payer_purse;
        $key .= $this->payer_wm;
        // we use strtoupper() because of the differences between PHP and ASP...
        if ($this->hash == strtoupper(md5($key))) {
            return WM_RES_OK;
        }
        return WM_RES_FAIL;
    }
}