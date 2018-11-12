<?php

namespace Dmcl\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class BaseController extends Controller
{
    /**ROUTE FOR USER*/
    const ROUTE_LINE_CREATE = 'action=user&sub=create'; //create a new line
    const ROUTE_LINE_EDIT = 'action=user&sub=edit'; //edit a new line
    const ROUTE_LINE_INFO = 'action=user&sub=info'; //info a line

    const ACTION_USER = 'user';
    const ACTION_USER_REG = 'reg_user';
    const ACTION_MAG = 'stb';
    const ACTION_SERVER = 'server';
    const ACTION_STREAM = 'stream';

    const SUB_CREATE = 'create';
    const SUB_EDIT = 'edit';
    const SUB_INFO = 'info';
    const SUB_LIST = 'list';
    const SUB_CREDITS = 'credits';
    const SUB_OFFLINE = 'offline';
    const SUB_ONLINE = 'online';
    const SUB_START = 'start';
    const SUB_STOP = 'stop';
   
    
    /******************* */
    
    
    /**ROUTE FOR DASHBOARD*/
    const ROUTE_DASHBOARD_GETINFO = "dashboard/getinfo";
    const ROUTE_DASHBOARD_SYSTEMINFO = "dashboard/systeminfo";
    const ROUTE_DASHBOARD_PLAYBACKWORLD = "dashboard/playbackworld";
    const ROUTE_DASHBOARD_CHANNELS = "dashboard/channels";

    /**ROUTE FOR SETTINGS*/
    const ROUTE_SETTINGS_SERVERSTATUS = "settings/serverstatus";
    const ROUTE_SETTINGS_SERVERINFO = "settings/getserverinfo";
    const ROUTE_SETTINGS_SWITCHSTATUSNODEJS = "settings/switchstatusnodejs";
    const ROUTE_SETTINGS_SWITCHSTATUSNGINX = "settings/switchstatusnginx";
    const ROUTE_SETTINGS_SETPORTNODEJS = "settings/setportnodejs";
    const ROUTE_SETTINGS_SETPORTSNGINX = "settings/setportsnginx";

    /**ROUTE FOR STREAMS SERVER*/
    const ROUTE_STREAMSSERVER_SETIPSOCKET = "streamsserver/setipsocket";
    
    /**ROUTE FOR ACTIVATION CODES*/
    const ROUTE_ACTIVATIONCODES_LIST = "activationcodes/list";
    const ROUTE_ACTIVATIONCODES_CREATE = "activationcodes/create";
    const ROUTE_ACTIVATIONCODES_GET_BYID = "activationcodes/get/";
    const ROUTE_ACTIVATIONCODES_EDIT = "activationcodes/edit";
    const ROUTE_ACTIVATIONCODES_DELETE = "activationcodes/delete/";
    const ROUTE_ACTIVATIONCODES_PLAYLIST = "activationcodes/playlist";
    
    /**ROUTE FOR BACKUPS*/
    const ROUTE_BACKUPS_LIST = "backups/list";
    const ROUTE_BACKUPS_CREATE = "backups/create";
    const ROUTE_BACKUPS_RESTOREFROMFILE = "backups/restorefromfile";
    const ROUTE_BACKUPS_RESTORE = "backups/restore";
    const ROUTE_BACKUPS_DELETE = "backups/delete";
    const ROUTE_BACKUPS_DELETEALL = "backups/deleteall";
    const ROUTE_BACKUPS_DOWNLOAD = "backups/download";
    
    /**ROUTE FOR USERS*/
    const ROUTE_APIKEY_CHANGE = "apikey/change";
    
    /**ROUTE FOR TRANSCODER SETTINGS*/
    const ROUTE_TS_LIST = "ts/list";
    
    /**ROUTE FOR CUSTOMERS*/
    const ROUTE_CUSTOMERS_LIST = "customers/list";
    const ROUTE_CUSTOMERS_CREATE = "customers/create";
    const ROUTE_CUSTOMERS_GET_BYID = "customers/get/";
    const ROUTE_CUSTOMERS_EDIT = "customers/edit";
    const ROUTE_CUSTOMERS_DELETE = "customers/delete/";
    
