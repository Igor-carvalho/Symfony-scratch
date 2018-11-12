<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdProjectContainerUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdProjectContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        // _after_login
        if (preg_match('#^/(?P<_locale>[^/]++)/_login$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => '_after_login')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::afterLoginAction',));
        }

        if (0 === strpos($pathinfo, '/media/cache/resolve')) {
            // liip_imagine_filter_runtime
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/rc/(?P<hash>[^/]++)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter_runtime;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter_runtime')), array (  '_controller' => 'liip_imagine.controller:filterRuntimeAction',));
            }
            not_liip_imagine_filter_runtime:

            // liip_imagine_filter
            if (preg_match('#^/media/cache/resolve/(?P<filter>[A-z0-9_\\-]*)/(?P<path>.+)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_liip_imagine_filter;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'liip_imagine_filter')), array (  '_controller' => 'liip_imagine.controller:filterAction',));
            }
            not_liip_imagine_filter:

        }

        // home
        if (preg_match('#^/(?P<_locale>[^/]++)/home$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'home')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::indexAction',));
        }

        // validate
        if (preg_match('#^/(?P<_locale>[^/]++)/validate(?:/(?P<msg>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'validate')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::validateAction',  'msg' => 'test',));
        }

        // send_email
        if (preg_match('#^/(?P<_locale>[^/]++)/send_email$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'send_email')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::sendEmailAction',));
        }

        // _home
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', '_home');
            }

            return array (  '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController::redirectAction',  'route' => 'home',  '_route' => '_home',);
        }

        // app_dashboard
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/dashboard$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_dashboard')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\DefaultController::indexAction',));
        }

        // app_dashboard_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/dashboard/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'app_dashboard_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\DefaultController::ajaxAction',));
        }

        // line
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'line');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::indexAction',));
        }

        // line_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::ajaxAction',));
        }

        // line_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::newAction',  'trial' => 0,));
        }

        // line_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_line_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::createAction',  'trial' => 0,));
        }
        not_line_create:

        // line_new_trial
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/new/trial$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_new_trial')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::newAction',  'trial' => 1,));
        }

        // line_create_trial
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/create/trial$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_line_create_trial;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_create_trial')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::createAction',  'trial' => 1,));
        }
        not_line_create_trial:

        // line_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::editAction',));
        }

        // line_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_line_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateAction',));
        }
        not_line_update:

        // line_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_line_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::deleteAction',));
        }
        not_line_delete:

        // line_show
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/show$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_show')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::showAction',));
        }

        // line_update_note
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/update_note$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update_note')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateNoteAction',));
        }

        // line_bouquets
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_bouquets$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_bouquets')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::bouquetsAction',));
        }

        // line_update_bouquets
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_update_bouquets$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update_bouquets')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateBouquetsAction',));
        }

        // line_update_mac
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_update_mac$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update_mac')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateMACAction',));
        }

        // line_update_e2
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_update_e2$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update_e2')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateE2Action',));
        }

        // line_update_parental_code
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_update_parental_code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_update_parental_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::updateParentalCodeAction',));
        }

        // line_devices
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/lines/line_devices$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'line_devices')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UsersController::lineDevicesAction',));
        }

        // streams
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'streams');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::indexAction',));
        }

        // streams_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::indexAjaxAction',));
        }

        // streams_report
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/report$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_report')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::indexReportAction',));
        }

        // streams_search
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/search$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_streams_search;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_search')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::searchAction',));
        }
        not_streams_search:

        // streams_submit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/submit$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_streams_submit;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_submit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::submitAction',));
        }
        not_streams_submit:

        // streams_reports
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/reports$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_reports')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::reportsAction',));
        }

        // streams_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::editAction',));
        }

        // streams_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_streams_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::updateAction',));
        }
        not_streams_update:

        // streams_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_streams_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::deleteAction',));
        }
        not_streams_delete:

        // streams_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::newAction',));
        }

        // streams_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/streams/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_streams_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'streams_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StreamsController::createAction',));
        }
        not_streams_create:

        // packages
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'packages');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::indexAction',));
        }

        // packages_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::newAction',));
        }

        // packages_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_packages_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::createAction',));
        }
        not_packages_create:

        // packages_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::editAction',));
        }

        // packages_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_packages_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::updateAction',));
        }
        not_packages_update:

        // packages_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_packages_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::deleteAction',));
        }
        not_packages_delete:

        // packages_bouquets
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/packages/bouquets$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_packages_bouquets;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'packages_bouquets')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesController::bouquetsAction',));
        }
        not_packages_bouquets:

        // products
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'products');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::indexAction',));
        }

        // products_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::newAction',));
        }

        // products_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_products_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::createAction',));
        }
        not_products_create:

        // products_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::editAction',));
        }

        // products_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_products_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::updateAction',));
        }
        not_products_update:

        // products_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_products_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::deleteAction',));
        }
        not_products_delete:

        // products_cart
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/cart$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_cart')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::cartAction',));
        }

        // products_change_super_reseller
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/changeSuperReseller$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_products_change_super_reseller;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_change_super_reseller')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::changeSuperResellerAction',));
        }
        not_products_change_super_reseller:

        // products_change_status
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/products/(?P<id>[^/]++)/changeStatus$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_products_change_status;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'products_change_status')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\PackagesLocalController::changeStatusAction',));
        }
        not_products_change_status:

        // logs
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/logs/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'logs');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'logs')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\LogsController::indexAction',));
        }

        // logs_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/logs/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'logs_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\LogsController::ajaxAction',));
        }

        // settings
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/settings/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'settings');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SettingsController::indexAction',));
        }

        // settings_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/settings/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_settings_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SettingsController::updateAction',));
        }
        not_settings_update:

        // settings_update_style
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/settings/updateStyle$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_settings_update_style;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'settings_update_style')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SettingsController::updateStyleAction',));
        }
        not_settings_update_style:

        // swith_status
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/settings/(?P<ip>[^/]++)/(?P<type>[^/]++)/(?P<action>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'swith_status')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SettingsController::swithStatusAction',));
        }

        // server_info
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/settings/server_info$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'server_info')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SettingsController::serverInfoAction',));
        }

        // epg
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/epg/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'epg');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'epg')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\EpgController::indexAction',));
        }

        // billing_customers
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customers$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customers')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customersAction',));
        }

        // billing_customer
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customer')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customerAction',));
        }

        // billing_customers_orders
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customers/(?P<id>[^/]++)/orders$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_billing_customers_orders;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customers_orders')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customersOrdersAction',));
        }
        not_billing_customers_orders:

        // billing_customers_products
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer/(?P<id>[^/]++)/products$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customers_products')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customerProductsAction',));
        }

        // billing_orders
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/orders$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_orders')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::ordersAction',));
        }

        // billing_customer_orders
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer/orders$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_billing_customer_orders;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customer_orders')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customerOrdersAction',));
        }
        not_billing_customer_orders:

        // billing_order_details
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/(?P<transactionId>[^/]++)/details$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_order_details')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::orderDetailsAction',));
        }

        // billing_customer_orders_details
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer/(?P<customer>[^/]++)/order/(?P<transactionId>[^/]++)/details$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_billing_customer_orders_details;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customer_orders_details')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customerOrderDetailsAction',));
        }
        not_billing_customer_orders_details:

        // billing_customers_orders_details
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customers/(?P<customer>[^/]++)/order/(?P<transactionId>[^/]++)/details$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                $allow = array_merge($allow, array('GET', 'HEAD'));
                goto not_billing_customers_orders_details;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_customers_orders_details')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::customersOrderDetailsAction',));
        }
        not_billing_customers_orders_details:

        // billing_statistics
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/statistics$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_statistics')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::statisticsAction',));
        }

        // billing_remove_product
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer/(?P<customer>[^/]++)/remove/(?P<type>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_remove_product')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::removeProductAction',));
        }

        // billing_add_product
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/customer/(?P<customer>[^/]++)/add\\-products/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing_add_product')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingController::addProductsAction',));
        }

        // billing-configuration
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/configuration/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'billing-configuration');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing-configuration')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingConfigurationController::indexAction',));
        }

        // billing-configuration_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/configuration/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_billingconfiguration_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'billing-configuration_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\BillingConfigurationController::updateAction',));
        }
        not_billingconfiguration_update:

        // gateways
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'gateways');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::indexAction',));
        }

        // gateways_show
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/(?P<uniquename>[^/]++)/show$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_show')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::showAction',));
        }

        // gateways_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::newAction',));
        }

        // gateways_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_gateways_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::createAction',));
        }
        not_gateways_create:

        // gateways_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/(?P<uniquename>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::editAction',));
        }

        // gateways_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/(?P<uniquename>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_gateways_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::updateAction',));
        }
        not_gateways_update:

        // gateways_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/billing/gateways/(?P<uniquename>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_gateways_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'gateways_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\GatewaysController::deleteAction',));
        }
        not_gateways_delete:

        // admin_channels_statistics
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/statistics/channels\\-statistics$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_channels_statistics')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StatisticsController::channelsAction',));
        }

        // admin_vod_statistics
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/statistics/vod\\-statistics$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_vod_statistics')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StatisticsController::vodAction',));
        }

        // admin_statistics_playback_word
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/statistics/dashboard/playback\\-word/(?P<type>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_statistics_playback_word')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\StatisticsController::playbackWordAction',));
        }

        // admin_customers
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'admin_customers');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::indexAction',));
        }

        // admin_customers_new
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::newAction',));
        }

        // admin_customers_show
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/show$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_show')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::showAction',));
        }

        // admin_customers_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_admin_customers_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::createAction',));
        }
        not_admin_customers_create:

        // admin_customers_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::editAction',));
        }

        // admin_customers_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_admin_customers_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::updateAction',));
        }
        not_admin_customers_update:

        // admin_customers_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_admin_customers_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::deleteAction',));
        }
        not_admin_customers_delete:

        // admin_customers_generate_playlist
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/customers/(?P<id>[^/]++)/generate\\-playlist$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'admin_customers_generate_playlist')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\CustomersController::generatePlaylistAction',));
        }

        // user_login
        if (preg_match('#^/(?P<_locale>[^/]++)/login$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_login')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::loginAction',));
        }

        // user_check
        if (preg_match('#^/(?P<_locale>[^/]++)/check$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::checkAction',));
        }

        // user_logout
        if (preg_match('#^/(?P<_locale>[^/]++)/logout$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_logout')), array ());
        }

        // user
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::indexAction',));
        }

        // user_change_password
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/chage_password$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_change_password')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::changePasswordAction',));
        }

        // user_profile
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/profile$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_profile')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::profileAction',));
        }

        // user_profile_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/profile/update$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_profile_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::profileUpdateAction',));
        }

        // user_resellers
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/resellers$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_resellers')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::indexResellersAction',));
        }

        // user_resellers_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/resellers/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_resellers_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::ajaxResellersAction',));
        }

        // user_create
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/create$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::createAction',));
        }

        // user_update
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::updateAction',));
        }

        // user_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::deleteAction',));
        }

        // user_change_verified
        if (preg_match('#^/(?P<_locale>[^/]++)/admin/user/(?P<id>[^/]++)/change_verified$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_change_verified')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\UserController::changeVerifiedAction',));
        }

        // nodejs_start
        if (preg_match('#^/(?P<_locale>[^/]++)/nodejs/(?P<id>[^/]++)/start$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'nodejs_start')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::nodejsStartAction',));
        }

        // transcoder_start
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/channel/(?P<ip>[^/]++)/(?P<id>[^/]++)/start$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_start')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::startAction',));
        }

        // transcoder_stop
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/channel/(?P<ip>[^/]++)/(?P<id>[^/]++)/stop$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_stop')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::stopAction',));
        }

        // transcoder_next_http
        if (preg_match('#^/(?P<_locale>[^/]++)/next\\-http$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_next_http')), array (  '_controller' => 'AppBundle:Admin/TranscoderConfig:nextHttp',));
        }

        // transcoder_preadd
        if (preg_match('#^/(?P<_locale>[^/]++)/pre\\-add$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_preadd')), array (  '_controller' => 'AppBundle:Admin/TranscoderConfig:preAdd',));
        }

        // transcoder_vodpackage_start
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/vod\\-package/start$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_vodpackage_start')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::startTranscoderVodPackageAction',));
        }

        // transcoder_vodpackage_stop
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/vod\\-package/stop$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_vodpackage_stop')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::stopTranscoderVodPackageAction',));
        }

        // transcoder_vodpackage_start_all
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/vod\\-package/start\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_vodpackage_start_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_vodpackage_start_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::startTranscoderAllVodPackageAction',));
        }

        // transcoder_vodpackage_stop_all
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/vod\\-package/stop\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_vodpackage_stop_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_vodpackage_stop_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::stopTranscoderAllVodPackageAction',));
        }

        // transcoder_channel_start_all
        if (preg_match('#^/(?P<_locale>[^/]++)/(?P<ip>[^/]++)/transcoder/channel/start\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_channel_start_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_channel_start_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::startTranscoderAllChannelAction',));
        }

        // transcoder_channel_http_rtsp_start_all
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/channelHttpRtsp/start\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_channel_http_rtsp_start_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_channel_http_rtsp_start_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::startTranscoderAllChannelHttpRtspAction',));
        }

        // transcoder_channel_stop_all
        if (preg_match('#^/(?P<_locale>[^/]++)/(?P<ip>[^/]++)/transcoder/channel/stop\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_channel_stop_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_channel_stop_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::stopTranscoderAllChannelAction',));
        }

        // transcoder_channel_http_rtsp_stop_all
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/channelHttpRtsp/stop\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_channel_http_rtsp_stop_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_channel_http_rtsp_stop_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::stopTranscoderAllChannelHttpRtspAction',));
        }

        // transcoder_vodpackage_restart_all
        if (preg_match('#^/(?P<_locale>[^/]++)/transcoder/vod\\-package/restart\\-all/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'transcoder_vodpackage_restart_all');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'transcoder_vodpackage_restart_all')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TranscoderController::restartTranscoderAllVodPackageAction',));
        }

        // add_to_cart
        if (preg_match('#^/(?P<_locale>[^/]++)/shopping\\-cart/add$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'add_to_cart')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ShopCartController::addProductAction',));
        }

        // remove_from_cart
        if (preg_match('#^/(?P<_locale>[^/]++)/shopping\\-cart/remove$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'remove_from_cart')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ShopCartController::removeProductAction',));
        }

        // get_cart
        if (preg_match('#^/(?P<_locale>[^/]++)/shopping\\-cart/get$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'get_cart')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ShopCartController::getCarAction',));
        }

        // clear_cart
        if (preg_match('#^/(?P<_locale>[^/]++)/shopping\\-cart/clear$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'clear_cart')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ShopCartController::clearCarAction',));
        }

        // payments_success
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/success$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_success')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::successAction',));
        }

        // add_subscription
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/add\\-subscription/(?P<type>[^/]++)/(?P<id>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'add_subscription')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::addSubscriptionsAction',));
        }

        // payments_error
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/cancel$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_error')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::errorAction',));
        }

        // payments_paypal_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/paypal$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_paypal_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::paypalCheckAction',));
        }

        // payments_moneybookers_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/moneybookers$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_moneybookers_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::moneybookersCheckAction',));
        }

        // payments_interkassa_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/interkassa$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_interkassa_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::interkassaCheckAction',));
        }

        // payments_webmoney_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/webmoney$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_webmoney_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::webmoneyCheckAction',));
        }

        // payments_onpay_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/onpay$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_onpay_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::onPayCheckAction',));
        }

        // payments_creditcard_check
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/credicard(?:/(?P<token>[^/]++)(?:/(?P<method>[^/]++))?)?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_creditcard_check')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::creditCardCheckAction',  'token' => NULL,  'method' => NULL,));
        }

        // payments_paypal_succes_for_activation_code
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/paypal/success\\-for\\-activation\\-code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_paypal_succes_for_activation_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::paymentSuccessForActivationCodeAction',));
        }

        // payments_paypal_error_for_activation_code
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/paypal/error\\-for\\-activation\\-code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_paypal_error_for_activation_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::paymentErrorForActivationCodeAction',));
        }

        // payments_paypal_check_for_activation_code
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/paypal/check\\-for\\-activation\\-code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_paypal_check_for_activation_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::paypalCheckForActivationCodeAction',));
        }

        // payments_paypal_pay_for_activation_code
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/paypal/pay\\-for\\-activation\\-code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_paypal_pay_for_activation_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::payActivationCodeAction',));
        }

        // payments_credit_card__pay_for_activation_code
        if (preg_match('#^/(?P<_locale>[^/]++)/purchase/credit\\-card/pay\\-for\\-activation\\-code$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_credit_card__pay_for_activation_code')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::payCreditCardActivationCodeAction',));
        }

        // payments_pay
        if (preg_match('#^/(?P<_locale>[^/]++)/account/purchase/pay$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'payments_pay')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\PaymentsController::payAction',));
        }

        // tickets_ajax
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/ajax$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_ajax')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::ajaxAction',));
        }

        // tickets_notifications
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/ajax/getNotifications$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_notifications')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::getNotificationsAction',));
        }

        // tickets_send
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/send$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_tickets_send;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_send')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::sendAction',));
        }
        not_tickets_send:

        // tickets_messages
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/messages$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_tickets_messages;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_messages')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::getMessagesAction',));
        }
        not_tickets_messages:

        // tickets_create
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_tickets_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::createAction',));
        }
        not_tickets_create:

        // tickets_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_tickets_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::deleteAction',));
        }
        not_tickets_delete:

        // tickets
        if (preg_match('#^/(?P<_locale>[^/]++)/support/tickets/show(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'tickets')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TicketsController::indexAction',  'id' => '',));
        }

        // technical_issues
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'technical_issues');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::indexAction',));
        }

        // technical_issues_sent
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/sent$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_sent')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::sentAction',));
        }

        // technical_issues_show
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_show')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::showAction',));
        }

        // technical_issues_new
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/new$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_new')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::newAction',));
        }

        // technical_issues_create
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/create$#s', $pathinfo, $matches)) {
            if ($this->context->getMethod() != 'POST') {
                $allow[] = 'POST';
                goto not_technical_issues_create;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_create')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::createAction',));
        }
        not_technical_issues_create:

        // technical_issues_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::editAction',));
        }

        // technical_issues_update
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_technical_issues_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::updateAction',));
        }
        not_technical_issues_update:

        // technical_issues_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/delete$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                $allow = array_merge($allow, array('POST', 'DELETE'));
                goto not_technical_issues_delete;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::deleteAction',));
        }
        not_technical_issues_delete:

        // issue_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/issue_edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'issue_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::issueEditAction',));
        }

        // issue_delete
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/issue_delete$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'issue_delete')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::issueDeleteAction',));
        }

        // technical_issues_reply
        if (preg_match('#^/(?P<_locale>[^/]++)/support/technical_issues/(?P<id>[^/]++)/reply$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'technical_issues_reply')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\TechnicalIssuesController::replyAction',));
        }

        // proxy_handle
        if (preg_match('#^/(?P<_locale>[^/]++)/proxy/(?P<server>[^/]++)/handle$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'GET', 'HEAD'))) {
                $allow = array_merge($allow, array('POST', 'GET', 'HEAD'));
                goto not_proxy_handle;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'proxy_handle')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ProxyController::indexAction',));
        }
        not_proxy_handle:

        // proxy_vod_handle
        if (preg_match('#^/(?P<_locale>[^/]++)/proxy/(?P<server>[^/]++)/vod\\-handle$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'GET', 'HEAD'))) {
                $allow = array_merge($allow, array('POST', 'GET', 'HEAD'));
                goto not_proxy_vod_handle;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'proxy_vod_handle')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ProxyController::vodIndexAction',));
        }
        not_proxy_vod_handle:

        // show_anouncements
        if (preg_match('#^/(?P<_locale>[^/]++)/anouncements/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'show_anouncements');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'show_anouncements')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::showAnouncementsAction',));
        }

        // navbar_date
        if (preg_match('#^/(?P<_locale>[^/]++)/navbar\\-date/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'navbar_date');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'navbar_date')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\DefaultController::navbarDateAction',));
        }

        // sla_show
        if (preg_match('#^/(?P<_locale>[^/]++)/statics/(?P<slug>[^/]++)/details$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sla_show')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SlaController::showAction',));
        }

        // sla_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/statics/(?P<slug>[^/]++)/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sla_edit')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SlaController::editAction',));
        }

        // sla_update
        if (preg_match('#^/(?P<_locale>[^/]++)/statics/(?P<slug>[^/]++)/update$#s', $pathinfo, $matches)) {
            if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                $allow = array_merge($allow, array('POST', 'PUT'));
                goto not_sla_update;
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'sla_update')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\Admin\\SlaController::updateAction',));
        }
        not_sla_update:

        if (0 === strpos($pathinfo, '/api/v1')) {
            // api_get_playback_channelinfo
            if ($pathinfo === '/api/v1/playback/channel/info') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_get_playback_channelinfo;
                }

                return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::playbackChannelInfoAction',  '_route' => 'api_get_playback_channelinfo',);
            }
            not_api_get_playback_channelinfo:

            // api_activation_code_login
            if ($pathinfo === '/api/v1/activation-code/login') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_activation_code_login;
                }

                return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::activationCodeLoginAction',  '_route' => 'api_activation_code_login',);
            }
            not_api_activation_code_login:

            if (0 === strpos($pathinfo, '/api/v1/channels')) {
                // api_categories
                if ($pathinfo === '/api/v1/channels-categories') {
                    if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                        $allow = array_merge($allow, array('GET', 'HEAD'));
                        goto not_api_categories;
                    }

                    return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::categoriesAction',  '_route' => 'api_categories',);
                }
                not_api_categories:

                if (0 === strpos($pathinfo, '/api/v1/channels/programmes')) {
                    // api_channels_with_programmes
                    if (preg_match('#^/api/v1/channels/programmes/(?P<date>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_channels_with_programmes;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_channels_with_programmes')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::channelsWithProgrammeAction',));
                    }
                    not_api_channels_with_programmes:

                    // api_channels_with_programmes_between_dates
                    if (preg_match('#^/api/v1/channels/programmes/(?P<startDate>[^/]++)/(?P<endDate>[^/]++)$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                            $allow = array_merge($allow, array('GET', 'HEAD'));
                            goto not_api_channels_with_programmes_between_dates;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'api_channels_with_programmes_between_dates')), array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::channelsWithProgrammeBetweenDatesAction',));
                    }
                    not_api_channels_with_programmes_between_dates:

                    // api_channels_programmes
                    if ($pathinfo === '/api/v1/channels/programmes') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_api_channels_programmes;
                        }

                        return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::channelProgrammeAction',  '_route' => 'api_channels_programmes',);
                    }
                    not_api_channels_programmes:

                }

            }

            // api_request_trial_activation_code
            if ($pathinfo === '/api/v1/request/trial/activation-code') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_request_trial_activation_code;
                }

                return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::requestTrialActivationCodeAction',  '_route' => 'api_request_trial_activation_code',);
            }
            not_api_request_trial_activation_code:

            // api_post_getservertranscoder
            if ($pathinfo === '/api/v1/serverstranscoder/byuser') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_api_post_getservertranscoder;
                }

                return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::getServersTranscoderByUserAction',  '_route' => 'api_post_getservertranscoder',);
            }
            not_api_post_getservertranscoder:

            // api_vodgenres
            if ($pathinfo === '/api/v1/vod-genres') {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_api_vodgenres;
                }

                return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::vodGenresAction',  '_route' => 'api_vodgenres',);
            }
            not_api_vodgenres:

            // nelmio_api_doc_index
            if (0 === strpos($pathinfo, '/api/v1/doc') && preg_match('#^/api/v1/doc(?:/(?P<view>[^/]++))?$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('GET', 'HEAD'))) {
                    $allow = array_merge($allow, array('GET', 'HEAD'));
                    goto not_nelmio_api_doc_index;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'nelmio_api_doc_index')), array (  '_controller' => 'Nelmio\\ApiDocBundle\\Controller\\ApiDocController::indexAction',  'view' => 'default',));
            }
            not_nelmio_api_doc_index:

            if (0 === strpos($pathinfo, '/api/v1/line')) {
                // api_line_new
                if ($pathinfo === '/api/v1/line/new') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_line_new;
                    }

                    return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::newLineAction',  '_route' => 'api_line_new',);
                }
                not_api_line_new:

                // api_line_edit
                if ($pathinfo === '/api/v1/line/edit') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_line_edit;
                    }

                    return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::editLineAction',  '_route' => 'api_line_edit',);
                }
                not_api_line_edit:

                // api_line_info
                if ($pathinfo === '/api/v1/line/info') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_api_line_info;
                    }

                    return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\ApiController::infoLineAction',  '_route' => 'api_line_info',);
                }
                not_api_line_info:

            }

        }

        if (0 === strpos($pathinfo, '/tvbox')) {
            // stb_index
            if ($pathinfo === '/tvbox/index.html') {
                return array (  '_controller' => 'Dmcl\\StbBundle\\Controller\\DefaultController::indexAction',  '_route' => 'stb_index',);
            }

            // stb_server_load
            if ($pathinfo === '/tvbox/server/load.php') {
                return array (  '_controller' => 'Dmcl\\StbBundle\\Controller\\DefaultController::handleAction',  '_route' => 'stb_server_load',);
            }

        }

        // nginx_security
        if ($pathinfo === '/nginx') {
            return array (  '_controller' => 'Dmcl\\AppBundle\\Controller\\NginxSecurityController::checkAction',  '_route' => 'nginx_security',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
