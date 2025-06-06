define([
	'jquery',
	'angular'
], function($, angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/clear.html')
			},
			controller: function($rootScope, $scope, cytraconBuilderModal) {
				$scope.openModal = function(e) {
					cytraconBuilderModal.open('clear_layout');
				}
			}
		}
	}

	return directive;
});