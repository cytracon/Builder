define([
	'jquery',
	'angular'
], function ($, angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getViewFileUrl('Cytracon_Builder/js/templates/directives/element-actions.html');
			}
		}
	}

	return directive;
});