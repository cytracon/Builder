define([
	'jquery',
	'angular'
], function($, angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/modal/button/save.html');
			},
			controller: function($scope) {
				$scope.disabled = false;

				$scope.$on('disableSaveBtn', function() {
					$scope.disabled = true;
				});

				$scope.$on('enableSaveBtn', function() {
					$scope.disabled = false;
				});
			}
		}
	}

	return directive;
});