<?php

/* @App/themes/default/Admin/User/resellers.html.twig */
class __TwigTemplate_50259a16d4ab606573fd159774f84e53dc89805b74a4b014ba3cdcb8a5550498 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/base-admin:base.html.twig", "@App/themes/default/Admin/User/resellers.html.twig", 1);
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

    // line 3
    public function block_page_title($context, array $blocks = array())
    {
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.index.resellers"), "html", null, true);
    }

    // line 5
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 6
        echo " ";
    }

    // line 8
    public function block_javascripts($context, array $blocks = array())
    {
        // line 9
        echo "     <script text=\"javascript\">
        var table = '';
        var rpp = 50;

        \$(document).ready(function(){
           table = \$('#datatable').DataTable({
                lengthChange: true,
                select: false,
                dom: \"<'row'<'col-md-6 pull-left'lB><'col-md-6 pull-right'f>>rt<'row'<'col-md-6 pull-left'i><'col-md-6 pull-right'p>>\", 
                buttons: [
                    'excel'
                ],              
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
                ajax: {
                    url: \"";
        // line 23
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_resellers_ajax");
        echo "\",
                    method: 'POST',
                    data: {
                        page: 1,
                        rpp: rpp
                    }
                },
                columns: [
                    { \"data\": \"username\" },
                    { \"data\": \"email\" },
                    { \"data\": \"enabled\" },
                    { \"data\": \"startdate\" },
                    { \"data\": \"lastlogin\" },
                    { \"data\": \"details\" }
                ]
            });

            //edit('#datatable tbody');

            setTimeout(function () {
                search(2, rpp);
            }, 900);
           
           \$('#user_edit a.verified').click(function(e) {
                e.preventDefault();  
                var \$this = \$(this);

                \$.ajax({
                    type: \"POST\",
                    url: \$this.data('href'),
                    dataType: \"json\",
                    data: '',
                    success: function(respuesta) {
                        if (respuesta.type == 1) {
                            if(respuesta.verified){
                                \$this.removeClass(\"label-default\");
                                \$this.addClass(\"label-success\");
                                \$this.text('";
        // line 60
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("enabled"), "html", null, true);
        echo "');                                
                            }
                            else{
                                \$this.removeClass(\"label-success\");
                                \$this.addClass(\"label-default\");
                                \$this.text('";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("disabled"), "html", null, true);
        echo "');
                            }                    

                            toastr.success('Success');
                        } 
                    },
                    error: function(respuesta) {

                    }
                });
            });
        })

        ";
        // line 86
        echo "
        function search(page, rpp){
            \$.ajax({
                url: \"";
        // line 89
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_resellers_ajax");
        echo "\",
                dataType: \"json\", 
                type: 'POST',
                data: {
                    page: page,
                    rpp: rpp
                },
                success: function(response){
                    var datas = response.data;

                    for(var i = 0; i < datas.length; i++){
                        table.row.add({
                            \"username\": datas[i].username,
                            \"email\": datas[i].email,
                            \"enabled\": datas[i].enabled,
                            \"startdate\": datas[i].startdate,
                            \"lastlogin\": datas[i].lastlogin,
                            \"details\": datas[i].details
                        }).draw();
                    }

                    if(datas.length)
                        search(++page, rpp);
                }
            });
        }
     </script>
 ";
    }

    // line 118
    public function block_vars($context, array $blocks = array())
    {
        // line 119
        echo "    var msgDelete = \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.msg_delete"), "html", null, true);
        echo "\";
    var msgVerified = \"";
        // line 120
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->getTranslator()->trans("Are you sure to change verified state to this user?", array(), "messages");
        echo "\";
";
    }

    // line 123
    public function block_body_parent($context, array $blocks = array())
    {
        // line 124
        echo "    <div class=\"row\">
        <div class=\"col-md-12 no-padding\">
            <div class=\"form-group pull-right\">
                <a class=\"btn btn-success btn-sm\" href=\"";
        // line 127
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("user_create");
        echo "\">
                    ";
        // line 128
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.index.add_user"), "html", null, true);
        echo "
                </a>
            </div>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"m-datatable col-md-10 offset-md-1\">
            <table id=\"datatable\" class=\"table table-bordered table-striped\" id=\"user_edit\">
                <thead>
                    <tr>
                        <th style=\"width:10%;\">";
        // line 138
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.username"), "html", null, true);
        echo "</th>
                        <th style=\"width:10%;\">";
        // line 139
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.email"), "html", null, true);
        echo "</th>
                        <th style=\"width:10%;\">";
        // line 140
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.index.table.enabled"), "html", null, true);
        echo "</th>
                        <th style=\"width:10%;\">";
        // line 141
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.startdate"), "html", null, true);
        echo "</th>
                        <th style=\"width:10%;\">";
        // line 142
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.attrs.lastlogin"), "html", null, true);
        echo "</th>
                        <th style=\"width:8%;\">";
        // line 143
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.user.index.table.details"), "html", null, true);
        echo "</th>
                    </tr>
                </thead>
            </table>
         </div>
     </div>
";
    }

    public function getTemplateName()
    {
        return "@App/themes/default/Admin/User/resellers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  224 => 143,  220 => 142,  216 => 141,  212 => 140,  208 => 139,  204 => 138,  191 => 128,  187 => 127,  182 => 124,  179 => 123,  173 => 120,  168 => 119,  165 => 118,  133 => 89,  128 => 86,  112 => 65,  104 => 60,  64 => 23,  48 => 9,  45 => 8,  41 => 6,  38 => 5,  32 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@App/themes/default/Admin/User/resellers.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle\\Resources\\views\\themes\\default\\Admin\\User\\resellers.html.twig");
    }
}
