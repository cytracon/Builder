define(function() {

	return {
		controller: function($scope, $timeout, cytraconBuilderService) {
			$scope.to.loading = true;
			cytraconBuilderService.getBuilderConfig('animationOut', function(options) {
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