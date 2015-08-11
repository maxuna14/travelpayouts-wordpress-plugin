<?php
/**
 * Created by PhpStorm.
 * User: freeman
 * Date: 10.08.15
 * Time: 17:54
 */

class TPDashboardView extends TPView{
    public $model;
    public function __construct($model)
    {
        // TODO: Implement __construct() method.
        $this->model = $model;
    }
    public function listIncome(){
        $output = '';
        $output = '<div class="TP-incomeSection">
            <div class="TP-ourIncome">
                <p class="TP-titleIncome">'.__('Your income', KPDPlUGIN_TEXTDOMAIN ).':</p>
                <div class="listIncome">
                    <div class="itemIncome">
                        <p>'.$this->tpGetDay($this->model->detailed_sales["current_month"]["sales"][date("Y-m-d")])
                            .$this->getCurrencyView($this->model->balance["data"]["currency"]).'</p>
                        <span>'.__('today', KPDPlUGIN_TEXTDOMAIN ).'</span>
                    </div>
                    <div class="itemIncome">
                        <p>'.$this->tpGetDay($this->model->detailed_sales["current_month"]["sales"][date("Y-m-d", time() - 86400)])
                            .$this->getCurrencyView($this->model->balance["data"]["currency"]).'</p>
                        <span>'.__('yesterday', KPDPlUGIN_TEXTDOMAIN ).'</span>
                    </div>
                    <div class="itemIncome">
                        <p>'.$this->tpGetMonth($this->model->detailed_sales["current_month"]["sales"])
                            .$this->getCurrencyView($this->model->balance["data"]["currency"]).'</p>
                        <span>'.__('this month', KPDPlUGIN_TEXTDOMAIN ).'</span>
                    </div>
                    <div class="itemIncome">
                        <p>'.$this->tpGetMonth($this->model->detailed_sales["last_month"]["sales"])
                            .$this->getCurrencyView($this->model->balance["data"]["currency"]).'</p>
                        <span>'.__('for the last month', KPDPlUGIN_TEXTDOMAIN ).'</span>
                    </div>
                    <div class="itemIncome">
                        <p>'.$this->model->balance["data"]["balance"]
                            .$this->getCurrencyView($this->model->balance["data"]["currency"]).'</p>
                        <span>'.__('unpaid earnings', KPDPlUGIN_TEXTDOMAIN ).'</span>
                    </div>
                </div>
            </div>

        </div>';
        echo $output;
    }

    /**
     * @param $day
     * @return int
     */
    public function tpGetDay($day){
        $TPDay = 0;
        if(!empty($day)){
            foreach($day as $key=>$sales){
                foreach($sales as $value){
                    $TPDay += $value["paid_clicks_profit"];
                    $TPDay += $value["paid_bookings_profit"];
                }
            }
        }

        return $TPDay;
    }

    /**
     * @param $month
     * @return int
     */
    public function tpGetMonth($month){
        $TPMonth = 0;
        foreach($month as $key=>$sales){
            foreach($sales as $date){
                foreach($date as $value){
                    $TPMonth += $value["paid_clicks_profit"];
                    $TPMonth += $value["paid_bookings_profit"];
                }
            }
        }
        return $TPMonth;
    }

    public function tpGetNews(){
        $output = '';
        $output .= '<ul class="TP-ListNewsMin">';
        if(!empty($this->model->rss["data"]["item"])) {
            foreach ($this->model->rss["data"]["item"] as $tpNews) {
                $output .= '<li>
                    <div class="TP-NewsDate">
                        <p>' . date('d.m', strtotime($tpNews["pubDate"])) . '</p>
                        <span>' . date('Y', strtotime($tpNews["pubDate"])) . '</span>
                    </div>
                    <div class="TP-NewsContentMin">
                        ' . $this->tpDashboardNewsLink($tpNews["title"], $tpNews["link"]) . '
                        <p>

                        </p>
                    </div>
                </li>';
            }
        }
        //strip_tags($tpNews["description"]);
        $output .= '</ul>';
        echo $output;
    }
    /**
     * @param string $title
     * @param string $link
     * @return string
     */
    public function tpDashboardNewsLink($title = "", $link =""){
        $target_url = '';
        if(isset(TPPlugin::$options['config']['target_url'])) $target_url ='target="_blank"';
        return '<a href="'.$link.'?utm_source=wp_plugin" '.$target_url.'>'.$title.'</a>';
    }
}