    /**ROUTE FOR PRESETS*/
    const ROUTE_PRESETS_LIST = "presets/list";
    const ROUTE_PRESETS_CREATE = "presets/create";
    const ROUTE_PRESETS_GET_BYID = "presets/get/";
    const ROUTE_PRESETS_EDIT = "presets/edit";
    const ROUTE_PRESETS_DELETE = "presets/delete";
    
    /**ROUTE FOR EPGS*/
    const ROUTE_EPGS_LIST = "epgs/list";
    const ROUTE_EPGS_CREATE = "epgs/create";
    const ROUTE_EPGS_GET_BYID = "epgs/get/";
    const ROUTE_EPGS_EDIT = "epgs/edit";
    const ROUTE_EPGS_DELETE = "epgs/delete/";
    const ROUTE_EPGS_CHANNELS = "epgs/channels";
    const ROUTE_EPGS_PROGRAMMES = "epgs/programmes";
    
    /**ROUTE FOR CHANNEL CATEGORY*/
    const ROUTE_CHANNELCATEGORY_LIST = "channelcategory/list";
    const ROUTE_CHANNELCATEGORY_CREATE = "channelcategory/create";
    const ROUTE_CHANNELCATEGORYGET_BYID = "channelcategory/get/";
    const ROUTE_CHANNELCATEGORY_EDIT = "channelcategory/edit";
    const ROUTE_CHANNELCATEGORY_DELETE = "channelcategory/delete";
    
    /**ROUTE FOR CHANNEL*/
    const ROUTE_CHANNEL_INDEX = "channels/index";
    const ROUTE_CHANNEL_ALL = "channels";
    const ROUTE_CHANNEL_LIST = "channels/list/";
    const ROUTE_CHANNEL_CREATE = "channels/create";
    const ROUTE_CHANNEL_BYID = "channels/get/";
    const ROUTE_CHANNEL_EDIT = "channels/edit";
    const ROUTE_CHANNEL_DELETE = "channels/delete";
    const ROUTE_CHANNEL_PACKAGEREMOVE = "channels/package/remove/";
    const ROUTE_CHANNEL_SETPACKAGE = "channels/package/set";
    const ROUTE_CHANNEL_BITRATE = "channels/bitrate";
    const ROUTE_CHANNEL_DELETELOGS = "channels/deletelogs";
    const ROUTE_CHANNEL_IMPORT = "channels/import";
    const ROUTE_CHANNEL_STATUS = "channels/status";
    const ROUTE_CHANNEL_SCREENSHOOT_EXIST = "channels/screenshoot_exist";
    
    /**ROUTE FOR CHANNEL PACKAGE*/
    const ROUTE_CHANNELPACKAGE_LIST = "channelpackages/list";
    const ROUTE_CHANNELPACKAGE_CREATE = "channelpackages/create";
    const ROUTE_CHANNELPACKAGE_BYID = "channelpackages/get/";
    const ROUTE_CHANNELPACKAGE_GETCHANNELS = "channelpackages/getchannels/";
    const ROUTE_CHANNELPACKAGE_EDIT = "channelpackages/edit";
    const ROUTE_CHANNELPACKAGE_DELETE = "channelpackages/delete";
    
    /**ROUTE FOR TRANSCODER*/
    const ROUTE_TRANSCODER_START = "transcoder/start";
    const ROUTE_TRANSCODER_STOP = "transcoder/stop";
    const ROUTE_TRANSCODER_CHANNELS_STARTALL = "transcoder/channels/startall";
    const ROUTE_TRANSCODER_CHANNELS_STOPALL = "transcoder/channels/stopall";
    const ROUTE_TRANSCODER_VODPACKAGE_START = "transcoder/vodpackage/start";
    const ROUTE_TRANSCODER_VODPACKAGE_STOP = "transcoder/vodpackage/stop";
    
    /**ROUTE FOR PLAYBACK*/
    const ROUTE_PLAYBACK_START = "playback/start";
    const ROUTE_PLAYBACK_STOP = "playback/stop";
    const ROUTE_PLAYBACK_VODPACKAGES = "playback/vodpackages";
    const ROUTE_PLAYBACK_VODPACKAGES_INFO = "playback/vodpackages/info/";
    const ROUTE_PLAYBACK_CHANNELS = "playback/channels";
    const ROUTE_PLAYBACK_CHANNEL_INFO = "playback/channel/info/";
    
