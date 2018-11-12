<?php

/* AppBundle:themes/default/Admin/Default:dashboard.html.twig */
class __TwigTemplate_ecbaf787885513d0592131502c860b90e4e240270cb5192aaa5fcad968df06c4 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/base-admin:base.html.twig", "AppBundle:themes/default/Admin/Default:dashboard.html.twig", 1);
        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'body_parent' => array($this, 'block_body_parent'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle:themes/default/base-admin:base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_page_title($context, array $blocks = array())
    {
        echo "Dashboard";
    }

    // line 5
    public function block_body_parent($context, array $blocks = array())
    {
        // line 6
        echo "   
    <div class=\"row\">
        <div class=\"col-lg-10\">
            <form style=\"float:right; min-width:180px;\" action=\"#\" metoth=\"POST\">
                <select id=\"refreshIntervalLines\" class=\"form-control select2\" aria-required=\"true\">
                    <option value=\"Last 30 days\" selected=\"selected\">Last 30 days</option>
                    <option value=\"Last month\">Last month</option>
                    <option value=\"Last year\">Last year</option>
                </select>
            </form>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-10 col-lg-10\">
            <div class=\"chart-widget frappe-chart\">
                <h3 style=\"text-align:center;\">Lines Statistics for <span id=\"period-lines\">Last 30 days</span></h3>
                <canvas id=\"linesChart\" style=\"max-height:100%\"></canvas>
            </div>
        </div>
    </div>

    <div class=\"row\">
        <div class=\"col-lg-10\">
            <form style=\"float:right; min-width:180px;\" action=\"#\" metoth=\"POST\">
                <select id=\"refreshIntervalCredits\" class=\"form-control select2\" aria-required=\"true\">
                    <option value=\"Last 30 days\" selected=\"selected\" >Last 30 days</option>
                    <option value=\"Last month\">Last month</option>
                    <option value=\"Last year\">Last year</option>
                </select>
            </form>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-md-10 col-lg-10\">
            <div class=\"chart-widget frappe-chart\">
                <h3 style=\"text-align:center;\">Credits Statistics for <span id=\"period-credits\">Last 30 days</span></h3>
                <canvas id=\"creditsChart\" style=\"max-height:100%\"></canvas>
            </div>
        </div>
    </div>
";
    }

    // line 48
    public function block_javascripts($context, array $blocks = array())
    {
        // line 49
        echo " <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/chart.js"), "html", null, true);
        echo "\"></script>

 <script type=\"text/javascript\">
        var linesChart;
        var creditsChart;

        \$(document).ready(function () {
            \$(\"#refreshIntervalLines\").on({
                change: function () {
                    \$('#period-lines').html(\$(this).val());
                    linesChart.data.datasets[0].label = \$(this).val();

                    periodLines();
                }
            });

            \$(\"#refreshIntervalCredits\").on({
                change: function () {
                    \$('#period-credits').html(\$(this).val());
                    
                    creditsChart.data.datasets[0].label = \$(this).val();

                    creditsChart.update();
                }
            });

            var initLinesChart = function(){
                var data =  [
                    '";
        // line 77
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "total", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "premium", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "trial", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "expired", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "mag", array()), 1, array(), "array"), "html", null, true);
        echo "',
                    '";
        // line 78
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "enigma2", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "'
                ];

                linesChart = new Chart(\$(\"#linesChart\"), {
                    type: 'bar',
                    data: {
                        labels: [
                            \"";
        // line 85
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.total_lines"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.premium"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.trial"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.expired"), "html", null, true);
        echo "\",
                            \"";
        // line 86
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.mag"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.enigma2"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.assigned"), "html", null, true);
        echo "\"
                        ],
                        datasets: [{
                            label: 'Last 30 days',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(0, 0, 255, 0.2)',
                                'rgba(20, 100, 1, 0.2)',
                                'rgba(255, 255, 100, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 2, 255, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 235, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            };

            var initCreditsChart = function(){
                var data =  [
                    '";
        // line 126
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "total", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "premium", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "trial", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "expired", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "mag", array()), 1, array(), "array"), "html", null, true);
        echo "',
                    '";
        // line 127
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "enigma2", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "', '";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "',
                    '";
        // line 128
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["linesStatistic"] ?? null), "assigned", array()), 1, array(), "array"), "html", null, true);
        echo "'
                ];

                creditsChart = new Chart(\$(\"#creditsChart\"), {
                    type: 'bar',
                    data: {
                        labels: [
                            \"";
        // line 135
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.total_payments"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.total_bonus"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.bitcoins"), "html", null, true);
        echo "\", 
                            \"";
        // line 136
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.card"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.redeem"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.new_lines"), "html", null, true);
        echo "\", 
                            \"";
        // line 137
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.extending_lines"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.additionals_connections"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.new_reseller_fees"), "html", null, true);
        echo "\",
                            \"";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.refund_from_reseller"), "html", null, true);
        echo "\", \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.dashboard.add_to_resellers"), "html", null, true);
        echo "\"
                        ],
                        datasets: [{
                            label: 'Last 30 days',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 0, 0, 0.2)',
                                'rgba(0, 255, 0, 0.2)',
                                'rgba(0, 0, 255, 0.2)',
                                'rgba(20, 100, 1, 0.2)',
                                'rgba(255, 255, 100, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(20, 20, 255, 0.2)',
                                'rgba(10, 200, 255, 0.2)',
                                'rgba(25, 80, 60, 0.2)',
                                'rgba(255, 0, 45, 0.2)',
                                'rgba(100, 20, 0, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 159, 235, 1)',
                                'rgba(255, 159, 235, 1)',
                                'rgba(255, 159, 235, 1)',
                                'rgba(255, 159, 235, 1)',
                                'rgba(255, 159, 235, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            };

            initLinesChart();
            initCreditsChart();
        });

        function periodLines(){
            \$.ajax({
                url: \"";
        // line 190
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_dashboard_ajax");
        echo "\",
                type: 'POST',
                data: {
                    period: \$('#refreshIntervalLines')[0].selectedIndex
                },
                dataType: \"json\"
            }).done(function(respnse){
                datas = respnse.data;
                dataLines = datas.linesStatistic;

                linesChart.data.datasets[0].data[0] = dataLines.total[1];
                linesChart.data.datasets[0].data[1] = dataLines.premium[1];
                linesChart.data.datasets[0].data[2] = dataLines.trial[1];
                linesChart.data.datasets[0].data[3] = dataLines.expired[1];
                linesChart.data.datasets[0].data[4] = dataLines.mag[1];
                linesChart.data.datasets[0].data[5] = dataLines.enigma2[1];
                linesChart.data.datasets[0].data[6] = dataLines.assigned[1];

                linesChart.update();
            });
        }

        function periodCredits(){
            \$.ajax({
                url: \"";
        // line 214
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_dashboard_ajax");
        echo "\",
                type: 'POST',
                data: {
                    period: \$('#refreshIntervalLines')[0].selectedIndex
                },
                dataType: \"json\"
            }).done(function(respnse){
                datas = respnse.data;
                dataLines = datas.linesStatistic;

                linesChart.data.datasets[0].data[0] = dataLines.total[1];
                linesChart.data.datasets[0].data[1] = dataLines.premium[1];
                linesChart.data.datasets[0].data[2] = dataLines.trial[1];
                linesChart.data.datasets[0].data[3] = dataLines.expired[1];
                linesChart.data.datasets[0].data[4] = dataLines.mag[1];
                linesChart.data.datasets[0].data[5] = dataLines.enigma2[1];
                linesChart.data.datasets[0].data[6] = dataLines.assigned[1];

                linesChart.update();
            });
        }
    </script>

";
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default/Admin/Default:dashboard.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  341 => 214,  314 => 190,  257 => 138,  249 => 137,  241 => 136,  233 => 135,  223 => 128,  211 => 127,  199 => 126,  152 => 86,  142 => 85,  130 => 78,  118 => 77,  86 => 49,  83 => 48,  39 => 6,  36 => 5,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/Admin/Default:dashboard.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/Admin/Default/dashboard.html.twig");
    }
}
