define([
	'jquery',
	'angular',
    'Cytracon_Builder/js/ui/form/element/color-picker-palette'
], function ($, angular, palette) {

	var directive = function(cytraconBuilderUrl, $timeout, $rootScope) {
		return {
			replace: true,
			require: "ngModel",
			scope: {
				config: '='
			},
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/directives/color.html');
			},
			link: function(scope, element, attrs, ngModel) {
				var initColorPicker = function() {
					var config = {
						containerClassName: 'mgz-spectrum',
		                chooseText: 'Apply',
		                cancelText: 'Cancel',
		                maxSelectionSize: 8,
		                clickoutFiresChange: true,
		                allowEmpty: true,
		                localStorageKey: 'cytracon.spectrum',
		                palette: palette,
		                showInput: true,
		                showInitial: false,
		                showPalette: true,
		                showAlpha: true,
		                showSelectionPalette: true,
		                preferredFormat: 'hex',
		                color: ngModel.$viewValue,
		                hide : function(c) {
		                	$timeout(function() {
		                		if (c) ngModel.$setViewValue(c.toString());
		                	});
		                }
		            };
		            config = angular.extend(config, scope.config);
		            element.spectrum(config);
		        }
	            setTimeout(function() {
	            	initColorPicker();
	            });
			}
		}
	}

	return directive;
});