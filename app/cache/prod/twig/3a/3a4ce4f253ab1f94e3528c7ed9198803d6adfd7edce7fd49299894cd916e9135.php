<?php

/* AppBundle:themes/default/base-admin:base.html.twig */
class __TwigTemplate_ea67f5a28747bb88accd7443d2fa61c2dd0a9abf897fc27fe35ea0f3e78558b0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("AppBundle:themes/default:base.html.twig", "AppBundle:themes/default/base-admin:base.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body_class' => array($this, 'block_body_class'),
            'content' => array($this, 'block_content'),
            'content_class' => array($this, 'block_content_class'),
            'page_title' => array($this, 'block_page_title'),
            'body_parent' => array($this, 'block_body_parent'),
            'body' => array($this, 'block_body'),
            'bottom' => array($this, 'block_bottom'),
            'vars' => array($this, 'block_vars'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "AppBundle:themes/default:base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        // line 4
        echo "     <link rel=\"stylesheet\"
           href=\"";
        // line 5
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/jodit/jodit.min.css"), "html", null, true);
        echo "\"/>

     <link rel=\"stylesheet\"
           href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/datatables/datatables.min.css"), "html", null, true);
        echo "\"/>

     <link rel=\"stylesheet\"
           href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/fonts/open-sans/style.min.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\"
           href=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/fonts/universe-admin/style.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\"
           href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/fonts/mdi/css/materialdesignicons.min.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/fonts/iconfont/style.css"), "html", null, true);
        echo "\">

     <link rel=\"stylesheet\"
           href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/flatpickr/flatpickr.min.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\"
           href=\"";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/simplebar/simplebar.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\" href=\"";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/tagify/tagify.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\" href=\"";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/tippyjs/tippy.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\"
           href=\"";
        // line 25
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/select2/css/select2.min.css"), "html", null, true);
        echo "\">
     <link rel=\"stylesheet\"
           href=\"";
        // line 27
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/bootstrap/css/bootstrap.min.css"), "html", null, true);
        echo "\">

     <link rel=\"stylesheet\" href=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/bootstrap-toastr/toastr.min.css"), "html", null, true);
        echo "\">

     <link id=\"stylesheet\" rel=\"stylesheet\"
           href=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/css/style.min.css"), "html", null, true);
        echo "\">

     <script src=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/js/ie.assign.fix.min.js"), "html", null, true);
        echo "\"></script>

     <script src=\"";
        // line 36
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/jquery/jquery.min.js"), "html", null, true);
        echo "\"></script>

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
     <script src=\"https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js\"></script>
     <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
     <![endif]-->

     <style type=\"text/css\">
         .hidden {
             display: none;
         }

         .hide {
             visibility: hidden;
         }

         .pull-right {
             float: right;
         }

         .pull-left {
             float: left;
         }

         table tr, .center {
             text-align: center;
         }

         table tbody tr > :first-child {
             text-align: left;
         }

         table thead tr {
             background-color: #6fc1f0
         }

         /*
         * Page: Invoice
         * -------------
         */
         .invoice {
             position: relative;
             background: #fff;
             border: 1px solid #f4f4f4;
             padding: 20px;
             margin: 10px 25px;
         }

         .invoice-title {
             margin-top: 0;
         }
     </style>
     ";
        // line 90
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 91
        echo " ";
    }

    // line 90
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 93
    public function block_body_class($context, array $blocks = array())
    {
        // line 94
        echo "    ";
        echo twig_escape_filter($this->env, $this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getStyleLayout(), "html", null, true);
        echo "
";
    }

    // line 97
    public function block_content($context, array $blocks = array())
    {
        // line 98
        echo "    ";
        // line 114
        echo "
    <!-- Main Header -->
    ";
        // line 116
        $this->loadTemplate("AppBundle:themes/default/base-admin:top-navbar.html.twig", "AppBundle:themes/default/base-admin:base.html.twig", 116)->display($context);
        // line 117
        echo "
    <div class=\"page-wrap\">
        ";
        // line 119
        $this->loadTemplate("AppBundle:themes/default/base-admin:sidebar.html.twig", "AppBundle:themes/default/base-admin:base.html.twig", 119)->display($context);
        // line 120
        echo "        <div class=\"page-content\">
            <div class=\"";
        // line 121
        $this->displayBlock('content_class', $context, $blocks);
        echo "\">
                <div class=\"page-content__header\">
                    <div>
                        <h2 class=\"page-content__header-heading\">";
        // line 124
        $this->displayBlock('page_title', $context, $blocks);
        echo "</h2>
                    </div>
                </div>
                ";
        // line 127
        $this->displayBlock('body_parent', $context, $blocks);
        // line 132
        echo "            </div>
        </div>
    </div>

    <div class=\"sidebar-mobile-overlay\"></div>


    <div class=\"settings-panel\">
        <div class=\"settings-panel__header\">
            <span class=\"settings-panel__close ua-icon-modal-close\"></span>
            <h5 class=\"settings-panel__heading center\">";
        // line 142
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("ui_setting"), "html", null, true);
        echo "</h5>
        </div>
        <div class=\"settings-panel__body\">
            <div class=\"settings-panel__layout-options\">
                <h6 class=\"settings-panel__block-heading\">Layout Options</h6>
                <div class=\"settings-panel__layout-option\">
                    <label class=\"switch-inline\">
          <span class=\"switch\">
            <input type=\"checkbox\" id=\"collapse-sidebar\" value=\"1\">
              <span class=\"switch-slider\"></span>
            </span>
                        <span class=\"switch-inline__text\">Collapse Sidebar</span>
                    </label>
                </div>
                <div class=\"settings-panel__layout-option\">
                    <label class=\"switch-inline\">
          <span class=\"switch\">
            <input type=\"checkbox\" id=\"hide-sidebar\">
              <span class=\"switch-slider\"></span>
            </span>
                        <span class=\"switch-inline__text\">Hide Sidebar</span>
                    </label>
                </div>
                <div class=\"settings-panel__layout-option\">
                    <label class=\"switch-inline\">
          <span class=\"switch\">
            <input type=\"checkbox\" id=\"full-height-sidebar\">
              <span class=\"switch-slider\"></span>
            </span>
                        <span class=\"switch-inline__text\">Full Height Sidebar</span>
                    </label>
                </div>
                <div class=\"settings-panel__layout-option\">
                    <label class=\"switch-inline\">
          <span class=\"switch\">
            <input type=\"checkbox\" id=\"rounded-form-controls\">
              <span class=\"switch-slider\"></span>
            </span>
                        <span class=\"switch-inline__text\">Rounded Form Controls</span>
                    </label>
                </div>
            </div>
            <div class=\"settings-panel__theme-colors\">
                <h6 class=\"settings-panel__block-heading\">Theme Colors</h6>

                <ul class=\"list-unstyled\">
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-b\">
                            <span class=\"color-radio__color color-radio__color--deep-cerulean\"></span>
                            <span class=\"color-radio__text\">#2</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style\">
                            <span class=\"color-radio__color color-radio__color--river-bad\"></span>
                            <span class=\"color-radio__text\">#3</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-d\">
                            <span class=\"color-radio__color color-radio__color--sun-juan\"></span>
                            <span class=\"color-radio__text\">#4</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-e\">
                            <span class=\"color-radio__color color-radio__color--bermuda-gray\"></span>
                            <span class=\"color-radio__text\">#5</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-f\">
                            <span class=\"color-radio__color color-radio__color--deep-sea\"></span>
                            <span class=\"color-radio__text\">#6</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-i\">
                            <span class=\"color-radio__color color-radio__color--wine-berry\"></span>
                            <span class=\"color-radio__text\">#7</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-g\">
                            <span class=\"color-radio__color  color-radio__color--big-stone\"></span>
                            <span class=\"color-radio__text\">#8</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-j\">
                            <span class=\"color-radio__color color-radio__color--killarney\"></span>
                            <span class=\"color-radio__text\">#9</span>
                        </label>
                    </li>
                    <li>
                        <label class=\"color-radio js-settings-color\">
                            <input type=\"radio\" name=\"settings_color\" data-style=\"style-h\">
                            <span class=\"color-radio__color color-radio__color--kabul\"></span>
                            <span class=\"color-radio__text\">#10</span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <span class=\"settings-panel-control\">
  <span class=\"settings-panel-control__icon ua-icon-settings\"></span>
