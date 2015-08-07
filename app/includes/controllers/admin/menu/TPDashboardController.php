<?php
/**
 * Class TPDashboardController
 */
class TPDashboardController extends KPDAdminMenuController{
    public function action()
    {
        // TODO: Implement action() method.
        add_menu_page(
            _x('Travelpayouts',  'add_menu_page page title' , KPDPlUGIN_TEXTDOMAIN ),
            _x('Travelpayouts',     'add_menu_page menu title' , KPDPlUGIN_TEXTDOMAIN ),
            'manage_options',
            KPDPlUGIN_TEXTDOMAIN,
            array(&$this,'render'),
            KPDPlUGIN_URL .'app/public/images/tp.png'
        );
    }

    public function render()
    {
        // TODO: Implement render() method.
        $pathView = KPDPlUGIN_DIR."/app/includes/views/admin/menu/TPDashboard.view.php";
        parent::loadView($pathView);
    }

    public function admin_bar_menu()
    {
        // TODO: Implement admin_bar_menu() method.
        $this->admin_bar_add_root_menu(
            "Travelpayouts",
            "tp_admin_bar_menu",
            "admin.php?page=".KPDPlUGIN_TEXTDOMAIN
        );
    }
}