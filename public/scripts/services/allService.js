angular.module('allService', [])
	
	.factory('User', function($http) {
		return {
			get : function() {
				return $http.get('api/welcome');
			},
			showAppointment : function(id) {
				return $http.get('api/createappointment/' + id);
			}
		}
	})
	.factory('Userdata', function($http) {
		return {
			// get current user details
			get : function() {
				return $http.get('api/settings');
			},			
			// save current user details
			update : function(id, userData) {
				return $http.post('api/settings/update/' + id, userData);
			}
		}
	})
	.factory('Location', function($http) {

		return {
			// get all the locations
			get : function() {
				return $http.get('api/locations');
			},

			show : function(id) {
				return $http.get('api/locations/' + id);
			},
			
			// save a location (pass in location data)
			create : function(locationData) {
				return $http.post('api/locations/create', locationData);
			},
			
			// save a location (pass in location data)
			update : function(id, locationData) {
				return $http.post('api/locations/update/' + id, locationData);
			},
			
			// destroy a location
			destroy : function(id) {
				return $http.delete('api/locations/' + id);
			}
		}

	})
	.factory('Visitortype', function($http) {

		return {
			// get all the visitortypes
			get : function() {
				return $http.get('api/visitortypes');
			},

			show : function(id) {
				return $http.get('api/visitortypes/' + id);
			},
			
			// save a visitortype (pass in visitortype data)
			create : function(visitortypeData) {
				return $http.post('api/visitortypes/create', visitortypeData);
			},
			
			// save a visitortype (pass in visitortype data)
			update : function(id, visitortypeData) {
				return $http.post('api/visitortypes/update/' + id, visitortypeData);
			},
			
			// destroy a visitortype
			destroy : function(id) {
				return $http.delete('api/visitortypes/' + id);
			}
		}

	})
	.factory('Alladmin', function($http) {

		return {
			// get all the admin
			get : function() {
				return $http.get('api/alladmin');
			},

			show : function(id) {
				return $http.get('api/alladmin/' + id);
			},
			
			// save a admin (pass in admin data)
			create : function(alladminData) {
				return $http.post('api/alladmin/create', alladminData);
			},
			
			// save a admin (pass in admin data)
			update : function(id, alladminData) {
				return $http.post('api/alladmin/update/' + id, alladminData);
			},
			
			// destroy a admin
			destroy : function(id) {
				return $http.delete('api/alladmin/' + id);
			}
		}

	})
	.factory('Employee', function($http) {

		return {
			// get all the employees
			get : function() {
				return $http.get('api/employees');
			},

			show : function(id) {
				return $http.get('api/employees/' + id);
			},
			
			// save a employee (pass in employee data)
			create : function(employeeData) {
				return $http.post('api/employees/create', employeeData);
			},
			
			// save a employee (pass in employee data)
			update : function(id, employeeData) {
				return $http.post('api/employees/update/' + id, employeeData);
			},
			// destroy a employee
			destroy : function(id) {
				return $http.delete('api/employees/' + id);
			},
			// destroy a employee
			destroyall : function(id) {
				return $http.get('api/employees/destroyall');
			},
			// import employee data
			empimport : function() {
				return $http.get('api/importemployees');
			}
		}

	})
	.factory('Receptionist', function($http) {

		return {
			// get all the receptionists
			get : function() {
				return $http.get('api/receptionists');
			},

			show : function(id) {
				return $http.get('api/receptionists/' + id);
			},
			
			// save a receptionist (pass in receptionist data)
			create : function(receptionistData) {
				return $http.post('api/receptionists/create', receptionistData);
			},
			
			// save a receptionist (pass in receptionist data)
			update : function(id, receptionistData) {
				return $http.post('api/receptionists/update/' + id, receptionistData);
			},
			
			// destroy a receptionist
			destroy : function(id) {
				return $http.delete('api/receptionists/' + id);
			},
			uploadFileToUrl : function(file,  uploadUrl){
				var fd =  new  FormData();
				fd.append('file',  file);
				$http.post(uploadUrl,  fd,  {
					transformRequest:  angular.identity,
					headers:  {'Content-Type':  undefined}
				})
				.success(function(){
				})
				.error(function(){
				});
			}
		}

	})
	.factory('Report', function($http) {
		return {
			get : function() {
				return $http.get('api/reports');
			},
			reportfilter : function(reportData) {
				return $http.get('api/filterreports/' + reportData);
			},
			getVisitorTypes : function() {
				return $http.get('api/visitortypes');
			},
			getVisitorHosts : function() {
				return $http.get('api/employees');
			},
			getVisitorLocations : function() {
				return $http.get('api/locations');
			}
		}
	})
	.factory('VisitorData', function($http) {
		return {
			get : function() {
				return $http.get('api/createappointment');
			},
			gethost : function(id) {
				return $http.get('api/gethostname/' + id);
			},
			createappointment : function(appointmentData) {
				return $http.post('api/create-appointment', appointmentData);
			},
			updateappointment : function(id, appointmentData) {
				return $http.post('api/updateappointment/' + id, appointmentData);
			},
			show : function(id) {
				return $http.get('api/createappointment/' + id);
			},
			statuschange : function(vData) {
				return $http.get('api/statuschange/' + vData);
			},
			reset : function() {
				return $http.get('api/resetvisitor');
			}
		}
	})
	.factory('AllVisitorData', function($http) {
		return {
			get : function() {
				return $http.get('api/visitors');
			},
			// destroy a visitor
			destroy : function(id) {
				return $http.delete('api/visitors/' + id);
			},
			showAppointment : function(id) {
				return $http.get('api/createappointment/' + id);
			}
		}
	})
	.directive('modal', function () {		
    return {
      template: '<div class="modal fade">' + 
          '<div class="modal-dialog">' + 
            '<div class="modal-content">' + 
              '<div class="modal-header">' + 
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>' + 
                '<h4 class="modal-title">{{ buttonClicked }}</h4>' + 
              '</div>' + 
              '<div class="modal-body" ng-transclude></div>' + 
            '</div>' + 
          '</div>' + 
        '</div>',
      restrict: 'E',
      transclude: true,
      replace:true,
      scope:true,
      link: function postLink(scope, element, attrs) {
          scope.$watch(attrs.visible, function(value){
          if(value == true)
            $(element).modal('show');
          else
            $(element).modal('hide');
        });

        $(element).on('shown.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = true;
          });
        });

        $(element).on('hidden.bs.modal', function(){
          scope.$apply(function(){
            scope.$parent[attrs.visible] = false;
          });
        });
      }
    };
  })
  .factory('ModalData', function($http) {
		return {
			createimage : function(appointmentData) {
				return $http.post('api/createimage', appointmentData);
			}
		}
	});
