define([
	'jquery',
	'angular'
], function($, angular) {

	return {
		templateUrl: 'Cytracon_Builder/js/templates/modal/form.html',
		controller: function(
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
			cytraconBuilderForm.getForm('modals.templates', function(tabs) {
				self.tabs = tabs;
				$scope.$emit('disableModalSpinner');
			});
		}
	}
});