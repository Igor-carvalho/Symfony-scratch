<?php
/**
 * Created by PhpStorm.
 * User: dany
 * Date: 8/05/17
 * Time: 8:53
 */

namespace Dmcl\AppBundle\Form\EventListener;


use Dmcl\AppBundle\Entity\Channel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CodecFieldsSubscriber implements EventSubscriberInterface
{

    private $codecs_audio;
    private $codecs_video;
    private $protocolRemoved;

    /**
     * CodecFieldsSubscriber constructor.
     *
     * @param $codecs_audio
     * @param $codecs_video
     */
    public function __construct($codecs_audio, $codecs_video, $protocolRemoved)
    {
        $this->codecs_audio = $codecs_audio;
        $this->codecs_video = $codecs_video;
        $this->protocolRemoved = $protocolRemoved;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $form = $event->getForm();
        $protocol = 'rtmp';

        if(!$this->protocolRemoved){
            $choices = $form->get('protocol')->getConfig()->getOption('choices');
            $choices = array_keys($choices);

            // this would be your entity, i.e. SportMeetup
            /**
            * @var Channel $data
            */

            $data = $event->getData();
            $protocol = strtolower($data->getProtocol());
            $protocol = empty($protocol) ? current($choices) : $protocol;
        }
  
        $codecs_audio = $this->codecs_audio;
        $codecs_video = $this->codecs_video;
       
        $choicesVideo = array();
        $choicesAudio = array();

        foreach ($codecs_video[$protocol] as $codec){
            $choicesVideo[strtolower($codec)] = $codec;
        }

        foreach ($codecs_audio[$protocol] as $codec){
            $choicesAudio[strtolower($codec)] = $codec;
        }

        //$choicesVideo = $codecs_video[$protocol];
        //$choicesAudio = $codecs_audio[$protocol];

        $form->add('videoCodec', "choice", array(
            'choices' => $choicesVideo,
            "attr"=>array("class"=>"form-control")
        ));

        $form->add('audioCodec', "choice", array(
            'choices' => $choicesAudio,
            "attr"=>array("class"=>"form-control")
        ));            
    }
}