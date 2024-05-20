<?php

if (is_active_sidebar( 'carsidebar' ) === false) {
	return;
}

echo '<aside id="secondary" class="widget-area">';
	dynamic_sidebar('carsidebar');
echo '</aside>';