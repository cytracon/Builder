define([
	'jquery',
	'angular'
], function ($, angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			scope: {
				element: '='
			},
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/navigator/element/profile.html');
			},
			controller: function($scope, $controller) {
				var parent = $controller('baseController', {$scope: $scope});
				angular.extend(this, parent);
				$scope.listVisible = true;
			},
			controllerAs: 'mgz'
		}
	}

	return directive;
});