define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/navigator.html')
			},
			controller: function($rootScope, $scope, cytraconBuilderModal) {
				$scope.$on('openNavigatorModal', function() {
					$scope.openModal();
				});
				$scope.openModal = function() {
					cytraconBuilderModal.open('navigator').result.then(function() {}, function() {
						if($rootScope.activedElement) $rootScope.activedElement.builder.actived = false;
					});
				}
			}
		}
	}

	return directive;
});