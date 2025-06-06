define(['angular'], function(angular) {

	return {
		controller: function($scope, cytraconBuilderService, $timeout) {
			$scope.to.loading = true;
			cytraconBuilderService.getBuilderConfig('animationIn', function(options) {
				$scope.styles = angular.copy(options);
				$timeout(function() {
					$scope.to.loading = false;
				})
			});

			$scope.loadAnimate = function() {
				$scope.animateClass = $scope.fc.$viewValue + ' animated';
				$timeout(function() {
					$scope.animateClass = '';
				}, 1000);
			};
		}
	}
});