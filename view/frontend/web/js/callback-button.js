/**
 * Callback
 * 
 * @author Slava Yurthev
 */

require(
	[
		'jquery',
		'Magento_Ui/js/modal/modal'
	],
	function(jQuery, modal){
		jQuery(function(){
			jQuery('.callback-button-icon').hover(function(){
				jQuery(this).removeClass('callback-button-icon-pulse');
			}, function(){
				jQuery(this).addClass('callback-button-icon-pulse');
			});
			var options = {
				buttons: [{
					text: jQuery.mage.__('Send'),
					class: 'callback-button-send primary',
					click: function () {
						if(jQuery('#callback-form').valid()){
							jQuery('#callback-form').submit();
						}
					}
				}]
			};
			if(jQuery('#callback-modal').length>0){
				modal(options, jQuery('#callback-modal'));
			}
			callback = function(){
				jQuery('#callback-modal').modal('openModal');
			}
		});
	}
);