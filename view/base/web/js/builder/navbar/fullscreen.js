define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/fullscreen.html')
			},
			controller: function($rootScope, $scope) {
				$scope.toggleFullscreen = function() {
					$rootScope.fullscreen = !$rootScope.fullscreen;
					if (!$rootScope.fullscreen) {
						$rootScope.$broadcast('setViewMode', 'xl');
					}
				}
			}
		}
	}

	return directive;
});