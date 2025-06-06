define([
	'angular',
	'formly',
	'Cytracon_Builder/js/factories/config',
	'Cytracon_Builder/js/services/cytraconBuilder',
	'Cytracon_Builder/js/services/url',
	'Cytracon_Builder/js/services/modal',
	'Cytracon_Builder/js/services/element',
	'Cytracon_Builder/js/services/profile',
	'Cytracon_Builder/js/services/form',
	'Cytracon_Builder/js/services/editor',
	'Cytracon_Builder/js/services/filter',
	'Cytracon_Builder/js/services/history',
	'Cytracon_Builder/js/controllers/base',
	'Cytracon_Builder/js/controllers/list',
	'Cytracon_Builder/js/controllers/modal',
	'Cytracon_Builder/js/controllers/toolbar',
	'Cytracon_Builder/js/directives/cytraconBuilder',
	'Cytracon_Builder/js/directives/modalElement',
	'Cytracon_Builder/js/directives/resizable',
	'Cytracon_Builder/js/directives/builderDirectiveList',
	'Cytracon_Builder/js/builder/element/profile',
	'Cytracon_Builder/js/directives/navigator',
	'Cytracon_Builder/js/directives/elementIcon',
	'Cytracon_Builder/js/directives/navigatorProfile',
	'Cytracon_Builder/js/modules/contentEditable',
	'Cytracon_Builder/js/modules/inlineEditor',
	'Cytracon_Builder/js/modules/afterRender',
	'Cytracon_Builder/js/directives/colorPicker',
	'Cytracon_Builder/js/directives/elementActions',
	'Cytracon_Builder/js/directives/elementResizable',
	'Cytracon_Builder/js/directives/tooltip',
	'uiBootstrap',
	'dndLists',
	'angularSanitize',
	'dynamicDirective',
	'uiCodemirror',
	'uiSelect',
	'outsideClickDirective',
	'ngStats'
], function(
	angular,
	formly,
	configProvider,
	cytraconBuilderSer,
	cytraconBuilderUrlSer,
	cytraconBuilderModalSer,
	elementManagerSer,
	profileManagerSer,
	formSer,
	editorSer,
	filterSer,
	historySer,
	baseController,
	listController,
	modalBaseControllerCtrl,
	toolbarControllerCtrl,
	cytraconBuilderDir,
	modalElementDir,
	resizableDir,
	builderDirectiveListDir,
	profileDir,
	navigatorDir,
	elementIconDir,
	navigatorProfileDir,
	contentEditableDir,
	inlineEditorDir,
	afterRender,
	colorPicker,
	elementActions,
	elementResizable,
	tooltipDir
) {
	var builder = angular.module('cytraconBuilder', ['formly', 'dndLists', 'ui.bootstrap', 'ngSanitize', 'dynamicDirective', 'ui.codemirror', 'ui.select', 'ngOutsideClick', 'angularStats']);

	builder.config(function($sceDelegateProvider) {
		$resourceUrlWhitelist = ['self','*://localhost/**','*://www.youtube.com/**', '*://player.vimeo.com/video/**'];
		$sceDelegateProvider.resourceUrlWhitelist($resourceUrlWhitelist.concat(window.builderConfig.resourceUrlWhitelist));
	});

	builder.run(function(dynamicDirectiveManager, cytraconBuilderConfig, cytraconBuilderService, cytraconBuilderUrl, elementManager) {
		angular.forEach(cytraconBuilderConfig.elements, function(element) {
			var type = elementManager.getElementType(element.type);
			require([element['element']], function(Directive) {
				dynamicDirectiveManager.registerDirective('mgzElement' + type, Directive, 'mgz');
			});
			require([element['navigator']], function(Directive) {
				dynamicDirectiveManager.registerDirective('mgzElementNavigator' + type, Directive, 'mgz');
			});
			if (element['toolbar']) {
				require([element['toolbar']], function(Directive) {
					dynamicDirectiveManager.registerDirective('mgzElementToolbar' + type, Directive, 'mgz');
				});
			}
		});
		angular.forEach(cytraconBuilderConfig.directives, function(directive, name) {
			name = elementManager.getElementType(directive.type);
			if (directive['element']) {
				require([directive['element']], function(Directive) {
					dynamicDirectiveManager.registerDirective('mgzDirective' + name, Directive, 'mgz');
				});
			} else if (directive['templateUrl']) {
				function Directive() {
				 	return {
				 		replace: true,
				 		templateUrl: cytraconBuilderUrl.getViewFileUrl(directive['templateUrl'])
				 	};
				}
				dynamicDirectiveManager.registerDirective('mgzDirective' + name, Directive, 'mgz');
			}
		});
		cytraconBuilderService.directives = cytraconBuilderConfig.directives;
	});

	// PROVIDER
	builder.provider('cytraconBuilderConfig', configProvider);
	builder.service('cytraconBuilderService', cytraconBuilderSer);
	builder.service('cytraconBuilderUrl', cytraconBuilderUrlSer);
	builder.service('cytraconBuilderModal', cytraconBuilderModalSer);
	builder.service('elementManager', elementManagerSer);
	builder.service('profileManager', profileManagerSer);
	builder.service('historyManager', historySer);
	builder.service('cytraconBuilderForm', formSer);
	builder.service('cytraconBuilderEditor', editorSer);
	builder.service('cytraconBuilderFilter', filterSer);

	// DIRECTIVE
	builder.directive('cytraconBuilder', cytraconBuilderDir);
	builder.directive('cytraconBuilderModalElement', modalElementDir);
	builder.directive('cytraconBuilderResizable', resizableDir);
	builder.directive('cytraconBuilderDirectiveList', builderDirectiveListDir);
	builder.directive('cytraconBuilderProfile', profileDir);
	builder.directive('cytraconBuilderNavigator', navigatorDir);
	builder.directive('cytraconBuilderElementIcon', elementIconDir);
	builder.directive('cytraconBuilderNavigatorProfile', navigatorProfileDir);
	builder.directive('contentEditable', contentEditableDir);
	builder.directive('inlineEditor', inlineEditorDir);
	builder.directive('afterRender', afterRender);
	builder.directive('cytraconBuilderColorPicker', colorPicker);
	builder.directive('cytraconBuilderElementActions', elementActions);
	builder.directive('cytraconBuilderElementResizable', elementResizable);
	builder.directive('mgzTooltip', tooltipDir);

	// CONTROLLER
	builder.controller('baseController', baseController);
	builder.controller('listController', listController);
	builder.controller('modalBaseController', modalBaseControllerCtrl);
	builder.controller('toolbarController', toolbarControllerCtrl);

	return builder;
});