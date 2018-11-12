<?php

namespace Dmcl\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class NginxSecurityController extends Controller
{
    public function checkAction()
    {
        return new Response("200 OK");
    }
}
