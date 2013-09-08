<?php
/***
 * Theme Hooks
 *
 * Contains several functions which add hooks on various parts in the theme.
 * You can use that hooks to add your own code to the theme without modifying the original files.
 *
 */
	
	// Adding hook just before #wrapper div
	function themezee_wrapper_before() {
		do_action('zee_wrapper_before');
	}
	
	// Adding hook just after #wrapper div
	function themezee_wrapper_after() {
		do_action('zee_wrapper_after');
	}
	
	
	// Adding hook just before #header div
	function themezee_header_before() {
		do_action('zee_header_before');
	}
	
	// Adding hook just after #header div
	function themezee_header_after() {
		do_action('zee_header_after');
	}
	
	
	// Adding hook just before sidebar widgets
	function themezee_widgets_before() {
		do_action('zee_widgets_before');
	}
	
	// Adding hook just after sidebar
	function themezee_widgets_after() {
		do_action('zee_widgets_after');
	}
	
	
	// Adding hook just before #footer div
	function themezee_footer_before() {
		do_action('zee_footer_before');
	}
	
	// Adding hook just after #footer div
	function themezee_footer_after() {
		do_action('zee_footer_after');
	}
	
	
	// Adding hook just before SocialMedia buttons
	function themezee_socialmedia_widget_before() {
		do_action('zee_socialmedia_widget_before');
	}
	
	// Adding hook just after SocialMedia buttons
	function themezee_socialmedia_widget_after() {
		do_action('zee_socialmedia_widget_after');
	}
	
?>