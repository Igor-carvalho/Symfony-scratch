<?php

/* @App/themes/default/Admin/Products/index.html.twig */
class __TwigTemplate_98b864a293da2d52fc82e5b4071ba9358ce3f5f1a214ce5f19f2a5fa70009645 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/base-admin:base.html.twig", "@App/themes/default/Admin/Products/index.html.twig", 1);
        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'javascripts' => array($this, 'block_javascripts'),
            'vars' => array($this, 'block_vars'),
            'body_parent' => array($this, 'block_body_parent'),
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

    // line 2
    public function block_page_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.index.title"), "html", null, true);
    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 5
        echo " ";
    }

    // line 7
    public function block_javascripts($context, array $blocks = array())
    {
        // line 8
        echo "     <script text=\"javascript\">
       \$(document).ready(function(){
           \$('.switch input[class=\"sp\"]').click(function(e) {
                var \$this = \$(this);

                \$.ajax({
                    type: \"POST\",
                    url: \$this.data('href'),
                    dataType: \"json\",
                    data: {},
                    success: function(response) {
                       
                    },
                    error: function(response) {

                    }
                }).done(function(response) {
                        if (response.type == 1) {
                            if(response.status){
                                if(response.change){
                                    \$('#card-widget-'+\$this.data('id')).prop('style', 'background-color:#0e84dc;');
                                }
                                else{
                                    \$('#card-widget-'+\$this.data('id')).prop('style', 'background-color:#4caf50;');
                                } 
                            }                   
                        } 
                    });
            });

           \$('.switch input[class=\"status\"]').click(function(e) {
                var \$this = \$(this);

                \$.ajax({
                    type: \"POST\",
                    url: \$this.data('href'),
                    dataType: \"json\",
                    data: {},
                    success: function(response) {
                       
                    },
                    error: function(response) {

                    }
                }).done(function(response) {
                        if (response.type == 1) {
                            if(response.change){
                                if(response.sp)
                                    \$('#card-widget-'+\$this.data('id')).prop('style', 'background-color:#0e84dc;');
                                else
                                    \$('#card-widget-'+\$this.data('id')).prop('style', 'background-color:#4caf50;');
                            }
                            else{
                                \$('#card-widget-'+\$this.data('id')).prop('style', 'background-color:#939daa;');
                            }                    
                        } 
                    });
            });
       });
     </script>
 ";
    }

    // line 70
    public function block_vars($context, array $blocks = array())
    {
        // line 71
        echo "    var msgDelete = \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.msg_delete"), "html", null, true);
        echo "\";
