define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/element/list.html');
			},
			controller: function($scope, $controller) {
				var parent = $controller('listController', {$scope: $scope});
				angular.extend(this, parent);
			},
			controllerAs: 'mgz'
		}
	}

	return directive;
});