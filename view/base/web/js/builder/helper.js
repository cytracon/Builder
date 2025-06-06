define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/helper.html')
			},
			controller: function($rootScope, $scope) {

				$scope.addRowElement = function(columns) {
					$rootScope.$broadcast('addRootRowElement', columns);
					$rootScope.$broadcast('exportShortcode');
				}

				$scope.openModal = function() {
					$rootScope.$broadcast('openElementsModal', true);
				}
			}
		}
	}

	return directive;
});