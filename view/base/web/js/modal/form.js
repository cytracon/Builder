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

			this.model = form.model;
			var self = this;

			$scope.$emit('enableModalSpinner');
			cytraconBuilderForm.getForm('modals.' + modal.key, function(tabs) {
				self.tabs = tabs;
				$scope.$emit('disableModalSpinner');
			});

			self.onSubmit = function() {
				$rootScope.$broadcast('modal_' + modal.key + '_saved');
				$uibModalInstance.close(self.model);
			}
		}
	}
});