define([
	'angular'
], function (angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			scope: {
				element: '=element'
			},
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/modal/elements_element.html')
			}
		}
	}

	return directive;
});