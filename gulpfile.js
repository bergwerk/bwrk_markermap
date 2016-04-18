var gulp = require('gulp');
require('require-dir')('gulp');

// adjust your development environment to customize the output paths
// for frontend development use frontend
// for typo3 use typo

var environment = 'typo3';

switch (environment) {
    case 'frontend':
        config = [
            sourcePath = 'src/',
            destinationPath = 'public/dist/',
            jadeDestinationPath = 'public'
        ];
        break;

    case 'typo3':
        config = [
            sourcePath = 'Resources/Private/src/',
            destinationPath = 'Resources/Public/'
        ];
        break;
}

var config = [
    // for normal output use normal, for minified output und minified
    output = 'normal',

    jsFilesApp = [

        // Jquery
        sourcePath + 'bower_components/jquery/dist/jquery.min.js',

        // Foundation
        sourcePath + 'bower_components/foundation-sites/js/foundation.core.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.util.box.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.util.keyboard.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.util.mediaQuery.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.util.motion.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.util.nest.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.util.timerAndImageLoader.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.util.touch.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.util.triggers.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.abide.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.accordion.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.accordionMenu.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.drilldown.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.dropdown.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.dropdownMenu.js',
        sourcePath + 'bower_components/foundation-sites/js/foundation.equalizer.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.interchange.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.magellan.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.offcanvas.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.orbit.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.responsiveMenu.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.responsiveToggle.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.reveal.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.slider.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.sticky.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.tabs.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.toggler.js',
        //sourcePath + 'bower_components/foundation-sites/js/foundation.tooltip.js',

        // Slick
        sourcePath + 'bower_components/slick-carousel/slick/slick.min.js',

        // Slick Animation
        sourcePath + 'bower_components/slick-animation/slick-animation.js',

        // Fastclick
        sourcePath + 'bower_components/fastclick/lib/fastclick.js',

        // Own Gobal Stuff
        sourcePath + 'js/global.js',
        sourcePath + 'js/page.js',
        sourcePath + 'js/testimonial.js',

        // Responsive Grid
        sourcePath + 'libs/image-grid/jquery.gridrotator.js',
        sourcePath + 'js/gridrotator.js',

        // Swipebox
        sourcePath + 'bower_components/swipebox/src/js/jquery.swipebox.js',
        sourcePath + 'js/swipebox.js',


        // ShuffleJS
        sourcePath + 'bower_components/shufflejs/dist/jquery.shuffle.js',
        sourcePath + 'js/shuffle.js',

        sourcePath + 'js/map.js'

    ]
];