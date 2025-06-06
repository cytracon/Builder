define([
	'jquery',
	'waypoints'
], function ($) {

	var cytraconBuilderDir = function(profileManager, $timeout, cytraconBuilderUrl, $templateRequest) {
		return {
			scope: {
				profile: '='
			},
    		replace: true,
			templateUrl: function(elem) {
				return cytraconBuilderUrl.getTemplateUrl(elem, 'Cytracon_Builder/js/templates/builder.html')
			},
			controller: function($rootScope, $scope, cytraconBuilderModal, historyManager, cytraconBuilderService, cytraconBuilderConfig) {
				$rootScope.builderId = cytraconBuilderService.getUniqueId();

				$scope.$on('openElementsModal', function(event) {
					$scope.openModal();
				});

				$scope.openModal = function() {
					cytraconBuilderModal.open('elements').result.then(function() {}, function() {
						cytraconBuilderModal.setElement(null);
						cytraconBuilderModal.setAction(null);
						cytraconBuilderModal.setData(null);
						cytraconBuilderModal.setOpenModal(null);
					});
				}

				$rootScope.$on('loadStyles', function(e, draggingElement) {
					$scope.loadStyles();
				});

		        $scope.loadStyles = function() {
		        	if ($rootScope.builderConfig.loadStylesUrl && $rootScope.profile.elements && $rootScope.profile.elements.length) {
		        		cytraconBuilderService.post($rootScope.builderConfig.loadStylesUrl, {
		        			profile: profileManager.toString()
		        		}, true, function(res) {
		        			if (res.message) {
		        				alert(res.message);
		        			}
		        			if (res.status) {
		        				$('#' + $rootScope.builderConfig.targetId + '-styles').html(res.html);
		        			}
		        		});
			        }
		        }

		        $templateRequest(cytraconBuilderUrl.getViewFileUrl('Cytracon_Builder/js/templates/navigator/element/list.html')).then(function(html) {
		        	$timeout(function() {
						$('.' + $rootScope.builderConfig.htmlId + '-spinner').remove();
						if (profileManager.getKey()) {
							if (cytraconBuilderService.isJSON(profileManager.getContent())) {
								$('.' + $rootScope.rootId).addClass('mgz-deactive-builder');
								$('.' + $rootScope.rootId).removeClass('mgz-active-builder');
								$rootScope.$broadcast('importShortcode');
							} else {
								if (profileManager.getContent()) {
									$('.' + $rootScope.rootId).addClass('mgz-active-builder');
									$('.' + $rootScope.rootId).removeClass('mgz-deactive-builder');
								} else {
									$('.' + $rootScope.rootId).addClass('mgz-deactive-builder');
									$('.' + $rootScope.rootId).removeClass('mgz-active-builder');
								}
							}
						} else {
							$rootScope.$broadcast('importShortcode');
						}
			        }, 100);
		        });

		        $scope.$on('addElement', function(e, item) {
		        	var elem, action, openModal, data, type;
		        	if (item && item.hasOwnProperty('elem')) elem = item.elem;
		        	if (item && item.hasOwnProperty('action')) action = item.action;
		        	if (item && item.hasOwnProperty('openModal')) openModal = item.openModal;
		        	if (item && item.hasOwnProperty('data')) data = item.data;
		        	if (item && item.hasOwnProperty('type')) type = item.type;
		        	if (type) {
		        		$rootScope.$broadcast('addNewElment', {
							elem: elem,
							type: type,
							action: 'append',
							openModal: openModal,
							data: data
						});
		        	} else {
		        		if (elem) cytraconBuilderModal.setElement(elem);
						if (action) cytraconBuilderModal.setAction(action);
						if (openModal) cytraconBuilderModal.setOpenModal(openModal);
						if (data) cytraconBuilderModal.setData(data);
						$rootScope.$broadcast('openElementsModal');
		        	}
				});

				var loadAnimation = function() {
					if ($(".mgz-animated:not(.mgz_start_animation)").length) {
						$(".mgz-animated:not(.mgz_start_animation)").waypoint(function() {
							var self = this;
							var delayTime = 0;
							if ($(this.element).data('animation-delay')) {
								delayTime = $(this.element).data('animation-delay');
							}
							var durationTime = 0;
							if ($(this.element).data('animation-duration')) {
								durationTime = $(this.element).data('animation-duration');
							}
							if (durationTime) $(self.element).css("animation-duration", durationTime + 's');

							setTimeout(function() {
								$(self.element).addClass("mgz_start_animation animated")
							}, delayTime * 1000);
						}, {
							offset: "85%"
						});
					}
				}

				$scope.$on('editedElement', function(e, elem) {
					loadAnimation();
				});
			}
		}
	};

	return cytraconBuilderDir;
});