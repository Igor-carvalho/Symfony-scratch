<?php

/* AppBundle:themes/default/base-admin:notify.html.twig */
class __TwigTemplate_86f27d3c0bb7583b6a5880a859b1411758f2f8b5cca3e64a9bf7d8c393e1382b extends Twig_Template
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
        echo "<script type=\"application/javascript\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "session", array()), "flashbag", array()), "get", array(0 => "error"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 3
            echo "    toastr.options = {closeButton: true, debug: false, positionClass: \"toast-top-right\", onclick: null, showDuration: \"5000\", hideDuration: \"5000\", timeOut: \"5000\", extendedTimeOut: \"5000\", showEasing: \"swing\", hideEasing: \"linear\", showMethod: \"fadeIn\", hideMethod: \"fadeOut\"};
    toastr.error(\"";
            // line 4
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "\", \"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("toastr.error"), "html", null, true);
            echo "\");
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "
    ";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute($this->getAttribute(($context["app"] ?? null), "session", array()), "flashbag", array()), "get", array(0 => "success"), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
            // line 8
            echo "    toastr.options = {closeButton: true, debug: false, positionClass: \"toast-top-right\", onclick: null, showDuration: \"5000\", hideDuration: \"5000\", timeOut: \"5000\", extendedTimeOut: \"5000\", showEasing: \"swing\", hideEasing: \"linear\", showMethod: \"fadeIn\", hideMethod: \"fadeOut\"};
    toastr.success(\"";
            // line 9
            echo twig_escape_filter($this->env, $context["message"], "html", null, true);
            echo "\", \"";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("toastr.success"), "html", null, true);
            echo "\");
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</script>";
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default/base-admin:notify.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 11,  49 => 9,  46 => 8,  42 => 7,  39 => 6,  29 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/base-admin:notify.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/base-admin/notify.html.twig");
    }
}
