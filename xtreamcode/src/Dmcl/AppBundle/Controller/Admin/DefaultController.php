<?php

namespace Dmcl\AppBundle\Controller\Admin;

use Dmcl\AppBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $now = new \DateTime('now');
        $befor = new \DateTime('-30 days');
        $now = date_timestamp_get($now);
        $befor = date_timestamp_get($befor);

        $linesStatistic = [
            'total'      => 0,
            'premium'    => 0,
            'trial'      => 0,
            'expired'    => 0,
            'mag'        => 0,
            'enigma2'    => 0,
            'assigned'   => 0
        ];

        $credtsStatistics = [
            'total'          => 0,
            'bonus'          => 0,
            'bitcoin'        => 0,
            'card'           => 0,
            'redeem'         => 0,
            'nlines'         => 0,
            'extended'       => 0,
            'aconnections'   => 0,
            'resellers'      => 0,
            'refound'        => 0,
            'added'          => 0
        ];

        if($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $linesStatistic['total'] = $em->getRepository('AppBundle:Users')->totalLines($befor, $now)[0];
            $linesStatistic['premium'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 0)[0];
            $linesStatistic['trial'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 1)[0];
            $linesStatistic['expired'] = $em->getRepository('AppBundle:Users')->totalLinesExpired($befor, $now)[0];
            $linesStatistic['mag'] = $em->getRepository('AppBundle:Users')->totalLinesMag($befor, $now)[0];
            $linesStatistic['enigma2'] = $em->getRepository('AppBundle:Users')->totalLinesEnigma2($befor, $now)[0];
            $linesStatistic['assigned'] = $em->getRepository('AppBundle:Users')->totalLinesAssigned($befor, $now)[0];
        }
        else{
            $user = $this->getUser();

            $linesStatistic['total'] = $em->getRepository('AppBundle:Users')->totalLines($befor, $now, $user->getId())[0];
            $linesStatistic['premium'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 0, $user->getId())[0];
            $linesStatistic['trial'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 1, $user->getId())[0];
            $linesStatistic['expired'] = $em->getRepository('AppBundle:Users')->totalLinesExpired($befor, $now, $user->getId())[0];
            $linesStatistic['mag'] = $em->getRepository('AppBundle:Users')->totalLinesMag($befor, $now, $user->getId())[0];
            $linesStatistic['enigma2'] = $em->getRepository('AppBundle:Users')->totalLinesEnigma2($befor, $now, $user->getId())[0];
            $linesStatistic['assigned'] = $em->getRepository('AppBundle:Users')->totalLinesAssigned($befor, $now, $user->getId())[0];
        }

        return $this->render('AppBundle:themes/default/Admin/Default:dashboard.html.twig',[
            'linesStatistic' => $linesStatistic,
            'credtsStatistics' => $credtsStatistics
        ]);
    }

    public function ajaxAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $response = ['success' => 200, 'data' => ''];

        $period = $request->get('period');

        $now = new \DateTime('now');
        $now = date_timestamp_get($now);

        switch($period){
            case 0:
                $befor = new \DateTime('-30 days');
            break;

            case 1:
                $befor = new \DateTime('-30 days');
            break;

            case 2:
                $befor = new \DateTime('-1 year');            
            break;
        }

        $befor = date_timestamp_get($befor);

        $linesStatistic = [
            'total'      => 0,
            'premium'    => 0,
            'trial'      => 0,
            'expired'    => 0,
            'mag'        => 0,
            'enigma2'    => 0,
            'assigned'   => 0
        ];

        $credtsStatistics = [
            'total'          => 0,
            'bonus'          => 0,
            'bitcoin'        => 0,
            'card'           => 0,
            'redeem'         => 0,
            'nlines'         => 0,
            'extended'       => 0,
            'aconnections'   => 0,
            'resellers'      => 0,
            'refound'        => 0,
            'added'          => 0
        ];

        $user = $this->getUser();

        if($this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN')) {
            $linesStatistic['total'] = $em->getRepository('AppBundle:Users')->totalLines($befor, $now)[0];
            $linesStatistic['premium'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 0)[0];
            $linesStatistic['trial'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 1)[0];
            $linesStatistic['expired'] = $em->getRepository('AppBundle:Users')->totalLinesExpired($befor, $now)[0];
            $linesStatistic['mag'] = $em->getRepository('AppBundle:Users')->totalLinesMag($befor, $now)[0];
            $linesStatistic['enigma2'] = $em->getRepository('AppBundle:Users')->totalLinesEnigma2($befor, $now)[0];
            $linesStatistic['assigned'] = $em->getRepository('AppBundle:Users')->totalLinesAssigned($befor, $now)[0];
        }
        else{
            $user = $this->getUser();

            $linesStatistic['total'] = $em->getRepository('AppBundle:Users')->totalLines($befor, $now, $user->getId())[0];
            $linesStatistic['premium'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 0, $user->getId())[0];
            $linesStatistic['trial'] = $em->getRepository('AppBundle:Users')->totalLinesPremium($befor, $now, 1, $user->getId())[0];
            $linesStatistic['expired'] = $em->getRepository('AppBundle:Users')->totalLinesExpired($befor, $now, $user->getId())[0];
            $linesStatistic['mag'] = $em->getRepository('AppBundle:Users')->totalLinesMag($befor, $now, $user->getId())[0];
            $linesStatistic['enigma2'] = $em->getRepository('AppBundle:Users')->totalLinesEnigma2($befor, $now, $user->getId())[0];
            $linesStatistic['assigned'] = $em->getRepository('AppBundle:Users')->totalLinesAssigned($befor, $now, $user->getId())[0];
        }

        $response['data']['linesStatistic'] = $linesStatistic;
        $response['data']['credtsStatistics'] = $credtsStatistics;

        return new JsonResponse($response, 200);
    }
}