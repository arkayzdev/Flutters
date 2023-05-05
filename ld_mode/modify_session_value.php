<?php
if ($_GET['ld_mode'] == 1){
    echo '<i style="color: white" class="uil uil-moon"></i>';
} elseif ($_GET['ld_mode'] == 0) {
    echo '<i style="color: white" class="uil uil-sun"></i>';
}
