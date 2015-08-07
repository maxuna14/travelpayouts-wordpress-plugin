<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 07.08.15
 * Time: 16:34
 */

class TPSettingsController extends KPDAdminMenuController{

    public function action()
    {
        // TODO: Implement action() method.
        add_submenu_page( KPDPlUGIN_TEXTDOMAIN,
            _x('Settings',  'add_menu_page page title', KPDPlUGIN_TEXTDOMAIN ),
            _x('Settings',  'add_menu_page page title', KPDPlUGIN_TEXTDOMAIN ),
            'manage_options',
            'tp_control_settings',
            array(&$this, 'render'));
    }

    public function render()
    {
        // TODO: Implement render() method.
        $pathView = KPDPlUGIN_DIR."/app/includes/views/admin/menu/TPSettings.view.php";
        parent::loadView($pathView);
    }

    public function admin_bar_menu()
    {
        // TODO: Implement admin_bar_menu() method.
        $this->admin_bar_add_sub_menu(
            __('Settings', KPDPlUGIN_TEXTDOMAIN ),
            'admin.php?page=tp_control_settings',
            'tp_admin_bar_menu',
            KPDPlUGIN_TEXTDOMAIN.'_tp_control_settings'
        );
    }
}