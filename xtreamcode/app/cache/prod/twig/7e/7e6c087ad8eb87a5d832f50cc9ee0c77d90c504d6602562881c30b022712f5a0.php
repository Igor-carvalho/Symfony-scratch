<?php

/* AppBundle:themes/default/Admin/Streams:index.html.twig */
class __TwigTemplate_97a6b52168b5f0cf61c2ac3e7e9d1c3dd52aa630f87649887a7ad34ffc0672d3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default/base-admin:base.html.twig", "AppBundle:themes/default/Admin/Streams:index.html.twig", 1);
        $this->blocks = array(
            'page_title' => array($this, 'block_page_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'vars' => array($this, 'block_vars'),
            'javascripts' => array($this, 'block_javascripts'),
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
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("base_admin.sidebar.menu.admin.channels"), "html", null, true);
    }

    // line 4
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 5
        echo " ";
    }

    // line 7
    public function block_vars($context, array $blocks = array())
    {
        // line 8
        echo "    var msgDelete = \"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.streams.msg_delete"), "html", null, true);
        echo "\";
";
    }

    // line 11
    public function block_javascripts($context, array $blocks = array())
    {
        // line 12
        echo "    <script type=\"text/javascript\">
        var table = '';
        var rpp = 100;

        \$(document).ready(function () {
            table = \$('#stream_datatable').DataTable({
                lengthChange: true,
                destroy: false,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, \"All\"]],
                dom: \"<'row'<'col-md-6 pull-left'lB><'col-md-6 pull-right'f>>rt<'row'<'col-md-6 pull-left'i><'col-md-6 pull-right'p>>\", 
                buttons: [
                    'excel'
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: \"";
        // line 28
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams_ajax");
        echo "\",
                    method: 'POST',
                    data: {
                        page: 1,
                        rpp: rpp
                    }
                },
                columns: [
                    { \"data\": \"name\" },
                    { \"data\": \"category\" },
                    { \"data\": \"actions\" }
                ]
            });

            edit('#datatable tbody');

            setTimeout(function () {
                search(2, rpp);
            }, 900);
        })

        function edit(tbody){
          \$(tbody).on('click', 'a.edit', function(){
              var data = table.row(\$(this).parents('tr')).data();
              var url = \$(this).data('href');
              
              window.location = \$(this).data('href');
          });
        }

        function search(page, rpp){
            \$.ajax({
                url: \"";
        // line 60
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams_ajax");
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
                            \"name\": datas[i].name,
                            \"category\": datas[i].category,
                            \"actions\": datas[i].actions
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

    // line 86
    public function block_body_parent($context, array $blocks = array())
    {
        // line 87
        echo "    <div class=\"row\">
        <div style=\"margin-bottom: 20px;\" class=\"col-md-12 no-padding\">
            <a class=\"btn btn-success pull-right\" href=\"";
        // line 89
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("streams_new");
        echo "\">
                ";
        // line 90
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.streams.add"), "html", null, true);
        echo "
            </a>
        </div>
    </div>
    <div class=\"row\">
        <div class=\"m-datatable col-md-6 offset-md-3\">
            <table id=\"stream_datatable\" class=\"table table-striped\">
                <thead>
                    <tr>
                        <th style=\"width:5%;\">";
        // line 99
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.streams.name"), "html", null, true);
        echo "</th>
                        <th style=\"width:5%;\">";
        // line 100
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.streams.category"), "html", null, true);
        echo "</th>
                        <th style=\"width:5%;\">";
        // line 101
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("pages.streams.actions"), "html", null, true);
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
        return "AppBundle:themes/default/Admin/Streams:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 101,  167 => 100,  163 => 99,  151 => 90,  147 => 89,  143 => 87,  140 => 86,  111 => 60,  76 => 28,  58 => 12,  55 => 11,  48 => 8,  45 => 7,  41 => 5,  38 => 4,  32 => 2,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/Admin/Streams:index.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/Admin/Streams/index.html.twig");
    }
}
