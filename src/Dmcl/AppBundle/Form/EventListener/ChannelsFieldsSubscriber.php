<?php
/**
 * Created by PhpStorm.
 * User: dany
 * Date: 8/05/17
 * Time: 8:53
 */

namespace Dmcl\AppBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class ChannelsFieldsSubscriber implements EventSubscriberInterface
{
    private $choices;

    /**
     * ChannelsFieldsSubscriber constructor.
     *
     * @param $services
     */
    public function __construct($services)
    {
        $choices = array();
        
        $response = $services->sendRequest('channels/list', '127.0.0.1');        
        $response = json_decode($response);    
        
        $code = $response->success;
                                        
        if($code == 401 || $code == 404 || $code == 500)
            return $this->render("AppBundle:themes/default/Home:error$code.html.twig", array(
                'msg' => $response->msg,
                'data' =>  $response->data
                )); 
                                    
        if($code === 403)
            return $this->render('AppBundle:themes/default/Home:unauthorized.html.twig', array(
                    'msg' => $response->msg,
                    'password' =>  $response->data->password,
                    'apikey' =>  $response->data->apikey
                )); 

        if($response->data)
            foreach ($response->data->channels as $channel){
                $this->choices[$channel->id] = $channel->name;
            }  
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

        $form->add('channels', "choice", array(
            'choices' => $this->choices,
            "required"=>true,
            "multiple"=>true,
            "attr"=>array("class"=>"select2 form-control")
        ));        
    }
}