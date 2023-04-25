<?php
    for($i=0; $i<6; $i++){ 
        echo '<button onclick="calendar_button_trigger(this.value)" value="' . $calendar[$i] . '" class="calendar_button"><p id="' . $calendar[$i] . '">' . strtoupper(strftime("%a %d %b",strtotime($calendar[$i]))) . '</p></button>';
    }