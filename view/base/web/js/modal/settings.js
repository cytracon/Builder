define([
	'jquery',
	'angular'
], function($, angular) {

	return {
		templateUrl: 'Cytracon_Builder/js/templates/modal/form.html',
		controller: function(
			$rootScope, 
			$scope, 
			$uibModalInstance, 
			$controller, 
			form,
			modal,
			cytraconBuilderForm
		) {
			var parent = $controller('modalBaseController', {$scope: $scope, $uibModalInstance: $uibModalInstance, modal: modal, form: form});
			angular.extend(this, parent);

			var self = this;

			$scope.$emit('enableModalSpinner');
			cytraconBuilderForm.getForm('modals.settings', function(tabs) {
				self.tabs = tabs;
				self.model = angular.copy($rootScope.profile);
				$scope.$emit('disableModalSpinner');
			});

			self.onSubmit = function() {
				angular.merge($rootScope.profile, self.model);
				$rootScope.$broadcast('exportShortcode');
				$uibModalInstance.close(self.model);
			}
		}
	}
});