";
    }

    // line 74
    public function block_body_parent($context, array $blocks = array())
    {
        // line 75
        echo "    ";
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 76
            echo "        <div class=\"row mb-2\">
            <div class=\"col-md-12\">
                <a class=\"btn btn-primary btn-md pull-right\" href=\"";
            // line 78
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_new");
            echo "\">
                    ";
            // line 79
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.add_package"), "html", null, true);
            echo "
                </a>
            </div>
        </div>
    ";
        }
        // line 84
        echo "    <div class=\"row\">
            ";
        // line 85
        if ((twig_length_filter($this->env, ($context["entities"] ?? null)) > 0)) {
            // line 86
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["entities"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["entity"]) {
                // line 87
                echo "                    <div class=\"col-sm-12 col-md-4 col-lg-2\">
                        <div class=\"card-widget card-widget-b\" style=\"max-width:250px;\">
                            ";
                // line 89
                $context["color"] = "#939daa;";
                // line 90
                echo "
                            ";
                // line 91
                if ($this->getAttribute($context["entity"], "status", array())) {
                    // line 92
                    echo "                                ";
                    if ($this->getAttribute($context["entity"], "superReseller", array())) {
                        // line 93
                        echo "                                    ";
                        $context["color"] = "#0e84dc;";
                        // line 94
                        echo "                                ";
                    } else {
                        // line 95
                        echo "                                    ";
                        $context["color"] = "#4caf50;";
                        // line 96
                        echo "                                ";
                    }
                    // line 97
                    echo "                            ";
                }
                // line 98
                echo "                            
                            <div id=\"card-widget-";
                // line 99
                echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
                echo "\" class=\"card-widget-l__user\" style=\"background-color: ";
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\">
                                <a class=\"card-widget-l__user-avatar\">
                                    <img src=\"../../../uploads/";
                // line 101
                echo twig_escape_filter($this->env, (($this->getAttribute($context["entity"], "logo", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($context["entity"], "logo", array()), "channel-logo.png")) : ("channel-logo.png")), "html", null, true);
                echo "\" alt=\"\" class=\"card-widget-l__user-image rounded-circle\">
                                </a>
                                <div class=\"card-widget-l__user-info\">
                                    <a class=\"card-widget-l__user-name\">";
                // line 104
                echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "name", array()), "html", null, true);
                echo "</a>
                                    <a class=\"card-widget-l__user-desc\">";
                // line 105
                echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "period", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("months"), "html", null, true);
                echo "</a>
                                </div>
                                ";
                // line 107
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                    // line 108
                    echo "                                    <div class=\"card-widget-b__controls\">
                                        <div class=\"dropdown\">
                                            <span data-toggle=\"dropdown\" aria-expanded=\"false\">
                                                <span class=\"ua-icon-dots-h-alt card-widget-b__control\"></span>
                                            </span>
                                            <div class=\"dropdown-menu dropdown-menu-right\" x-placement=\"bottom-end\" style=\"position: absolute; transform: translate3d(-144px, 21px, 0px); top: 0px; left: 0px; will-change: transform;\">
                                                <a class=\"dropdown-item\" href=\"";
                    // line 114
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_edit", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.index.edit"), "html", null, true);
                    echo "</a>
                                                <a data-href=\"";
                    // line 115
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_delete", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
                    echo "\" class=\"delete dropdown-item\" href=\"\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.delete"), "html", null, true);
                    echo "</a>
                                            </div>
                                        </div>
                                    </div>
                                ";
                }
                // line 120
                echo "                            </div>
                            <ul class=\"card-widget-l__stats\">
                                <li class=\"card-widget-l__stats-item\">
                                    <span class=\"card-widget-l__stats-title\">";
                // line 123
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.credits"), "html", null, true);
                echo "</span>
                                    <span class=\"card-widget-l__stats-value color-info\">";
                // line 124
                echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "credits", array()), "html", null, true);
                echo "</span>
                                </li>
                                <li class=\"card-widget-l__stats-item\">
                                    <span class=\"card-widget-l__stats-title\">";
                // line 127
                echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.price"), "html", null, true);
                echo "</span>
                                    <span class=\"card-widget-l__stats-value color-success\">";
                // line 128
                echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "price", array()), "html", null, true);
                echo "</span>
                                </li>
                                ";
                // line 130
                if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                    // line 131
                    echo "                                    <li class=\"card-widget-l__stats-item\">
                                        <span class=\"card-widget-l__stats-title\">";
                    // line 132
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.superReseller"), "html", null, true);
                    echo "</span>
                                        <label class=\"switch switch--sm\">
                                            <input class=\"sp\" id=\"sp\" data-id=\"";
                    // line 134
                    echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
                    echo "\" data-href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_change_super_reseller", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
                    echo "\" ";
                    if ($this->getAttribute($context["entity"], "superReseller", array())) {
                        echo "checked=\"\"";
                    }
                    echo " type=\"checkbox\">
                                            <span class=\"switch-slider\"></span>
                                        </label>
                                    </li>
                                    <li class=\"card-widget-l__stats-item\">
                                        <span class=\"card-widget-l__stats-title\">";
                    // line 139
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.status"), "html", null, true);
                    echo "</span>
                                        <label class=\"switch switch--sm\">
                                            <input class=\"status\" id=\"status\" data-id=\"";
                    // line 141
                    echo twig_escape_filter($this->env, $this->getAttribute($context["entity"], "id", array()), "html", null, true);
                    echo "\" data-href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_change_status", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
                    echo "\" ";
                    if ($this->getAttribute($context["entity"], "superReseller", array())) {
                        echo "checked=\"\"";
                    }
                    echo " type=\"checkbox\">
                                            <span class=\"switch-slider\"></span>
                                        </label>
                                    </li>
                                ";
                }
                // line 146
                echo "                            </ul>
                            ";
                // line 147
                if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
                    // line 148
                    echo "                                <div class=\"card-widget-m__controls\">
                                    <a class=\"card-widget-m__control\">
                                        <span class=\"ua-icon-cart card-widget-m__control-icon\"></span>
                                    </a>
                                    <a href=\"";
                    // line 152
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products_cart", array("id" => $this->getAttribute($context["entity"], "id", array()))), "html", null, true);
                    echo "\" class=\"card-widget-m__control\">
                                        <span class=\"card-widget-m__control-text\">";
                    // line 153
                    echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.order"), "html", null, true);
                    echo "</span>
                                    </a>
                                </div>
                            ";
                }
                // line 157
                echo "                        </div>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['entity'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 160
            echo "            ";
        } else {
            // line 161
            echo "                <div class=\"col-sm-12\">
                    <h4 class=\"text-muted text-center\">";
            // line 162
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.products.no_products"), "html", null, true);
            echo "</h4>
                </div>
            ";
        }
        // line 165
        echo "    </div>
";
    }

    public function getTemplateName()
    {
        return "@App/themes/default/Admin/Products/index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  345 => 165,  339 => 162,  336 => 161,  333 => 160,  325 => 157,  318 => 153,  314 => 152,  308 => 148,  306 => 147,  303 => 146,  289 => 141,  284 => 139,  270 => 134,  265 => 132,  262 => 131,  260 => 130,  255 => 128,  251 => 127,  245 => 124,  241 => 123,  236 => 120,  226 => 115,  220 => 114,  212 => 108,  210 => 107,  203 => 105,  199 => 104,  193 => 101,  186 => 99,  183 => 98,  180 => 97,  177 => 96,  174 => 95,  171 => 94,  168 => 93,  165 => 92,  163 => 91,  160 => 90,  158 => 89,  154 => 87,  149 => 86,  147 => 85,  144 => 84,  136 => 79,  132 => 78,  128 => 76,  125 => 75,  122 => 74,  115 => 71,  112 => 70,  48 => 8,  45 => 7,  41 => 5,  38 => 4,  32 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@App/themes/default/Admin/Products/index.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle\\Resources\\views\\themes\\default\\Admin\\Products\\index.html.twig");
    }
}
