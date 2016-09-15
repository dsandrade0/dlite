
(function($) {
	"use strict";

	$.fn.originalValidate = $.fn.validate;
	$.fn.validate = function(options) {
		var newOptions = {
			errorPlacement: function(error, element) {
				var $formGroup = element.parent(".form-group");
				error.appendTo( $formGroup.find('.help-block') );
			},
			errorElement: 'span',
			errorClass: 'has-error',
			validClass: 'has-success',
			highlight: function(element, errorClass, validClass) {
				$(element).parents('.form-group').addClass(errorClass).removeClass(validClass);
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.form-group').removeClass(errorClass).addClass(validClass);
			}
		};
		$.extend(newOptions, options);
		return this.originalValidate(newOptions);
	};

})(jQuery);