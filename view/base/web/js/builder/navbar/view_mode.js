define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderService, cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/view_mode.html')
			},
			controller: function($rootScope, $scope) {

				$scope.viewMode  = cytraconBuilderService.getViewMode();

				$scope.viewModes = {
					xl: {
						title: 'Desktop',
						icon: 'mgz-icon mgz-icon-desktop'
					},
					lg: {
						title: 'Tablet Landscape',
						icon: 'mgz-icon mgz-icon-tablet-landscape'
					},
					md: {
						title: 'Tablet Portrait',
						icon: 'mgz-icon mgz-icon-tablet-portrait'
					},
					sm: {
						title: 'Mobile Landscape',
						icon: 'mgz-icon mgz-icon-mobile-landscape'
					},
					xs: {
						title: 'Mobile Portrait',
						icon: 'mgz-icon mgz-icon-mobile-portrait'
					}
				}

				$scope.changeViewMode = function(viewMode) {
					$scope.viewMode = viewMode;
					cytraconBuilderService.setViewMode(viewMode);
					$rootScope.fullscreen = true;
					$rootScope.$broadcast('loadElements');
				}

				$scope.$watch('viewMode', function(viewMode) {
					$rootScope.$broadcast('changedViewMode', viewMode);
				});

				$scope.$on('setViewMode', function(event, viewMode) {
					$scope.viewMode = viewMode;
					cytraconBuilderService.setViewMode(viewMode);
				});
			}
		}
	}

	return directive;
});