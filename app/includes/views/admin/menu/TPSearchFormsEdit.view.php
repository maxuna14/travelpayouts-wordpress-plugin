<div class="TPWrapper TPWrapper-long">

    <p class="TPMainTitle"><?php _e('Search forms', TPOPlUGIN_TEXTDOMAIN); ?> </p>

    <div class="TPmainContent TP-BalanceContent TP-SettingContent">
        <p class="TP-SettingTitle"><?php _e('Adding shortcode', TPOPlUGIN_TEXTDOMAIN); ?> </p>

        <form method="post" action="admin.php?page=tp_control_search_shortcodes&action=update_search_shortcode"
              method="post" name="searchShortcodeAdd">
            <div class="TP-LocalHead TP-shortLocal">
                <label>
                    <span><?php _e('Title ', TPOPlUGIN_TEXTDOMAIN) ?></span>
                    <input type="text" name="search_shortcode_title" required value="<?php echo $this->data['title'] ?>"/>
                </label>
                <label>
                    <span><?php _e('Type shortcode', TPOPlUGIN_TEXTDOMAIN) ?></span>
                    <select class="TP-Zelect TPSelectSearchShortcodeType" name="search_shortcode_type" required="required">
                        <option value="0" <?php echo selected($this->data['type_shortcode'], 0); ?>><?php echo _x('Search Form', 'select_search_form', TPOPlUGIN_TEXTDOMAIN) ?></option>
                        <option value="1" <?php echo selected($this->data['type_shortcode'], 1); ?>><?php _e('Other', TPOPlUGIN_TEXTDOMAIN) ?></option>
                    </select>
                </label>
                <div>
                    <label class="TP-inputTextShort">
                        <span><?php _e('TravelPayouts Form Code', TPOPlUGIN_TEXTDOMAIN) ?></span>
                        <span><?php _e('Make sure you have unchecked the "Short Code" and "Iframe Code" boxes', TPOPlUGIN_TEXTDOMAIN) ?></span>
                        <textarea name="search_shortcode_code_form" class="TPSearchShortcodeCodeForm"><?php echo $this->data['code_form'] ?></textarea>
                    </label>
                </div>
                <label>
                    <span><?php _e('Default City of Departure', TPOPlUGIN_TEXTDOMAIN) ?></span>
                    <input type="text" name="search_shortcode_from" class="searchShortcodeAutocomplete"
                           value="<?php echo $this->data['from_city'] ?>" />
                </label>
                <label>
                    <span><?php _e('Default City of Arrival', TPOPlUGIN_TEXTDOMAIN) ?></span>
                    <input type="text" name="search_shortcode_to" class="searchShortcodeAutocomplete"
                           value="<?php echo $this->data['to_city'] ?>"/>
                </label>

                <p class="TP-ViewShortCode"><?php _e('Shortcode', TPOPlUGIN_TEXTDOMAIN) ?>:
                    <span>[tp_search_shortcodes id=<?php echo $this->data['id'] ?>]</span>
                </p>
            </div>

            <p class="TP-sescriptionShort">
                <?php _e('Shortcode will be automatically generated after you press the Save Changes button. It can also be placed into your posts right away', TPOPlUGIN_TEXTDOMAIN) ?>
            </p>

            <div class="TP-navsUserShort">
                <a href="admin.php?page=tp_control_search_shortcodes" class="TP-deleteShortLincks TP-deleteShortLincks--cust">
                    <i></i><?php _e('cancel', TPOPlUGIN_TEXTDOMAIN) ?>
                </a>
                <input type="hidden" name="search_shortcodes_id" value="<?php echo $this->data['id'] ?>">
                <button class="TP-BtnTab">
                    <?php _e('save changes', TPOPlUGIN_TEXTDOMAIN) ?>
                </button>
            </div>


        </form>



    </div>
</div>