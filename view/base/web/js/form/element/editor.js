define([
    'jquery',
    'angular'
], function($, angular) {

    return {
        controller: function($rootScope, $scope, cytraconBuilderService, cytraconBuilderEditor, cytraconBuilderFilter) {
            $scope.to.loading = true;
            var config = Object.extend(angular.copy($rootScope.builderConfig.wysiwyg), $scope.to.wysiwyg);
            $scope.id = cytraconBuilderService.uniqueid();
            $scope.content = $scope.model[$scope.options.key];
            cytraconBuilderEditor.initTinymce($scope.id, config, function(value) {
                $scope.content = $scope.model[$scope.options.key] = cytraconBuilderFilter.decodeContent(value);
            }, function() {
                $scope.to.loading = false;
            });
        }
    }
})