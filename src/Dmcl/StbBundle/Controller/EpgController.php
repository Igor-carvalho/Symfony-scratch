<?php

namespace Dmcl\StbBundle\Controller;

use Dmcl\StbBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EpgController extends Controller
{

    public  function get_weekAction(Request $request){
        $cur_num_day = date('N')-1;

        $week_short_arr = array(_('Sun'),_('Mon'),_('Tue'),_('Wed'),_('Thu'),_('Fri'),_('Sat'));

        array_push($week_short_arr, array_shift($week_short_arr));

        $month_arr = array(_('JANUARY'),_('FEBRUARY'),_('MARCH'),_('APRIL'),_('MAY'),_('JUNE'),_('JULY'),_('AUGUST'),_('SEPTEMBER'),_('OCTOBER'),_('NOVEMBER'),_('DECEMBER'));

        $year  = date("Y");
        $month = date("m");
        $day   = date("d");

        $week_days = array();

        $epg_history_weeks = 1;

        for ($i=0; $i<=13+$epg_history_weeks*7; $i++){
            $w_day   = date("d", mktime (0, 0, 0, $month, $day-$cur_num_day-$epg_history_weeks*7+$i, $year));
            $w_month = date("n", mktime (0, 0, 0, $month, $day-$cur_num_day-$epg_history_weeks*7+$i, $year))-1;
            $week_days[$i]['f_human'] = $week_short_arr[$i % 7].' '.$w_day.' '.$month_arr[$w_month];
            $week_days[$i]['f_mysql'] = date("Y-m-d", mktime (0, 0, 0, $month, $day-$cur_num_day-$epg_history_weeks*7+$i, $year));
            if ($week_days[$i]['f_mysql'] === date("Y-m-d")){
                $week_days[$i]['today'] = 1;
            }else{
                $week_days[$i]['today'] = 0;
            }
        }

        return $this->response($week_days,"");
    }


    public function get_simple_data_tableAction(Request $request){

        $em = $this->container->get("doctrine.orm.entity_manager");
        $ch_id = intval($request->get('ch_id'));
        $date  = $request->get('date');
        $page  = $request->get('p');

        $default_page = false;

        $page_items = 10;

        $from = new \DateTime($date.' 00:00:00');
        $to   = new \DateTime($date.' 23:59:59');

        $id = $request->get("ch_id");

        $programs = $em->createQueryBuilder("p")
            ->select("p")
            ->from("AppBundle:Programme","p")
            ->leftJoin("p.channel","ec")
            ->where("ec.channel = :ch_id")
            ->andWhere("p.startAt>=:from")
            ->andWhere("p.startAt<=:to")
            ->setParameter("ch_id",$id)
            ->setParameter("from",$from)
            ->setParameter("to",$to)
            ->orderBy("p.startAt","ASC")
            ->getQuery()
            ->getResult();


        $ch_idx = $em->createQueryBuilder("p")
            ->select("COUNT(p)")
            ->from("AppBundle:Programme","p")
            ->leftJoin("p.channel","ec")
            ->where("ec.channel = :ch_id")
            ->andWhere("p.startAt>=:from")
            ->andWhere("p.startAt<:to")
            ->setParameter("ch_id",$id)
            ->setParameter("from",$from)
            ->setParameter("to",new \DateTime("now"))
            ->orderBy("p.startAt","ASC")
            ->getQuery()
            ->getSingleResult();



        $total_items = count($programs);

        if ($page == 0){
            $default_page = true;
            if(count($ch_idx)>0){
                $ch_idx = $ch_idx[1];
            }else{
                $ch_idx = 0;
            }
            $page = ceil($ch_idx/$page_items);

            if ($page == 0){
                $page = 1;
            }

            if ($date != date('Y-m-d')){
                $page = 1;
                $default_page = false;
            }
        }

        $programs = array_slice($programs, ($page-1)*$page_items, $page_items);


        $now = time();
        $program = [];

        foreach ($programs as $p) {
            $program[]=[
                "name"=>$p->getTitle(),
                "start_timestamp"=>$p->getStartAt()->getTimestamp(),
                "stop_timestamp"=>$p->getEndAt()->getTimestamp(),
                "t_time"=>$p->getStartAt()->format("H:i"),
                "t_time_to"=>$p->getEndAt()->format("H:i")
            ];
        }


        for ($i=0; $i<count($program); $i++){
            if ($program[$i]['stop_timestamp'] > $now){
                $program[$i]['open'] = 0;
            }else{
                $program[$i]['open'] = 1;
            }

            $program[$i]['mark_memo'] = 0;

            $program[$i]['mark_rec'] = 0;

            if ($program[$i]['stop_timestamp'] < $now){

                $program[$i]['mark_archive'] = 1;
            }else{
                $program[$i]['mark_archive'] = 0;
            }
        }

        if ($default_page){
            $cur_page = $page;
            $selected_item = $ch_idx - ($page-1)*$page_items;
        }else{
            $cur_page = 0;
            $selected_item = 0;
        }

        $js = array(
            'cur_page'       => $cur_page,
            'selected_item'  => $selected_item,
            'total_items'    => $total_items,
            'max_page_items' => $page_items,
            'data'           => $program
        );
        return $this->response($js,"");
    }
}

