<?php
/**
 * Created by PhpStorm.
 * User: lazaro.garcia
 * Date: 4/8/2016
 * Time: 9:54 AM
 */

namespace Dmcl\AppBundle\Form\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class TimeshiftModel
{  
    /**
    * @var \DateTime
    * @ORM\Column(name="startdate", type="datetime")
    */
    private $startdate; 

    /**
     * @var \DateTime
     * @ORM\Column(name="enddate", type="datetime")
     */
    private $enddate;

    // /**
    //  * @var \DateTime
    //  *
    //  */

    // private $starttime;
    
    // /**
    // * @var \DateTime
    // *
    // */
    // private $endtime;

    /**
     * @return string
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @param string $startdate
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    /**
     * @return string
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param string $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    // /**
    //  * @return string
    //  */
    // public function getStarttime()
    // {
    //     return $this->starttime;
    // }

    // /**
    //  * @param string $starttime
    //  */
    // public function setStarttime($starttime)
    // {
    //     $this->starttime = $starttime;
    // }

    // /**
    //  * @return string
    //  */
    // public function getEndtime()
    // {
    //     return $this->endtime;
    // }

    // /**
    //  * @param string $endtime
    //  */
    // public function setEndtime($endtime)
    // {
    //     $this->endtime = $endtime;
    // }
}