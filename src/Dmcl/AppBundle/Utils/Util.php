<?php

namespace Dmcl\AppBundle\Utils;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Class Util
 *
 * @package Dmcl\AppBundle\Utils
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class Util
{
    /**
     * Return max_file_uploads property in php.ini
     *
     * @return string
     */
    static public function getMaxFileUploads()
    {
        return trim(ini_get('max_file_uploads'));
    }

    /**
     * Return post_max_size property in php.ini
     *
     * @return int
     */
    static public function getPosMaxSize()
    {
        $val = trim(ini_get('post_max_size'));
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            // The 'G' modifier is available since PHP 5.1.0
            case 'g':
                return $val *= 1024;
            case 'k':
                return $val /= pow(1024, 2);
            case 'b':
                return $val /= pow(1024, 3);
            default:
                return $val * 1;
        }
    }

    /**
     *  Create a logfile.
     *
     * @param string $dir Directory where save log.
     * @param string $filename The logfile's name.
     * @return string Return the path to logfile created.
     */
    static public function createLogfile($dir, $filename)
    {
        $fs = new Filesystem();
        // Check if directory exists.
        if (!$fs->exists($dir)) {
            $fs->mkdir($dir);
        }

        // Check if file exists
        $logfile = "$dir/$filename";
        if (!$fs->exists($logfile)) {
            $fs->touch($logfile);
        }

        return $logfile;
    }

    /**
     *  Return a unique global name.
     *
     * @param string $filename Filename.
     * @return string Name processed by md5 php function.
     */
    static public function md5($filename)
    {
        $datetime = new \DateTime();
        return md5($filename . $datetime->getTimestamp());
    }

    /**
     * @param array $encoders Attributes that you want use for create hash.
     * @return string Return hash created with php md5 function.
     */
    static public function hash(array $encoders = array())
    {
        $PASSWORD = 'besttranscoder'; #Password
        foreach ($encoders as $val) {
            $PASSWORD .= $val;
        }
        $hash = md5($PASSWORD, true);
        $hash = strtr(base64_encode($hash), array('+' => '-', '/' => '_', '=' => ''));
        return $hash;
    }

    /**
     * @param $live
     * @param $mac
     * @param int $expire How much seconds token is valid
     * @return string
     */
    static public function live($live, $mac, $expire)
    {
        $info = parse_url($live);
        $stream = preg_split('/\//', $info['path'])[2];

        $secured_stuff = "streams/$stream"; # RTMP link which need secured
        $PASSWORD = 'mysecretkey'; #Password
        $hash = md5($PASSWORD . $secured_stuff . $expire, true);
//        $hash = strtr(base64_encode($hash), array('+' => '-', '/' => '_', '=' => ''));

        // Hash mac
//        $macHash = strtr(base64_encode(md5($mac, true)), array('+' => '-', '/' => '_', '=' => ''));

        $hash = md5($PASSWORD . $secured_stuff . $expire . $mac . bin2hex(openssl_random_pseudo_bytes(10)), true);
        $hash = strtr(base64_encode($hash), array('+' => '-', '/' => '_', '=' => ''));


//        $url = $live . '?e=' . $expire . '&st=' . $hash . '&m=' . $macHash . '&t=' ;

        $url = $live . '?t=' . $hash;

        return $url;
    }

    /**
     * Check if the string passed is a url
     *
     * @param $url String
     * @return mixed
     */
    static public function isUrl($url) {
        $scheme = parse_url($url, PHP_URL_SCHEME);
        return isset($scheme);
    }
}