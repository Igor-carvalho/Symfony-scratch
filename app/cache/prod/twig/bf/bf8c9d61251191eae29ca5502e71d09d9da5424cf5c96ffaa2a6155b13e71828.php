<?php

/* @App/themes/default/Admin/User/login.html.twig */
class __TwigTemplate_234fe78ed269def6f120186dab347ea0aab07794bc27939bec3e9be1a35acc1b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/Admin/User:base.html.twig", "@App/themes/default/Admin/User/login.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle:themes/default/Admin/User:base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 5
            echo "        <div class=\"alert alert-danger text-center\" style=\"padding-top: 0px; padding-bottom: 0px;\">
\t\t\t<span>
\t\t\t\t";
            // line 7
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "message", array()), "html", null, true);
            echo "
\t\t\t</span>
        </div>
    ";
        }
        // line 11
        echo "    <div class=\"logo\">
        <a href=\"";
        // line 12
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("home");
        echo "\">
            <h1 style=\"color: white;font-weight: 400\">
                ";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getProjectName(), "html", null, true);
        echo "
            </h1>
        </a>
    </div>
    <div class=\"content\" style=\"margin-bottom: 25px\">
        <!-- BEGIN LOGIN FORM -->
        <form class=\"login-form\"  action=\"";
        // line 20
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_check");
        echo "\" method=\"POST\" >
            <h3 class=\"form-title\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.login.login_to_your_account", array(), "messages"), "html", null, true);
        echo "</h3>
            <div class=\"alert alert-danger display-hide\">
                <button class=\"close\" data-close=\"alert\"></button>
\t\t\t<span>
\t\t\t\t";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.login.enter_username_and_pass", array(), "messages"), "html", null, true);
        echo "
\t\t\t</span>
            </div>
            <div class=\"form-group\">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class=\"control-label visible-ie8 visible-ie9\">";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.login.username", array(), "messages"), "html", null, true);
        echo "</label>
                <div class=\"input-icon\">
                    <i class=\"fa fa-user\" style=\"color: white\"></i>
                    <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 33
        echo twig_escape_filter($this->env, (isset($context["last_username"]) ? $context["last_username"] : null), "html", null, true);
        echo "\" class=\"form-control\" placeholder=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.username"), "html", null, true);
        echo "\" required/>
                </div>
            </div>
            <div class=\"form-group\">
                <label class=\"control-label visible-ie8 visible-ie9\">";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.login.password", array(), "messages"), "html", null, true);
        echo "</label>
                <div class=\"input-icon\">
                    <i class=\"fa fa-lock\" style=\"color: white\"></i>
                    <input class=\"form-control placeholder-no-fix\" type=\"password\" autocomplete=\"off\" required placeholder=\"";
        // line 40
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.password"), "html", null, true);
        echo "\" name=\"_password\"/>
                </div>
            </div>
            <div class=\"form-actions\" style=\"padding-left: 50px;\">
                <label class=\"checkbox\">
                    <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" style=\"margin-right: 7px;float: left\">
                    ";
        // line 46
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.remember"), "html", null, true);
        echo "
                </label>
                <button type=\"submit\" id=\"_submit\"  name=\"_submit\" class=\"btn blue pull-right\">
                    ";
        // line 49
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.submit"), "html", null, true);
        echo " <i class=\"m-icon-swapright m-icon-white\"></i>
                </button>
            </div>
            ";
        // line 64
        echo "            ";
        if ($this->getAttribute($this->getAttribute((isset($context["config_service"]) ? $context["config_service"] : null), "getGeneralConfig", array(), "method"), "allowRegistration", array())) {
            // line 65
            echo "                ";
            // line 75
            echo "            ";
        }
        // line 76
        echo "            ";
        // line 77
        echo "        </form>
    </div>

";
    }

    public function getTemplateName()
    {
        return "@App/themes/default/Admin/User/login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 77,  131 => 76,  128 => 75,  126 => 65,  123 => 64,  117 => 49,  111 => 46,  102 => 40,  96 => 37,  87 => 33,  81 => 30,  73 => 25,  66 => 21,  62 => 20,  53 => 14,  48 => 12,  45 => 11,  38 => 7,  34 => 5,  31 => 4,  28 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@App/themes/default/Admin/User/login.html.twig", "/home/developer/xtreamcode/src/Dmcl/AppBundle/Resources/views/themes/default/Admin/User/login.html.twig");
    }
}
