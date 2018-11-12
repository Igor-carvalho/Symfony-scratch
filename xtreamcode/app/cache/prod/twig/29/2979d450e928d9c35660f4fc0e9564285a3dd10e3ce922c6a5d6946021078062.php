<?php

/* @App/themes/default/Admin/Products/cart.html.twig */
class __TwigTemplate_9928923bb7543c06768a9e1d1d67631c7228ba04ee97abe51dd68c26739e8aed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/base-admin:base.html.twig", "@App/themes/default/Admin/Products/cart.html.twig", 1);
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
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.cart.title"), "html", null, true);
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
       });
     </script>
 ";
    }

    // line 14
    public function block_vars($context, array $blocks = array())
    {
    }

    // line 17
    public function block_body_parent($context, array $blocks = array())
    {
        // line 18
        echo "    <div class=\"row mb-2\">
        <div class=\"col-sm-4 col-md-8 col-lg-6 offset-md-2 offset-lg-3\">
            <div class=\"main-container table-container\">
                <table class=\"table table-no-border\">
                    <thead>
                        ";
        // line 23
        $context["color"] = "#4caf50;";
        // line 24
        echo "
                        ";
        // line 25
        if ($this->getAttribute(($context["package"] ?? null), "superReseller", array())) {
            // line 26
            echo "                            ";
            $context["color"] = "#0e84dc;";
            // line 27
            echo "                        ";
        }
        // line 28
        echo "                        
                        <tr style=\"background-color:";
        // line 29
        echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
        echo "\">
                            <th style=\"color:black; text-align:left;\">";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.name"), "html", null, true);
        echo "</th>
                            <th style=\"color:black; text-align:left;\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.superReseller"), "html", null, true);
        echo "</th>
                            <th style=\"color:black; text-align:left;\">";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.credits"), "html", null, true);
        echo "</th>
                            <th style=\"color:black; text-align:left;\">";
        // line 33
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.price"), "html", null, true);
        echo "</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style=\"text-align:left;\">
                            <td class=\"table__avatar\">
                                <img src=\"../../../../uploads/";
        // line 39
        echo twig_escape_filter($this->env, (($this->getAttribute(($context["package"] ?? null), "logo", array(), "any", true, true)) ? (_twig_default_filter($this->getAttribute(($context["package"] ?? null), "logo", array()), "channel-logo.png")) : ("channel-logo.png")), "html", null, true);
        echo "\" alt=\"\" class=\"rounded-circle\" width=\"34\" height=\"34\">
                                <span>";
        // line 40
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "name", array()), "html", null, true);
        echo "</span>
                            </td>
                            <td>
                               ";
        // line 43
        if ($this->getAttribute(($context["package"] ?? null), "superReseller", array())) {
            // line 44
            echo "                                    Yes
                               ";
        } else {
            // line 46
            echo "                                    No
                               ";
        }
        // line 48
        echo "                            </td>
                            <td>";
        // line 49
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "credits", array()), "html", null, true);
        echo "</td>
                            <td>";
        // line 50
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "price", array()), "html", null, true);
        echo "</td>
                        </tr>
                        <tr style=\"text-align:left;\">
                            <td class=\"table__avatar\">
                            </td>
                            <td>
                            </td>
                            <td style=\"background-color: #f4f9fc;\"><strong>";
        // line 57
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.cart.subtotal"), "html", null, true);
        echo "</strong></td>
                            <td style=\"background-color: #f4f9fc;\"><strong>";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "price", array()), "html", null, true);
        echo "</strong></td>
                        </tr>
                        <tr style=\"text-align:left;\">
                            <td>
                            </td>
                            <td>
                            </td>
                            <td style=\"background-color: #f4f9fc;\"><strong>";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.cart.total"), "html", null, true);
        echo "</strong></td>
                            <td style=\"background-color: #f4f9fc;\"><strong>";
        // line 66
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "price", array()), "html", null, true);
        echo "</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"col-sm-4 col-md-8 col-lg-6 offset-md-2 offset-lg-3\">
            <form method=\"POST\" action=\"";
        // line 75
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("payments_pay");
        echo "\">
                <input name=\"id\" value=\"";
        // line 76
        echo twig_escape_filter($this->env, $this->getAttribute(($context["package"] ?? null), "id", array()), "html", null, true);
        echo "\" type=\"hidden\">
                <div class=\"row\">
                    <div class=\"col-sm-4 col-md-6 col-lg-8\">
                        <select class=\"form-control select2\" name=\"gateway\" id=\"select-gateway\" required>
                            <option value=\"\">";
        // line 80
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.billing.checkout.select_payment_method"), "html", null, true);
        echo "</option>
                            ";
        // line 81
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getGateways());
        foreach ($context['_seq'] as $context["_key"] => $context["gateway"]) {
            // line 82
            echo "                                <option data-logo=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl((("bundles/assets/themes/default/dist/img/payments/" . $this->getAttribute($context["gateway"], "uniqueName", array())) . ".png")), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gateway"], "uniqueName", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["gateway"], "displayName", array()), "html", null, true);
            echo "</option>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gateway'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 84
        echo "                        </select>
                    </div>
                    <div class=\"col-sm-4 col-md-3 col-lg-2\">
                       <a class=\"pull-right btn btn-secondary icon-left\" href=\"";
        // line 87
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("packages");
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.cancel"), "html", null, true);
        echo " <span class=\"btn-icon ua-icon-circle-close\"></span></a>
                    </div>
                    <div class=\"col-sm-4 col-md-3 col-lg-2\">
                        <button class=\"pull-right btn btn-success icon-left\" type=\"submit\">
                            ";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.packages.confirm"), "html", null, true);
        echo " <span class=\"btn-icon ua-icon-circle-check\"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "@App/themes/default/Admin/Products/cart.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  225 => 91,  216 => 87,  211 => 84,  198 => 82,  194 => 81,  190 => 80,  183 => 76,  179 => 75,  167 => 66,  163 => 65,  153 => 58,  149 => 57,  139 => 50,  135 => 49,  132 => 48,  128 => 46,  124 => 44,  122 => 43,  116 => 40,  112 => 39,  103 => 33,  99 => 32,  95 => 31,  91 => 30,  87 => 29,  84 => 28,  81 => 27,  78 => 26,  76 => 25,  73 => 24,  71 => 23,  64 => 18,  61 => 17,  56 => 14,  48 => 8,  45 => 7,  41 => 5,  38 => 4,  32 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@App/themes/default/Admin/Products/cart.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle\\Resources\\views\\themes\\default\\Admin\\Products\\cart.html.twig");
    }
}
