  /*angular
    .module('timeTracker', [
      'ngResource',
      'ui.bootstrap'
    ]);*/
	var welcomeApp = angular.module('welcomeApp', ['mainCtrl', 'allService'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	var settingsApp = angular.module('settingsApp', ['mainCtrl', 'allService'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	//var locationApp = angular.module('locationApp', ['mainCtrl', 'locationService']);
	var locationApp = angular.module('locationApp', ['mainCtrl', 'allService', 'ngSanitize', 'MassAutoComplete', 'angularUtils.directives.dirPagination'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	var visitortypeApp = angular.module('visitortypeApp', ['mainCtrl', 'allService', 'angularUtils.directives.dirPagination'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	var employeeApp = angular.module('employeeApp', ['mainCtrl', 'allService', 'angularUtils.directives.dirPagination', 'ngSanitize', 'MassAutoComplete', 'angularFileUpload'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	var receptionistApp = angular.module('receptionistApp', ['mainCtrl', 'allService', 'angularUtils.directives.dirPagination', 'angularFileUpload'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	var alladminApp = angular.module('alladminApp', ['mainCtrl', 'allService', 'angularUtils.directives.dirPagination'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	/*receptionistApp.directive('fileModel',  ['$parse',  function  ($parse)  {
		return  {
			restrict:  'A',
			link:  function(scope,  element,  attrs)  {
				var  model=  $parse(attrs.fileModel);
				var  modelSetter=  model.assign;
				element.bind('change',  function(){
					scope.$apply(function(){
						modelSetter(scope,  element[0].files[0]);
					});
				});
			}
		};
	}]);*/
	/*receptionistApp.directive('file', function() {
		return {
			restrict: 'E',
			template: '<input type="file" />',
			replace: true,
			require: 'ngModel',
			link: function(scope, element, attr, ctrl) {
				var listener = function() {
					scope.$apply(function() {
						attr.multiple ? ctrl.$setViewValue(element[0].files) : ctrl.$setViewValue(element[0].files[0]);
					});
				}
				element.bind('change', listener);
			}
		}
	});*/
	/*var ngBootstrap = angular.module('ngBootstrap', ['mainCtrl', 'allService'], function($interpolateProvider) {
        //$interpolateProvider.startSymbol('<%');
        //$interpolateProvider.endSymbol('%>');
    });*/
	
	var reportApp = angular.module('reportApp', ['mainCtrl', 'allService', 'datatables'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
	
	// Parse from the filter format 'dd/mm/yyyy' (Turkish culture)
	function parseDateFromFilter(strDate) {
		var a = strDate.split("-") ;
		var date = new Date( a[2], (a[1] - 1), a[0] ) ;
		return Date.parse(date) ;
	}
	
	var visitorApp = angular.module('visitorApp', ['mainCtrl', 'allService', 'angularUtils.directives.dirPagination'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

	var mymodal = angular.module('mymodal', ['mainCtrl', 'allService']);
	
	
	