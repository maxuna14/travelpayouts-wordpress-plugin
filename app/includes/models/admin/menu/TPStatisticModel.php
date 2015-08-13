<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 12.08.15
 * Time: 12:05
 */

class TPStatisticModel extends TPDashboardModel{
    public $balance;
    public $detailed_sales;
    public $payments;
    public function __construct(){
        add_action( 'admin_init', array( &$this, 'setData' ) );
        add_action('wp_ajax_tp_get_detailed_sales',      array( &$this, 'tpGetDetailedSalesAjax'));
        add_action('wp_ajax_nopriv_tp_get_detailed_sales', array( &$this, 'tpGetDetailedSalesAjax'));
        add_action('wp_ajax_tp_save_stats_total',      array( &$this, 'tpSaveStatsTotal'));
        add_action('wp_ajax_nopriv_tp_save_stats_total',array( &$this, 'tpSaveStatsTotal'));
    }
    public function setData(){
        $this->balance = $this->tpGetBalance();
        $this->detailed_sales = $this->tpGetDetailedSales();
        $this->payments = $this->tpGetPayments();
    }
    public function tpGetDetailedSales(){
        $cacheKey = "TPCacheKey_TPDetailedSalesStats";
        $TPDetailedSales = array();
        if ( false === ( $TPDetailedSales = get_transient($cacheKey) ) ) {
            $TPDetailedSales = TPPlugin::$TPRequestApi->get_detailed_sales();
            $TPDetailedSales = array_reverse($TPDetailedSales["sales"]);
            set_transient( $cacheKey, $TPDetailedSales, MINUTE_IN_SECONDS * 10);
        }
        return $TPDetailedSales;
    }
    public function tpGetPayments(){
        $cacheKey = "TPCacheKey_TPPaymentsStats";
        $TPpayments = array();
        if ( false === ( $TPpayments = get_transient($cacheKey) ) ) {
            $TPpayments = TPPlugin::$TPRequestApi->get_payments();
            $TPpayments = array_reverse($TPpayments["payments"]);
            set_transient( $cacheKey, $TPpayments, DAY_IN_SECONDS);
        }
        return $TPpayments;

    }
    public function tpGetDetailedSalesAjax()
    {
        if (isset($_POST)) {
            $output = '';
            $TPDetailedSales = TPPlugin::$TPRequestApi->get_detailed_sales(
                array('date' => date("Y-m-d", strtotime($_POST["date"])))
            );
            $TPDetailedSalesSort = array();
            $TPDetailedSalesSort = $TPDetailedSales["sales"];
            $TPDetailedSalesSort = array_reverse($TPDetailedSalesSort);
            $output = TPStatisticView::tableReport($TPDetailedSalesSort);
            echo json_encode(array('table' => $output,
                'date' => '<span id="infoDateReport">' . date_i18n('F Y', strtotime($_POST["date"])) . '</span>'),
                JSON_HEX_APOS | JSON_HEX_QUOT);
        }
    }
    public function tpSaveStatsTotal(){
        if(isset($_POST)){
            if($_POST["data"] === "true") {
                TPPlugin::$options["admin_settings"]["total_stats"] = true;
            }
            else {
                TPPlugin::$options["admin_settings"]["total_stats"] = false;
            }

            update_option( KPDPlUGIN_OPTION_NAME, TPPlugin::$options);
            //error_log(print_r($this->TPOptions, true));
        }
    }
}