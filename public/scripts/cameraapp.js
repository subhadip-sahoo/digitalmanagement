(function(angular) {
    'use strict';

    angular
        .module('camera', [], function($interpolateProvider) {
			$interpolateProvider.startSymbol('<%');
			$interpolateProvider.endSymbol('%>');
		});

})(angular);
