<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dmcl\AppBundle\Services;

use Dmcl\AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Default logout success handler will redirect users to a configured path.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Alexander <iam.asm89@gmail.com>
 * @author Yordan P. Dieguez <ypdieguez@tuta.io>
 */
class LogoutSuccess implements LogoutSuccessHandlerInterface
{
    protected $httpUtils;
    protected $targetUrl;
    protected $container;

    /**
     * @param HttpUtils $httpUtils
     * @param string $targetUrl
     * @param ContainerInterface $container
     */
    public function __construct(HttpUtils $httpUtils, $targetUrl = '/', ContainerInterface $container)
    {
        $this->httpUtils = $httpUtils;
        $this->targetUrl = $targetUrl;
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function onLogoutSuccess(Request $request)
    {
        /**
         * @var User $user
         */
        $token = $this->container->get("security.token_storage")->getToken();
        if ($token) {
            $user = $token->getUser();
            $user->setHash(null);
            $em = $this->container->get("doctrine.orm.default_entity_manager");
            $em->persist($user);
            $em->flush();
        }

        return $this->httpUtils->createRedirectResponse($request, $this->targetUrl);
    }

}
