define([
	'jquery',
	'underscore',
    'uiRegistry'
], function($, _, registry) {

	return {
		controller: function($scope, cytraconBuilderModal, cytraconBuilderService, cytraconBuilderFilter) {
			$scope.type = 'Custom';

            $scope.getLinkParams = function(link) {
				var params = {
					type: 'custom',
					url: '',
					id: 0,
					title: '',
					extra: '',
					nofollow: 0,
					blank: 0
		    	};
		    	if (link) {
					if (link.indexOf('{{mgzlink') === -1) {
						params['url']  = link;
						params['type'] = 'custom';
					} else {
						link.gsub(/\{\{mgzlink(.*?)\}\}/i, function (match) {
							params = cytraconBuilderFilter.parseAttributesString(match[1]);
						});
					}
				}
				if (params['url']) params['url'] = cytraconBuilderService.removeslashes(params['url']);
				return params;
            }

			$scope.selectUrl = function() {
				cytraconBuilderModal.open('link', {
					backdrop: true,
					resolve: {
						form: {
							model: $scope.getLinkParams($scope.model[$scope.options.key])	
						}
					}
				}, function(model) {
					var link = '{{mgzlink';
					angular.forEach(model, function (value, key) {
						if (angular.isString(value)) {
							link += ' ' + key + '="' + cytraconBuilderService.addslashes(value) + '"';
						} else {
							link += ' ' + key + '=' + value;
						}
					});
					link += '}}';
					$scope.model[$scope.options.key] = link;
				});
			}

			$scope.$watch('model.' + $scope.options.key, function(link) {
				var params = $scope.getLinkParams(link);
				var type = params.type;
				if (type == 'custom') {
					$scope.type = 'Custom Url';
					$scope.linkName = params.url;
					$scope.title = params.title;
				} else {
					$scope.to.loading = true;
					cytraconBuilderService.post('mgzbuilder/ajax/itemInfo', {
						type: type,
						q: params.id
					}, true, function(res) {
						$scope.$apply(function() {
							$scope.title      = params.title;
							$scope.type       = cytraconBuilderService.capitalize(type);
							$scope.linkName   = res.label;
							$scope.to.loading = false;
						})
					});	
				}
			});
		}
	}
});