var config = {
    map: {
        '*': {
            jarallax: 'Cytracon_Builder/js/jarallax/jarallax.min',
            jarallaxVideo: 'Cytracon_Builder/js/jarallax/jarallax-video',
            waypoints: 'Cytracon_Builder/js/waypoints/jquery.waypoints',
        }
    },
    paths: {
        angular: 'Cytracon_Builder/vendor/angular/angular',
        dndLists: 'Cytracon_Builder/vendor/angular-drag-and-drop-lists/angular-drag-and-drop-lists',
        cytraconBuilder: 'Cytracon_Builder/js/builder',
        formly: 'Cytracon_Builder/vendor/angular-formly/dist/formly',
        uiBootstrap: 'Cytracon_Builder/js/ui-bootstrap-tpls-2.5.0.min',
        'api-check': 'Cytracon_Builder/vendor/api-check/dist/api-check',
        formlyUtils: 'Cytracon_Builder/js/factories/FormlyUtils',
        angularSanitize : 'Cytracon_Builder/vendor/angular-sanitize/angular-sanitize',
        dynamicDirective: 'Cytracon_Builder/js/modules/dynamicDirective',
        outsideClickDirective: 'Cytracon_Builder/js/modules/outside-click',
        owlcarouselDirective: 'Cytracon_Builder/js/modules/angular-owl-carousel-2',
        mgzcodemirror: 'Cytracon_Builder/vendor/codemirror/lib/codemirror',
        codemirrorCss: 'Cytracon_Builder/vendor/codemirror/mode/css/css',
        uiCodemirror: 'Cytracon_Builder/vendor/angular-ui-codemirror/ui-codemirror',
        uiSelect: 'Cytracon_Builder/vendor/angular-ui-select/dist/select.min',
        ngStats: 'Cytracon_Builder/vendor/ng-stats/ng-stats',
        mgzspectrum: 'Cytracon_Builder/vendor/spectrum/spectrum',
        mgztinycolor: 'Cytracon_Builder/vendor/spectrum/tinycolor',
    },
    shim: {
        jarallax: {
            exports: 'jarallax',
            deps: ['jquery']
        },
        jarallaxVideo: {
            deps: ['jarallax']
        },
        waypoints: {
            deps: ['jarallax', 'jquery']
        },
        angular: {
            exports: 'angular'
        },
        dndLists: {
            deps: ['angular']
        },
        uiBootstrap: {
            deps: ['angular']
        },
        angularSanitize: {
            deps: ['angular']
        },
        dynamicDirective: {
            deps: ['angular']
        },
        outsideClickDirective: {
            deps: ['angular']
        },
        owlcarouselDirective: {
            deps: ['angular']
        },
        mgzUiTinymce: {
            deps: ['angular']
        },
        codemirror: {
            exports: 'CodeMirror'
        },
        uiCodemirror: {
            deps: ['mgzcodemirror', 'angular']
        },
        uiSelect: {
            deps: ['angular']
        },
        ngStats: {
            deps: ['angular']
        },
        staticInclude: {
            deps: ['angular']
        },
        formly: {
            deps: ['jquery']
        },
        'Cytracon_Builder/js/carousel': {
            deps: ['jquery']
        },
        'Cytracon_Builder/js/countdown': {
            deps: ['jquery']
        }
    }
};