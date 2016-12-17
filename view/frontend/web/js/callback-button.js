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
	function($, modal){
		$('.callback-button-icon').hover(function(){
			$(this).removeClass('callback-button-icon-pulse');
		}, function(){
			$(this).addClass('callback-button-icon-pulse');
		});
		var options = {
			buttons: [{
				text: $.mage.__('Send'),
				class: 'callback-button-send primary',
				click: function () {
					if($('#callback-form').valid()){
						$('#callback-form').submit();
					}
				}
			}]
		};
		if($('#callback-modal').length>0){
			modal(options, $('#callback-modal'));
		}
		callback = function(){
			$('#callback-modal').modal('openModal');
		}
	}
);