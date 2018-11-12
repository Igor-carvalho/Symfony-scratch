<?php
    //
    // vnStat PHP frontend (c)2006-2010 Bjorge Dijkstra (bjd@jooz.net)
    //
    // This program is free software; you can redistribute it and/or modify
    // it under the terms of the GNU General Public License as published by
    // the Free Software Foundation; either version 2 of the License, or
    // (at your option) any later version.
    //
    // This program is distributed in the hope that it will be useful,
    // but WITHOUT ANY WARRANTY; without even the implied warranty of
    // MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    // GNU General Public License for more details.
    //
    // You should have received a copy of the GNU General Public License
    // along with this program; if not, write to the Free Software
    // Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
    //
    //
    // see file COPYING or at http://www.gnu.org/licenses/gpl.html
    // for more information.
    //
    require 'config.php';
    require 'localize.php';
    require 'vnstat.php';
    validate_input();

    require "./themes/$style/theme.php";


    function kbytes_to_string($kb)
    {

        global $byte_notation;

        $units = array('TB','GB','MB','KB');
        $scale = 1024*1024*1024;
        $ui = 0;

        $custom_size = isset($byte_notation) && in_array($byte_notation, $units);

        while ((($kb < $scale) && ($scale > 1)) || $custom_size)
        {
            $ui++;
            $scale = $scale / 1024;

            if ($custom_size && $units[$ui] == $byte_notation) {
                break;
            }
        }

        return sprintf("%0.2f %s", ($kb/$scale),$units[$ui]);
    }

    function write_summary()
    {
        global $summary,$top,$day,$hour,$month;

        $trx = $summary['totalrx']*1024+$summary['totalrxk'];
        $ttx = $summary['totaltx']*1024+$summary['totaltxk'];

        //
        // build array for write_data_table
        //

        $sum = array();

        if (count($day) > 0 && count($hour) > 0 && count($month) > 0) {
            $sum[0]['act'] = 1;
            $sum[0]['label'] = T('This hour');
            $sum[0]['rx'] = $hour[0]['rx'];
            $sum[0]['tx'] = $hour[0]['tx'];

            $sum[1]['act'] = 1;
            $sum[1]['label'] = T('This day');
            $sum[1]['rx'] = $day[0]['rx'];
            $sum[1]['tx'] = $day[0]['tx'];

            $sum[2]['act'] = 1;
            $sum[2]['label'] = T('This month');
            $sum[2]['rx'] = $month[0]['rx'];
            $sum[2]['tx'] = $month[0]['tx'];

            $sum[3]['act'] = 1;
            $sum[3]['label'] = T('All time');
            $sum[3]['rx'] = $trx;
            $sum[3]['tx'] = $ttx;
        }

        write_data_table(T('Summary'), $sum);
        print "<br/>\n";
        write_data_table(T('Top 10 days'), $top);
    }


    function write_data_table($caption, $tab)
    {
        print "<table width=\"100%\" cellspacing=\"0\">\n";
        print "<caption>$caption</caption>\n";
        print "<tr>";
        print "<th class=\"label\" style=\"width:120px;\">&nbsp;</th>";
        print "<th class=\"label\">".T('In')."</th>";
        print "<th class=\"label\">".T('Out')."</th>";
        print "<th class=\"label\">".T('Total')."</th>";
        print "</tr>\n";

        for ($i=0; $i<count($tab); $i++)
        {
            if ($tab[$i]['act'] == 1)
            {
                $t = $tab[$i]['label'];
                $rx = kbytes_to_string($tab[$i]['rx']);
                $tx = kbytes_to_string($tab[$i]['tx']);
                $total = kbytes_to_string($tab[$i]['rx']+$tab[$i]['tx']);
                $id = ($i & 1) ? 'odd' : 'even';
                print "<tr>";
                print "<td class=\"label_$id\">$t</td>";
                print "<td class=\"numeric_$id\">$rx</td>";
                print "<td class=\"numeric_$id\">$tx</td>";
                print "<td class=\"numeric_$id\">$total</td>";
                print "</tr>\n";
             }
        }
        print "</table>\n";
    }

    get_vnstat_data();

    //
    // html start
    //
    header('Content-type: text/html; charset=utf-8');
    print '<?xml version="1.0"?>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>vnStat - PHP frontend</title>
  <link rel="stylesheet" type="text/css" href="themes/<?php echo $style ?>/style.css"/>
</head>
<body>

<div id="wrap">
   <div id="content">
    <div id="header"><?php echo $iface;?></div>
    <div id="main">
    <?php
    $graph_params = "if=$iface&amp;page=$page&amp;style=$style";
    if ($page != 's')
        if ($graph_format == 'svg') {
	     print "<object type=\"image/svg+xml\" width=\"692\" height=\"297\" data=\"graph_svg.php?$graph_params\"></object>\n";
        } else {
	     print "<img src=\"graph.php?$graph_params\" alt=\"graph\"/>\n";
        }

    if ($page == 's')
    {
        write_summary();
    }
    else if ($page == 'h')
    {
        write_data_table(T('Last 24 hours'), $hour);
    }
    else if ($page == 'd')
    {
        write_data_table(T('Last 30 days'), $day);
    }
    else if ($page == 'm')
    {
        write_data_table(T('Last 12 months'), $month);
    }
    ?>
    </div>
  </div>
</div>

</body></html>
