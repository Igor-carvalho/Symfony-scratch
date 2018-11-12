<?php

/* AppBundle:themes/default/base-admin:top-navbar.html.twig */
class __TwigTemplate_4929f1312a8d88cb9ed6694a7977f7aab7763d049a8ce608c841e9b7a0ca6ceb extends Twig_Template
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
        echo "<div class=\"navbar navbar-light navbar-expand-lg\">
    <button class=\"sidebar-toggler\" type=\"button\">
        <span class=\"ua-icon-sidebar-open sidebar-toggler__open\"></span>
        <span class=\"ua-icon-alert-close sidebar-toggler__close\"></span>
    </button>

    <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbar-collapse\">
        <span class=\"ua-icon-navbar-open navbar-toggler__open\"></span>
        <span class=\"ua-icon-alert-close navbar-toggler__close\"></span>
    </button>

    <div class=\"collapse navbar-collapse\" id=\"navbar-collapse\">
        <div class=\"navbar__menu\">
            <ul class=\"navbar-nav\">
                <li>
                    ";
        // line 16
        if ( !$this->env->getExtension('Symfony\Bridge\Twig\Extension\SecurityExtension')->isGranted("ROLE_ADMIN")) {
            // line 17
            echo "                        ";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("current_balance"), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "credits", array()), "html", null, true);
            echo "
                    ";
        }
        // line 19
        echo "                </li>
            </ul>
            <div class=\"navbar__menu-side\">
            </div>
        </div>

        <div class=\"dropdown navbar-dropdown no-arrow navbar-notify-dropdown navbar-notify-dropdown--messages\">
            <a class=\"dropdown-toggle navbar-dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" role=\"button\" aria-haspopup=\"true\" aria-expanded=\"false\">
                <span class=\"navbar-notify\">
                    <span>
                        <span class=\"navbar-notify__icon mdi mdi-email\"></span>
                        <span class=\"navbar-notify__text\">Messages</span>
                    </span>
                    <span class=\"hidden navbar-notify__indicator\"></span>
                    ";
        // line 34
        echo "                </span>
            </a>
            <div class=\"dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-notifications navbar-dropdown-messages\">
                <div class=\"navbar-dropdown-notifications__header\"><span>MESSAGES</span>
                    ";
        // line 41
        echo "                </div>

                <div id=\"notifications\" class=\"navbar-dropdown-notifications__body navbar-dropdown-notifications__body-messages js-scrollable\">
                </div>
                    
                <a class=\"navbar-dropdown-notifications__view-all\" href=\"";
        // line 46
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("tickets");
        echo "\"><span class=\"icon ua-icon-view-all\"></span><span>View all</span></a>
            </div>
        </div>
    
        <div class=\"dropdown navbar-dropdown\">
            <a class=\"dropdown-toggle navbar-dropdown-toggle navbar-dropdown-toggle__user\" data-toggle=\"dropdown\" href=\"#\">
                <img src=\"";
        // line 52
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())) ? ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(("uploads/" . $this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())))) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/dist/img/user.png"))), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "\" class=\"navbar-dropdown-toggle__user-avatar\">
                <span class=\"navbar-dropdown__user-name\">";
        // line 53
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "</span>
            </a>
            <div class=\"dropdown-menu navbar-dropdown-menu navbar-dropdown-menu__user\">
                <div class=\"navbar-dropdown-user-content mb-0\" >
                    <div class=\"dropdown-user__avatar\"><img src=\"";
        // line 57
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())) ? ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl(("uploads/" . $this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array()), "avatar", array())))) : ($this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/dist/img/user.png"))), "html", null, true);
        echo "\" alt=\"";
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "name", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "\"/>
                    </div>
                    <div class=\"dropdown-info\">
                        <div class=\"dropdown-info__name\">";
        // line 60
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "username", array()), "Anonymous")) : ("Anonymous")), "html", null, true);
        echo "</div>
                        <div class=\"dropdown-info-buttons\">
                            ";
        // line 62
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "email", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute(($context["app"] ?? null), "user", array(), "any", false, true), "email", array()), "Email")) : ("Email")), "html", null, true);
        echo "
                        </div>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col-md-6 center\">
                        <a class=\"dropdown-item navbar-dropdown__item color-danger\" href=\"";
        // line 68
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_logout");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.top_navbar.sign_out"), "html", null, true);
        echo "</a>
                    </div>
                    <div class=\"col-md-6 center\">
                        <a class=\"dropdown-item navbar-dropdown__item  color-info\" href=\"";
        // line 71
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_profile");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.top_navbar.profile"), "html", null, true);
        echo "</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default/base-admin:top-navbar.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 71,  119 => 68,  110 => 62,  105 => 60,  97 => 57,  90 => 53,  84 => 52,  75 => 46,  68 => 41,  62 => 34,  46 => 19,  38 => 17,  36 => 16,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/base-admin:top-navbar.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/base-admin/top-navbar.html.twig");
    }
}