</span>
";
    }

    // line 121
    public function block_content_class($context, array $blocks = array())
    {
        echo "container-fluid container-fh";
    }

    // line 124
    public function block_page_title($context, array $blocks = array())
    {
        echo "Page Title";
    }

    // line 127
    public function block_body_parent($context, array $blocks = array())
    {
        // line 128
        echo "                    <div class=\"main-container container-fh__content\">
                        ";
        // line 129
        $this->displayBlock('body', $context, $blocks);
        // line 130
        echo "                    </div>
                ";
    }

    // line 129
    public function block_body($context, array $blocks = array())
    {
        echo "CONTENT";
    }

    // line 261
    public function block_bottom($context, array $blocks = array())
    {
        // line 262
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/popper/popper.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 263
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/bootstrap/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 264
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/select2/js/select2.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 265
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/simplebar/simplebar.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 266
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/text-avatar/jquery.textavatar.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 267
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/tippyjs/tippy.all.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 268
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/flatpickr/flatpickr.min.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 269
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/wnumb/wNumb.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 270
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/js/main.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 272
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/datatables/datatables.min.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 274
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/js/preview/settings-panel.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 275
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/js/preview/slide-nav.min.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 277
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/input-mask/jquery.inputmask.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 278
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/input-mask/jquery.inputmask.date.extensions.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 279
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/input-mask/jquery.inputmask.extensions.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 281
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/plugins/bootstrap-toastr/toastr.min.js"), "html", null, true);
        echo "\"></script>

    ";
        // line 283
        $this->loadTemplate("AppBundle:themes/default/base-admin:notify.html.twig", "AppBundle:themes/default/base-admin:base.html.twig", 283)->display($context);
        // line 284
        echo "
    <script src=\"";
        // line 285
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/dist/js/confirm.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 286
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/dist/js/custom.js"), "html", null, true);
        echo "\"></script>

    <script src=\"";
        // line 288
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/vendor/jodit/jodit.min.js"), "html", null, true);
        echo "\"></script>

    <script type=\"application/javascript\">
        var notfication = '';
        var notficationPlayed = false;
        var notificationsElements = '';
        var locale = \"";
        // line 294
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["app"] ?? null), "request", array()), "get", array(0 => "_locale"), "method"), "html", null, true);
        echo "\";
        var txtSuccess = \"";
        // line 295
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.txtSuccess"), "html", null, true);
        echo "\";
        var txtError = \"";
        // line 296
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.txtError"), "html", null, true);
        echo "\";
        var btnOk = \"";
        // line 297
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.btnOk"), "html", null, true);
        echo "\";
        var btnCancel = \"";
        // line 298
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.btnCancel"), "html", null, true);
        echo "\";
        var toastrSuccess = \"";
        // line 299
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("toastr.success"), "html", null, true);
        echo "\";
        var toastrError = \"";
        // line 300
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("toastr.error"), "html", null, true);
        echo "\";
        var txtNoData = \"";
        // line 301
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.txt_no_data"), "html", null, true);
        echo "\";
        var txtShowing = \"";
        // line 302
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.txt_howing"), "html", null, true);
        echo "\";
        var txtTo = \"";
        // line 303
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.txt_to"), "html", null, true);
        echo "\";
        var txtOf = \"";
        // line 304
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.txt_of"), "html", null, true);
        echo "\";
        var txtSearch = \"";
        // line 305
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.txt_search"), "html", null, true);
        echo "\";
        var txtNoDetails = \"";
        // line 306
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("js.data_table.no_details"), "html", null, true);
        echo "\";
        ";
        // line 307
        $this->displayBlock('vars', $context, $blocks);
        // line 308
        echo "    </script>

    <script type=\"text/javascript\">
        \$(document).ready(function () {
            notfication = new Audio('";
        // line 312
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("notfication.wav"), "html", null, true);
        echo "');

            if (\$('body').hasClass(\"sidebar-sm\"))
                \$('#collapse-sidebar').prop('checked', true);

            if (\$('body').hasClass(\"sidebar-hidden\"))
                \$('#hide-sidebar').prop('checked', true);

            if (\$('body').hasClass(\"sidebar-full-height\"))
                \$('#full-height-sidebar').prop('checked', true);

            if (\$('body').hasClass(\"form-controls-rounded\"))
                \$('#rounded-form-controls').prop('checked', true);

            var style = \"";
        // line 326
        echo twig_escape_filter($this->env, $this->env->getExtension('Dmcl\AppBundle\Twig\Extension\UtilsExtension')->_getStyleColor(), "html", null, true);
        echo "\";
            var radio = \$('.js-settings-color input[data-style=\"' + style + '\"]');
            var parent = radio.closest('.js-settings-color');
            parent.addClass('is-checked');

            \$('#stylesheet').attr('href', \"";
        // line 331
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("bundles/assets/themes/default/universeadmin/css/"), "html", null, true);
        echo "\" + style + \".min.css\");

            \$('#collapse-sidebar').on({
                click: function () {
                    updateStyle(\$('body')[0].attributes.class.nodeValue, 1);
                }
            });

            \$('#hide-sidebar').on({
                click: function () {
                    updateStyle(\$('body')[0].attributes.class.nodeValue, 1);
                }
            });

            \$('#full-height-sidebar').on({
                click: function () {
                    updateStyle(\$('body')[0].attributes.class.nodeValue, 1);
                }
            });

            \$('#rounded-form-controls').on({
                click: function () {
                    updateStyle(\$('body')[0].attributes.class.nodeValue, 1);
                }
            });


            \$('.color-radio input').on({
                click: function () {
                    updateStyle(\$(this).data('style'), 0);
                }
            });

            setInterval(function () {
                getNotifications();
            }, 5000);
        });

        function getNotifications() {
            \$.ajax({
                url: \"";
        // line 371
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("tickets_notifications");
        echo "\",
                type: 'POST',
                data: {}
            }).done(function (response) {
                var datas = response.datas;

                \$('.navbar-notify__indicator').hide();

                notificationsElements = \$('#notifications div[class=\"simplebar-content\"');
                notificationsElements.empty();

                for (var i = 0; i < datas.length; i++) {
                    var url = \"/xtreamcode/en/support/tickets/show/\" + datas[i].id;

                    notificationsElements.append('<a href=\"' + url + '\"><div style=\"cursor:pointer;\" class=\"navbar-dropdown-notifications__item\">\\
                                              <div class=\"navbar-dropdown-notifications__item-notify\">\\
                                                  <div>\\
                                                       <span class=\"icon ua-icon-comments\"></span>\\
                                                      <strong>' + datas[i].from + '</strong> replied to ' + datas[i].message + '\\
                                                  </div>\\
                                                  <div class=\"navbar-dropdown-notifications__item-datetime\">' + datas[i].date + '</div>\\
                                              </div>\\
                                          </div></a>');
                }

                if (datas.length) {
                    \$('.navbar-notify__indicator').show();

                    if (!notficationPlayed) {
                        notfication.play();
                        notficationPlayed = true;
                    }
                }
            });
        }

        function updateStyle(style, flag) {
            \$.ajax({
                url: \"";
        // line 409
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("settings_update_style");
        echo "\",
                type: 'POST',
                data: {
                    style: style,
                    flag: flag
                }
            });
        }
    </script>
    ";
        // line 418
        $this->displayBlock('javascripts', $context, $blocks);
    }

    // line 307
    public function block_vars($context, array $blocks = array())
    {
    }

    // line 418
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "AppBundle:themes/default/base-admin:base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  683 => 418,  678 => 307,  674 => 418,  662 => 409,  621 => 371,  578 => 331,  570 => 326,  553 => 312,  547 => 308,  545 => 307,  541 => 306,  537 => 305,  533 => 304,  529 => 303,  525 => 302,  521 => 301,  517 => 300,  513 => 299,  509 => 298,  505 => 297,  501 => 296,  497 => 295,  493 => 294,  484 => 288,  479 => 286,  475 => 285,  472 => 284,  470 => 283,  465 => 281,  460 => 279,  456 => 278,  452 => 277,  447 => 275,  443 => 274,  438 => 272,  433 => 270,  429 => 269,  425 => 268,  421 => 267,  417 => 266,  413 => 265,  409 => 264,  405 => 263,  400 => 262,  397 => 261,  391 => 129,  386 => 130,  384 => 129,  381 => 128,  378 => 127,  372 => 124,  366 => 121,  244 => 142,  232 => 132,  230 => 127,  224 => 124,  218 => 121,  215 => 120,  213 => 119,  209 => 117,  207 => 116,  203 => 114,  201 => 98,  198 => 97,  191 => 94,  188 => 93,  183 => 90,  179 => 91,  177 => 90,  120 => 36,  115 => 34,  110 => 32,  104 => 29,  99 => 27,  94 => 25,  89 => 23,  85 => 22,  81 => 21,  76 => 19,  70 => 16,  66 => 15,  61 => 13,  56 => 11,  50 => 8,  44 => 5,  41 => 4,  38 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "AppBundle:themes/default/base-admin:base.html.twig", "E:\\freelancer_project\\max_sweden\\xtreamcode\\src\\Dmcl\\AppBundle/Resources/views/themes/default/base-admin/base.html.twig");
    }
}
