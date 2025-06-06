define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/my_templates.html')
			},
			controller: function($scope, cytraconBuilderModal) {
				$scope.openTemplatesModal = function() {
					cytraconBuilderModal.open('templates');
				}
			}
		}
	}

	return directive;
});