<?php

/* AppBundle:themes/default/base-admin:sidebar.html.twig */
class __TwigTemplate_3b842544b957e4ed8b0f5876729b9a38c1a4c3ceee009df5084ad436c1bb01db extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"sidebar-section\">
    <div class=\"sidebar-section__scroll\">
        <div>
            <div class=\"sidebar-user-a\">
                <div class=\"sidebar__user-avatar\">
                    <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())) ? ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(("uploads/" . $this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())))) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/dist/img/user.png"))), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "\" width=\"68\" height=\"68\" class=\"rounded-circle\">
                </div>
                <div class=\"dropdown sidebar__user-dropdown\">
                    <a class=\"dropdown-toggle\" href=\"#\" role=\"button\" id=\"dropdownMenuLink\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        ";
        // line 10
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "
                    </a>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuLink\">
                        <a class=\"dropdown-item\" href=\"";
        // line 13
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_logout");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.top_navbar.sign_out"), "html", null, true);
        echo "</a>
                    </div>
                </div>
            </div>
            <ul class=\"sidebar-section-nav\">
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.dashboard"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link\" href=\"";
        // line 19
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("app_dashboard");
        echo "\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-home\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.dashboard"), "html", null, true);
        echo "</span>
                    </a>
                </li>
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.clients"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link sidebar-section-nav__link-dropdown\" href=\"#\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-circle-check\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.clients"), "html", null, true);
        echo "</span>
                    </a>
                    <ul class=\"sidebar-section-subnav\">
                        <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
        // line 30
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("line");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.clients.manage_lines"), "html", null, true);
        echo "</a></li>
                        <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
        // line 31
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.clients.manage_users"), "html", null, true);
        echo "</a></li>
                        ";
        // line 33
        echo "                    </ul>
                </li>
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 35
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.resellers"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link\" href=\"";
        // line 36
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_resellers");
        echo "\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-group\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.resellers"), "html", null, true);
        echo "</span>
                    </a>
                </li>
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 41
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.wallet"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link sidebar-section-nav__link-dropdown\" href=\"#\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-wallet\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 44
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.wallet"), "html", null, true);
        echo "</span>
                    </a>
                    <ul class=\"sidebar-section-subnav\">
                        ";
        // line 47
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 48
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("billing-configuration");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.config"), "html", null, true);
            echo "</a></li>
                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            // line 49
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("gateways");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.gateways"), "html", null, true);
            echo "</a></li>
                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            // line 50
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("packages");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.packages"), "html", null, true);
            echo "</a></li>
                        ";
        }
        // line 52
        echo "                        <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("products");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.products"), "html", null, true);
        echo "</a></li>
                        ";
        // line 53
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 54
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("billing_orders");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.orders"), "html", null, true);
            echo "</a></li>
                        ";
        } else {
            // line 56
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("billing_customer_orders");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.billing.orders"), "html", null, true);
            echo "</a></li>
                        ";
        }
        // line 58
        echo "                    </ul>
                </li>
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.channels"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link sidebar-section-nav__link-dropdown\" href=\"#\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-video\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 63
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.channels"), "html", null, true);
        echo "</span>
                    </a>
                    <ul class=\"sidebar-section-subnav\">
                        ";
        // line 66
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 67
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.channels"), "html", null, true);
            echo "</a></li>
                        ";
        } else {
            // line 69
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams_report");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.channel.new_report"), "html", null, true);
            echo "</a></li>
                        ";
        }
        // line 71
        echo "                        ";
        if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 72
            echo "                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams_reports");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.channel.recent_reports"), "html", null, true);
            echo "</a></li>
                        ";
        }
        // line 74
        echo "                        <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("epg");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.channel.epg"), "html", null, true);
        echo "</a></li>
                        ";
        // line 76
        echo "                    </ul>
                </li>
                <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
        // line 78
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.logs"), "html", null, true);
        echo "\" data-tippy-placement=\"right\">
                    <a class=\"sidebar-section-nav__link\" href=\"";
        // line 79
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("logs");
        echo "\">
                        <span class=\"sidebar-section-nav__item-icon ua-icon-pages\"></span>
                        <span class=\"sidebar-section-nav__item-text\">";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.logs"), "html", null, true);
        echo "</span>
                    </a>
                </li>
                ";
        // line 84
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 85
            echo "                    <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.support"), "html", null, true);
            echo "\" data-tippy-placement=\"right\">
                        <a class=\"sidebar-section-nav__link sidebar-section-nav__link-dropdown\" href=\"#\">
                            <span class=\"sidebar-section-nav__item-icon ua-icon-ticket\"></span>
                            <span class=\"sidebar-section-nav__item-text\">";
            // line 88
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.support"), "html", null, true);
            echo "</span>
                        </a>
                        <ul class=\"sidebar-section-subnav\">
                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            // line 91
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("tickets");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.tickets"), "html", null, true);
            echo "</a></li>
                            <li class=\"sidebar-section-subnav__item\"><a class=\"sidebar-section-subnav__link\" href=\"";
            // line 92
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("technical_issues");
            echo "\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.technical_issues"), "html", null, true);
            echo "</a></li>
                        </ul>
                    </li>
                ";
        }
        // line 96
        echo "
                ";
        // line 97
        if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 98
            echo "                    <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.tickets"), "html", null, true);
            echo "\" data-tippy-placement=\"right\">
                        <a class=\"sidebar-section-nav__link\" href=\"";
            // line 99
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("tickets");
            echo "\">
                            <span class=\"sidebar-section-nav__item-icon ua-icon-ticket\"></span>
                            <span class=\"sidebar-section-nav__item-text\">";
            // line 101
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.tickets"), "html", null, true);
            echo "</span>
                        </a>
                    </li>
                ";
        }
        // line 105
        echo "                ";
        // line 111
        echo "                ";
        if ($this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 112
            echo "                    <li class=\"sidebar-section-nav__item\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.general_settings"), "html", null, true);
            echo "\" data-tippy-placement=\"right\">
                        <a class=\"sidebar-section-nav__link\" href=\"";
            // line 113
            echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("settings");
            echo "\">
                            <span class=\"sidebar-section-nav__item-icon ua-icon-settings\"></span>
                            <span class=\"sidebar-section-nav__item-text\">";
            // line 115
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.general_settings"), "html", null, true);
            echo "</span>
                        </a>
                    </li>
                ";
        }
        // line 119
        echo "            </ul>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default/base-admin:sidebar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  313 => 119,  306 => 115,  301 => 113,  296 => 112,  293 => 111,  291 => 105,  284 => 101,  279 => 99,  274 => 98,  272 => 97,  269 => 96,  260 => 92,  254 => 91,  248 => 88,  241 => 85,  239 => 84,  233 => 81,  228 => 79,  224 => 78,  220 => 76,  213 => 74,  205 => 72,  202 => 71,  194 => 69,  186 => 67,  184 => 66,  178 => 63,  172 => 60,  168 => 58,  160 => 56,  152 => 54,  150 => 53,  143 => 52,  136 => 50,  130 => 49,  123 => 48,  121 => 47,  115 => 44,  109 => 41,  103 => 38,  98 => 36,  94 => 35,  90 => 33,  84 => 31,  78 => 30,  72 => 27,  66 => 24,  60 => 21,  55 => 19,  51 => 18,  41 => 13,  35 => 10,  26 => 6,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/base-admin:sidebar.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/base-admin/sidebar.html.twig");
    }
}
