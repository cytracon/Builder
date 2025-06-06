define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/settings.html')
			},
			controller: function($scope, cytraconBuilderModal) {
				$scope.openModal = function () {
					cytraconBuilderModal.open('settings');
		        }
			}
		}
	}

	return directive;
});