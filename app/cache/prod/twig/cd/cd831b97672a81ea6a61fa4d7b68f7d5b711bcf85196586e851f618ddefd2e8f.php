<?php

/* AppBundle:themes/default:base.html.twig */
class __TwigTemplate_61507d213da9c6d389fce81f591446305e35780feeb8054cad90a6700c209f49 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'body_class' => array($this, 'block_body_class'),
            'content' => array($this, 'block_content'),
            'bottom' => array($this, 'block_bottom'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <title>";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getProjectName(), "html", null, true);
        echo " | ";
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no\" name=\"viewport\">
    <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getFavIco(), "html", null, true);
        echo "\" />
    ";
        // line 10
        $this->displayBlock('head', $context, $blocks);
        // line 11
        echo "</head>
<body class=\"";
        // line 12
        $this->displayBlock('body_class', $context, $blocks);
        echo "\">
    <div class=\"bloqueo\" style=\"display: none\">
        <div class=\"spinner\">
            <div class=\"bounce1\"></div>
            <div class=\"bounce2\"></div>
            <div class=\"bounce3\"></div>
        </div>
    </div>
    ";
        // line 20
        $this->displayBlock('content', $context, $blocks);
        // line 21
        echo "    ";
        $this->displayBlock('bottom', $context, $blocks);
        // line 22
        echo "</body>
</html>";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.welcome"), "html", null, true);
    }

    // line 10
    public function block_head($context, array $blocks = array())
    {
    }

    // line 12
    public function block_body_class($context, array $blocks = array())
    {
    }

    // line 20
    public function block_content($context, array $blocks = array())
    {
    }

    // line 21
    public function block_bottom($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default:base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  90 => 21,  85 => 20,  80 => 12,  75 => 10,  69 => 6,  64 => 22,  61 => 21,  59 => 20,  48 => 12,  45 => 11,  43 => 10,  39 => 9,  31 => 6,  24 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default:base.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/base.html.twig");
    }
}
