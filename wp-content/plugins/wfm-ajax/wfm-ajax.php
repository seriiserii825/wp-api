<?php 

	add_action( 'admin_menu', 'wfm_admin_menu' );

	function wfm_admin_menu(){
		add_options_page( 'Опции темы', 'Опции (AJAX)', 'manage_options', 'wfm-theme-options', 'wfm_options_page' );
	}

	function wfm_options_page(){
			
	}