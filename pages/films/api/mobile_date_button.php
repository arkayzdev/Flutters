<?php 
        echo '<div id="a"><input id="switch_btn_mobile" style="display:none;" onchange="calendar_button_date(this.value, ' . $_GET['id'] . ')"  type="date" value="' . date('Y-m-d') . '" min="' . date('Y-m-d') . '"></div>';
