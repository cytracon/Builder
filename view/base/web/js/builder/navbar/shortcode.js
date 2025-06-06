define([
	'angular'
], function(angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/navbar/shortcode.html')
			},
			controller: function($scope, cytraconBuilderModal) {
				$scope.openProfileShortcodeModal = function() {
					cytraconBuilderModal.open('profileShortcode');
				}
			}
		}
	}

	return directive;
});