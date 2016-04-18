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
    output = 'minified',

    jsFilesApp = [
        sourcePath + 'js/map.js'
    ]
];