    /**ROUTE FOR VOD GENRES*/
    const ROUTE_VODGENRES_LIST = "vodgenres/list";
    const ROUTE_VODGENRES_CREATE = "vodgenres/create";
    const ROUTE_VODGENRES_BYID = "vodgenres/get/";
    const ROUTE_VODGENRES_EDIT = "vodgenres/edit";
    const ROUTE_VODGENRES_DELETE = "vodgenres/delete";
    
    /**ROUTE FOR VODS*/
    const ROUTE_VODS_LIST = "vods/list";
    const ROUTE_VODS_CREATE = "vods/create";
    const ROUTE_VODS_BYID = "vods/get/";
    const ROUTE_VODS_EDIT = "vods/edit";
    const ROUTE_VODS_PACKAGEREMOVE = "vods/package/remove/";
    const ROUTE_VODS_DELETE = "vods/delete/";
    const ROUTE_VODS_STATUS= "vods/status/";
    const ROUTE_VODS_READTRANSCODERLOG = "vods/readtranscoderlog/";
    const ROUTE_VODS_READDOWNLOADLOG = "vods/readdownloadlog/";
    const ROUTE_VODS_LCOALFILES = "vods/localfiles/";
    
    /**ROUTE FOR SERIES*/
    const ROUTE_SERIES_LIST = "series/list";
    const ROUTE_SERIES_CREATE = "series/create";
    const ROUTE_SERIES_BYID = "series/get/";
    const ROUTE_SERIES_EDIT = "series/edit";
    const ROUTE_SERIES_DELETE = "series/delete/";
    const ROUTE_SERIES_ASARRAY = "series/asarray";
    
    /**ROUTE FOR EPISODES*/
    const ROUTE_EPISODES_LIST = "episodes/list/";
    const ROUTE_EPISODES_CREATE = "episodes/create";
    const ROUTE_EPISODES_BYID = "episodes/get/";
    const ROUTE_EPISODES_EDIT = "episodes/edit";
    const ROUTE_EPISODES_DELETE = "episodes/delete/";
    
    /**ROUTE FOR VOD PACKAGES*/
    const ROUTE_VODPACKAGES_LIST = "vodpackages/list";
    const ROUTE_VODPACKAGES_GETVODS = "vodpackages/getvods/";
    const ROUTE_VODPACKAGES_CREATE = "vodpackages/create";
    const ROUTE_VODPACKAGES_BYID = "vodpackages/get/";
    const ROUTE_VODPACKAGES_EDIT = "vodpackages/edit";
    const ROUTE_VODPACKAGES_DELETE = "vodpackages/delete/";
    const ROUTE_VODPACKAGES_PLAYLIST = "vodpackages/playlist";
    
    /**ROUTE FOR SERIE PACKAGES*/
    const ROUTE_SERIEPACKAGES_LIST = "seriepackages/list";
    const ROUTE_SERIEPACKAGES_GETVODS = "seriepackages/getvods/";
    const ROUTE_SERIEPACKAGES_CREATE = "seriepackages/create";
    const ROUTE_SERIEPACKAGES_BYID = "seriepackages/get/";
    const ROUTE_SERIEPACKAGES_EDIT = "seriepackages/edit";
    const ROUTE_SERIEPACKAGES_DELETE = "seriepackages/delete/";
    
    /**ROUTE FOR API*/
    const ROUTE_API_ACTIVATIONCODE_LOGIN = "activation-code/login";
    const ROUTE_API_ACTIVATIONCODE_MESSAGES = "activation-code/messages/";
    const ROUTE_API_CHANNELS_PROGRAMES = "channels/programmes/";
    const ROUTE_API_CHANNELS_PROGRAMES_DATERANGE = "channels/programmes/";
    const ROUTE_API_CHANNELS_PROGRAMES_BYID = "channels/programmes";
    const ROUTE_API_COUNTRY_LIST = "countries/list";
    const ROUTE_API_TRIAL_ACTIVATIONCODE = "request/trial/activation-code";

    public function render($view, array $parameters = array(), Response $response = null)
    {
        $view = str_replace("themes/default", "themes/" . $this->getParameter("theme"), $view);
        return $this->container->get('templating')->renderResponse($view, $parameters, $response);
    }

    public function getRolePrefix()
    {
        return $this->get('security.authorization_checker')->isGranted('ROLE_SUPER_ADMIN') ? "admin" : "manager";
    }
}
