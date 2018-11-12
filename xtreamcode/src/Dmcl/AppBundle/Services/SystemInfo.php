<?php
/**
 * Created by PhpStorm.
 * User: dany
 * Date: 13/05/2017
 * Time: 19:18
 */

namespace Dmcl\AppBundle\Services;


class SystemInfo
{

    public function getTotalRam(){
        $command = "free -m | head -2 | tail -1 | awk '{print $2}' 2>&1";
        exec($command, $res);
        return $res[0];
    }

    public function getUsedRam(){
        $command = "free -m | head -2 | tail -1 | awk '{print $3}' 2>&1";
        exec($command, $res);
        return $res[0];
    }

    public function getFreeRam(){
        $command = "free -m | head -2 | tail -1 | awk '{print $4}' 2>&1";
        exec($command, $res);
        return $res[0];
    }

    public function getCPU(){

        $stat1 = file('/proc/stat');
        sleep(1);
        $stat2 = file('/proc/stat');
        $info1 = explode(" ", preg_replace("!cpu +!", "", $stat1[0]));
        $info2 = explode(" ", preg_replace("!cpu +!", "", $stat2[0]));
        $dif = array();
        $dif['user'] = $info2[0] - $info1[0];
        $dif['nice'] = $info2[1] - $info1[1];
        $dif['sys'] = $info2[2] - $info1[2];
        $dif['idle'] = $info2[3] - $info1[3];
        $total = array_sum($dif);
        $cpu = array();
        foreach ($dif as $x => $y)
            $cpu[$x] = round($y / $total * 100, 1);

        return $cpu;
    }

    public function getTotalDisk(){
        $command = "free -m | head -2 | tail -1 | awk '{print $4}' 2>&1";
        exec($command, $res);
        return $res[0];
    }

    public function getFreeDisk(){
        $command = "free -m | head -2 | tail -1 | awk '{print $4}' 2>&1";
        exec($command, $res);
        return $res[0];
    }
}