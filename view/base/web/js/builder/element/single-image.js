define([
	'jquery',
	'angular'
], function($, angular) {

	var directive = function(cytraconBuilderUrl) {
		return {
			replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder/element/single-image.html');
			},
			controller: function($scope, $controller) {
				var parent = $controller('baseController', {$scope: $scope});
				angular.extend(this, parent);

				$scope.getSrc = function() {
					var src = cytraconBuilderUrl.getImageUrl($scope.element.image);

					switch($scope.element.source) {
						case 'media_library':
							if ($scope.element.image)
							src = cytraconBuilderUrl.getImageUrl($scope.element.image);
							break;

						case 'external_link':
							if ($scope.element.custom_src)
							src = $scope.element.custom_src;
							break;
					}

					return src;
				}
			},
			link: function(scope, element) {
				element.find('.mgz-single-image-inner').hover(function() {
					var hoverImage = cytraconBuilderUrl.getImageUrl(scope.element.hover_image);
					if (hoverImage) {
						$(this).find('img').attr('src', hoverImage);
					}
				}, function() {
					var hoverImage = cytraconBuilderUrl.getImageUrl(scope.element.hover_image);
					if (hoverImage && scope.getSrc()) {
						$(this).find('img').attr('src', scope.getSrc());
					}
				});
			},
			controllerAs: 'mgz'
		}
	}

	return directive;
});