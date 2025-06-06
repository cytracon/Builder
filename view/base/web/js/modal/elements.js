define([
	'jquery',
	'angular'
], function($, angular) {

	return {
		templateUrl: 'Cytracon_Builder/js/templates/modal/elements.html',
		controller: function(
			$rootScope, 
			$scope, 
			$uibModalInstance, 
			$controller, 
			form,
			modal,
			elementManager,
			cytraconBuilderModal
		) {
			var parent = $controller('modalBaseController', {$scope: $scope, $uibModalInstance: $uibModalInstance, modal: modal, form: form});
			angular.extend(this, parent);

			var self = this;
			self.allTab = {
				name: 'All',
				type: 'all',
				elements: _.filter(elementManager.elements, function(element) {
					return elementManager.isVisibleElement(element);
				})
			};

			self.search         = '';
			self.searchElements = [];
			self.model          = {};
			self.tabs           = {};
			self.tabs['all']    = angular.copy(self.allTab);

			_.each(elementManager.groups, function(group) {
				group['elements'] = _.filter(self.allTab.elements, function(element) {
					return element.group == group.type;
				});
				if (group.elements.length) self.tabs[group.type] = group;
			});

			self.clearSearch = function() {
				self.search         = '';
				self.searchElements = [];
				self.tabs['all']    = angular.copy(self.allTab);
			}

			self.activeTab = function(tab) {
				self.clearSearch();
			}

			self.addElement = function(element) {
				$uibModalInstance.dismiss('cancel');
				$rootScope.$broadcast('addNewElment', {
					elem: cytraconBuilderModal.getElement(),
					type: element.type,
					action: cytraconBuilderModal.getAction(),
					openModal: cytraconBuilderModal.getOpenModal(),
					data: cytraconBuilderModal.getData()
				});
			}
		}
	}
});