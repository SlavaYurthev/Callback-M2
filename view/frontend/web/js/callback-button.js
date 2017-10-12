/**
 * Callback
 * 
 * @author Slava Yurthev
 */
define(
	[
		'jquery'
	],
	function(jQuery){
		return function(config, element){
			jQuery(element).hover(function(){
				jQuery(this).removeClass('callback-button-icon-pulse');
			}, function(){
				jQuery(this).addClass('callback-button-icon-pulse');
			});
			jQuery(element).on('click', function(){
				if(typeof window.callbackModal != 'undefined'){
					window.callbackModal.modal('openModal');
				}
			});
		}
	}
);