define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/history.html')
			},
			controller: function($rootScope, $scope, cytraconBuilderModal) {
				$scope.$on('openHistoryModal', function() {
					$scope.openModal();
				});
				$scope.openModal = function() {
					cytraconBuilderModal.open('history');
				}
			}
		}
	}

	return directive;
});