define(["jquery", "angular"], function ($, angular) {
    var directive = function (
        $rootScope,
        cytraconBuilderEditor,
        cytraconBuilderService,
        cytraconBuilderFilter,
        $document,
        $timeout
    ) {
        return {
            require: "ngModel",
            link: function (scope, element, attrs, ngModel) {
                element.addClass("mgz-inline-editor");
                element.attr("contenteditable", true);

                scope.id = cytraconBuilderService.uniqueid();
                scope.wysiwyg = Object.extend(
                    angular.copy($rootScope.builderConfig.wysiwyg),
                    scope.wysiwyg
                );
                scope.wysiwyg["inline"] = true;
                scope.wysiwyg["fixed_toolbar_container"] =
                    "." + scope.element.id + " .mgz-element-inner";
                element.attr("id", scope.id);

                ngModel.$render = function () {
                    element.html(
                        cytraconBuilderFilter.encodeContent(
                            ngModel.$viewValue,
                            true
                        ) || ""
                    );
                };

                element.bind("click", function (e) {
                    $rootScope.$broadcast("disableEditing", scope.element);
                    $timeout(function () {
                        scope.element.builder.editing = true;
                    }, 1000);
                    e.stopPropagation();
                });

                const config = scope.wysiwyg;
                if (config) {
                    element.on("mouseenter", function () {
                        cytraconBuilderEditor.initTinymce(
                            scope.id,
                            config,
                            function (value) {
                                ngModel.$setViewValue(
                                    cytraconBuilderFilter.decodeContent(cytraconBuilderFilter.convertImageToDirective(value))
                                );
                            }
                        );
                    });
                }

                element.bind("blur", function (e) {
                    if (scope.element) {
                        $timeout(function () {
                            scope.element.builder.editing = false;
                        });
                    }
                });

                scope.$on("disableEditing", function (e, elem) {
                    if (scope.element) {
                        if (elem.id !== scope.element.id) {
                            scope.element.builder.editing = false;
                        }
                    }
                });
            },
        };
    };

    return directive;
});
