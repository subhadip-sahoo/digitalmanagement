(function() {

  'use strict';

  angular
    .module('timeTracker')
    .factory('visitor', visitor);

    function visitor($resource) {

      // ngResource call to the API for the users
  	  var Visitor = $resource('api/visitors');

      // Query the users and return the results
      function getVisitors() {
  	    return Visitor.query().$promise.then(function(results) {
  	      return results;
  	    }, function(error) {
  	      console.log(error);
  	    });
      }

      return {
        getVisitors: getVisitors
      }
    }
    
})(); 