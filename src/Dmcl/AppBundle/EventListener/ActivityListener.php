<?php

namespace Dmcl\AppBundle\EventListener;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Model\UserInterface;

/**
 * Listener that updates the last activity of the authenticated user
 */
class ActivityListener
{
    protected $tokenStorage;
    protected $userManager;

    public function __construct(TokenStorage $tokenStorage, UserManagerInterface $userManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->userManager = $userManager;
    }

    /**
     * Update the user "lastActivity" on each request
     * @param FilterControllerEvent $event
     */
    public function onCoreController(FilterControllerEvent $event)
    {
        // Check that the current request is a "MASTER_REQUEST"
        // Ignore any sub-request
        if (!$event->isMasterRequest()) {
            return;
        }

        // Check token authentication availability
        $token = $this->tokenStorage->getToken();
        if ($token) {
            $user = $token->getUser();

            if (($user instanceof UserInterface) && !($user->isActiveNow())) {
                $user->setLastActivityAt(new \DateTime());
                $this->userManager->updateUser($user);
            }
        }
    }
}