var config = {
    map: {
        '*': {
            cytraconBuilder: 'Cytracon_Builder/js/cytracon-builder',
            jarallax: 'Cytracon_Builder/js/jarallax/jarallax.min',
            jarallaxVideo: 'Cytracon_Builder/js/jarallax/jarallax-video',
            waypoints: 'Cytracon_Builder/js/waypoints/jquery.waypoints',
            mgzTabs: 'Cytracon_Builder/js/tabs'
        }
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
        cytraconBuilder: {
            deps: ['waypoints', 'mage/bootstrap']
        },
        'Cytracon_Builder/js/cytracon-builder': {
            deps: ['jquery', 'waypoints', 'mage/bootstrap']
        },
        'Cytracon_Builder/js/carousel': {
            deps: ['jquery']
        },
        'Cytracon_Builder/js/countdown': {
            deps: ['jquery']
        }
    }
};