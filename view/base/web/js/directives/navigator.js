define([
	'angular'
], function (angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			scope: {
				element: '='
			},
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/navigator_item.html')
			}
		}
	}

	return directive;
});