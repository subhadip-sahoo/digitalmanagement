angular.module('mainCtrl', [])
	
	.controller('welcomeController', function($scope, $http, User, $timeout, $location, $anchorScroll) {
		
		$scope.loading = true;
		User.get()
			.success(function(data) {
				
				/*if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
					
					if(data.user_role == 3){
						var baseurl = $location.absUrl();
						
						var url = baseurl + "create-appointment";
						window.location.href = url;
					}
				}*/
				$scope.users = data.users;
				$scope.page_heading = data.page_heading;
				$scope.editlink_controller = data.editlink_controller;
				$scope.u_type = data.u_type;
				$scope.loading = false;
			});
		$scope.loadAppointment = function(id) {
			User.showAppointment(id)
			.success(function(data) {
				var url = $location.absUrl() + "create-appointment";
				window.location.href = url;
				
			})
			.error(function(data) {
				console.log(data);
			});
		};
		
	})
	.controller('settingsController', function($scope, $http, Userdata, $timeout, $location, $anchorScroll) {
		$scope.userdata = {};
		$scope.successTextAlert = {};
		$scope.errorAlert = {};
		Userdata.get()
			.success(function(data) {
				$scope.userdata = data.userData[0];
				$scope.loading = false;
			})
			.error(function(data) {
				console.log(data);
			});
		$scope.updateUser = function(data) {
			Userdata.update(data.id, data)
			.success(function(data) {
				
				if(data.success == ''){
					$scope.errorAlert = data['error'];
					
				}else{
					$scope.successTextAlert = "Done! " + data.success;
					$scope.showSuccessAlert = true;
				
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
				}
			})
			.error(function(data) {
				console.log(data);
			});
		}
	})
	// inject the Location service into our controller
	.controller('locationController', function($scope, $http, Location, $timeout, $location, $anchorScroll) {
		var values = {};
		// object to hold all the data for the new Location form
		$scope.locationData = {};
		$scope.successTextAlert = {};

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		
		$scope.addForm = function(){
			$scope.buttonText = 'Add';
			$scope.locationData = {};
			$scope.saveForm = function() {
				$scope.submitLocation();
			};
		};
		
		// get all the locations first and bind it to the $scope.locations object
		// use the function we created in our service
		// GET ALL locations ==============
		Location.get()
			.success(function(data) {
				$scope.locations = data;
				$scope.loading = false;				
				values = data;
			});
		
		$scope.editLocation = function($id) {
			$scope.loading = true;
			$scope.buttonText = 'Update';
			Location.show($id)
				.success(function(data) {
					$location.hash('maincont');
					$anchorScroll();
					$scope.locationData = data;
					$scope.saveForm = function(data) {
						$scope.loading = true;
						Location.update(data.id, data)
						.success(function(data) {
							$scope.locationData = {};
							$scope.isFormOpen = false;
							$scope.successTextAlert = data.success;
							$scope.showSuccessAlert = true;
							$timeout(function(){
								$scope.showSuccessAlert = false;
							}, 10000);
							Location.get()
							.success(function(getData) {
								$scope.locations = getData;
								$scope.loading = false;
							});

						})
						.error(function(data) {
							console.log(data);
						});
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle submitting the form
		// SAVE A Location ================
		
		$scope.submitLocation = function() {
			$scope.loading = true;
			// save the location. pass in location data from the form
			// use the function we created in our service
			Location.create($scope.locationData)
				.success(function(data) {
					$scope.locationData = {};
					$scope.isFormOpen = false;
					$scope.successTextAlert = data.success;
					$scope.showSuccessAlert = true;
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
					// if successful, we'll need to refresh the location list
					Location.get()
						.success(function(getData) {
							$scope.locations = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};

		// function to handle deleting a location
		// DELETE A Location ====================================================
		$scope.deleteLocation = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this location?")
			if (message) {
				// use the function we created in our service
				Location.destroy(id)
					.success(function(data) {

						// if successful, we'll need to refresh the location list
						Location.get()
							.success(function(getData) {
								$scope.locations = getData;
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};
		
		$scope.clearSearch = function() {
			$scope.searchText = undefined;
		};
		function suggest_values(term) {
			var q = term.toLowerCase().trim();
			var results = [];
			for (var i = 0; i < values.length && results.length < 10; i++) {
			  var value = values[i].name;
			  if (value.toLowerCase().indexOf(q) === 0)
				results.push({ label: value, value: value });
			}
			return results;
		}
		function add_tag(selected) {
			$scope.searchText = selected.value;
		};
		$scope.autocomplete_options = {
			suggest: suggest_values,
			on_select: add_tag
		};
	})
	// inject the Visitor type service into our controller
	.controller('visitortypeController', function($scope, $http, Visitortype, $timeout, $location, $anchorScroll) {
		
		// object to hold all the data for the new Visitortype form
		$scope.visitortypeData = {};
		$scope.successTextAlert = {};

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		
		$scope.addForm = function(){
			$scope.buttonText = 'Add';
			$scope.visitortypeData = {};
			$scope.saveForm = function() {
				$scope.submitVisitortype();
			};
		};
		
		// get all the visitortypes first and bind it to the $scope.visitortypes object
		// use the function we created in our service
		// GET ALL visitortypes ==============
		Visitortype.get()
			.success(function(data) {
				$scope.visitortypes = data;
				$scope.loading = false;
			});
		
		$scope.editVisitortype = function($id) {
			$scope.loading = true;
			$scope.buttonText = 'Update';
			Visitortype.show($id)
				.success(function(data) {
					$location.hash('maincont');
					$anchorScroll();
					$scope.visitortypeData = data;
					$scope.saveForm = function(data) {
						$scope.loading = true;
						Visitortype.update(data.id, data)
						.success(function(data) {
							$scope.visitortypeData = {};
							$scope.isFormOpen = false;
							$scope.successTextAlert = data.success;
							$scope.showSuccessAlert = true;
							$timeout(function(){
								$scope.showSuccessAlert = false;
							}, 10000);
							Visitortype.get()
							.success(function(getData) {
								$scope.visitortypes = getData;
								$scope.loading = false;
							});

						})
						.error(function(data) {
							console.log(data);
						});
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle submitting the form
		// SAVE A Visitortype ================
		
		$scope.submitVisitortype = function() {
			$scope.loading = true;
			// save the visitortype. pass in visitortype data from the form
			// use the function we created in our service
			Visitortype.create($scope.visitortypeData)
				.success(function(data) {
					$scope.visitortypeData = {};
					$scope.isFormOpen = false;
					$scope.successTextAlert = data.success;
					$scope.showSuccessAlert = true;
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
					// if successful, we'll need to refresh the visitortype list
					Visitortype.get()
						.success(function(getData) {
							$scope.visitortypes = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};

		// function to handle deleting a visitortype
		// DELETE A visitortype ====================================================
		$scope.deleteVisitortype = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this visitor type?")
			if (message) {
				// use the function we created in our service
				Visitortype.destroy(id)
					.success(function(data) {

						// if successful, we'll need to refresh the visitortype list
						Visitortype.get()
							.success(function(getData) {
								$scope.visitortypes = getData;
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};

	})
	// inject the Receptionists service into our controller
	.controller('alladminController', function($scope, $http, Alladmin, $timeout, $location, $anchorScroll) {
		
		// object to hold all the data for the new Admin form
		$scope.alladminData = {};
		$scope.successTextAlert = {};
		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		
		$scope.addForm = function(){
			$scope.buttonText = 'Add';
			$scope.alladminData = {};
			$scope.saveForm = function() {
				$scope.submitAdmin();
			};
		};
		
		Alladmin.get()
			.success(function(data) {
				$scope.alladmin = data;
				$scope.loading = false;
				
			});
		
		$scope.editAdmin = function($id) {
			$scope.loading = true;
			$scope.buttonText = 'Update';
			Alladmin.show($id)
				.success(function(data) {
					//$location.hash('maincont');
					$anchorScroll();
					$scope.alladminData = data;
					$scope.saveForm = function(data) {
						$scope.loading = true;
						Alladmin.update(data.id, data)
						.success(function(data) {
							if(data.success == ''){
								$scope.errorAlert = data['error'];								
							}else{
								$scope.alladminData = {};
								$scope.isFormOpen = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							}
							Alladmin.get()
							.success(function(getData) {
								$scope.alladmin = getData;
								$scope.loading = false;
							});

						})
						.error(function(data) {
							console.log(data);
						});
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle submitting the form
		// SAVE A Admin ================
		
		$scope.submitAdmin = function() {
			$scope.loading = true;
			// use the function we created in our service
			Alladmin.create($scope.alladminData)
				.success(function(data) {
					if(data.success == ''){
						$scope.errorAlert = data['error'];								
					}else{
						$scope.alladminData = {};
						$scope.isFormOpen = false;
						$scope.successTextAlert = data.success;
						$scope.showSuccessAlert = true;
						$timeout(function(){
							$scope.showSuccessAlert = false;
						}, 10000);
					}
					// if successful, we'll need to refresh the admin list
					Alladmin.get()
						.success(function(getData) {
							$scope.alladmin = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle deleting a admin
		// DELETE A Admin ====================================================
		$scope.deleteAdmin = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this Admin?")
			if (message) {
				// use the function we created in our service
				Alladmin.destroy(id)
					.success(function(data) {

						// if successful, we'll need to refresh the admin list
						Alladmin.get()
							.success(function(getData) {
								$scope.alladmin = getData;
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};
	})
	// inject the Employee service into our controller
	.controller('employeeController', function($scope, $http, Employee, $timeout, $location, $anchorScroll, $upload) {
		var values = {};
		// object to hold all the data for the new Employee form
		$scope.employeeData = {};
		$scope.successTextAlert = {};
		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		
		$scope.addForm = function(){
			$scope.buttonText = 'Add';
			$scope.employeeData = {};
			$scope.saveForm = function() {
				$scope.submitEmployee();
			};
		};
		
		// get all the employees first and bind it to the $scope.employees object
		// use the function we created in our service
		// GET ALL Employees ==============
		Employee.get()
			.success(function(data) {
				$scope.employees = data;
				$scope.loading = false;
				values = data;
			});
		
		$scope.editEmployee = function($id) {
			$scope.loading = true;
			$scope.buttonText = 'Update';
			Employee.show($id)
				.success(function(data) {
					$location.hash('maincont');
					$anchorScroll();
					$scope.employeeData = data;
					$scope.saveForm = function(data) {
						$scope.loading = true;
						Employee.update(data.id, data)
						.success(function(data) {
							$scope.employeeData = {};
							$scope.isFormOpen = false;
							$scope.successTextAlert = data.success;
							$scope.showSuccessAlert = true;
							$timeout(function(){
								$scope.showSuccessAlert = false;
							}, 10000);
							Employee.get()
							.success(function(getData) {
								$scope.employees = getData;
								$scope.loading = false;
							});

						})
						.error(function(data) {
							console.log(data);
						});
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle submitting the form
		// SAVE A Employee ================
		
		$scope.submitEmployee = function() {
			$scope.loading = true;
			// save the employee. pass in employee data from the form
			// use the function we created in our service
			Employee.create($scope.employeeData)
				.success(function(data) {
					$scope.employeeData = {};
					$scope.isFormOpen = false;
					$scope.successTextAlert = data.success;
					$scope.showSuccessAlert = true;
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
					// if successful, we'll need to refresh the employee list
					Employee.get()
						.success(function(getData) {
							$scope.employees = getData;
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};

		// function to handle deleting a employee
		// DELETE A Employee ====================================================
		$scope.deleteEmployee = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this employee?")
			if (message) {
				// use the function we created in our service
				Employee.destroy(id)
					.success(function(data) {

						// if successful, we'll need to refresh the employee list
						Employee.get()
							.success(function(getData) {
								$scope.employees = getData;
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};
		$scope.deleteallemployee = function() {
			var message = confirm("Are you sure you want to delete all the contacts?")
			if (message) { 
				Employee.destroyall()
					.success(function(data) {
						Employee.get()
							.success(function(getData) {
								$scope.employees = getData;
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});
					})
					.error(function(data) {
						console.log(data);
					});
			}
		};
		
		/* File Start Upload Here */		
	
		$scope.upload = function(files) {	
			var tmpFileName	= '';	
			$scope.formUpload = false;
			if (files != null) {
				for (var i = 0; i < files.length; i++) {
					tmpFileName = tmpFileName +','+ files[i].name;
					$scope.errorMsg = null;
					(function(file) {
						eval($scope.uploadScript);
					})(files[i]);
				}
				$scope.attachFile = tmpFileName.substring(1);
				$scope.uploaded_csv = $scope.attachFile;
			}
		};

		$scope.acl = $scope.acl || 'private';
			
		$scope.uploadURL = 'csv-upload.php';

		(function handleDynamicEditingOfScriptsAndHtml($scope, $http) {
			$scope.defaultUploadScript = [];
			$http.get('public/js/csv-upload.js').success(function(data) {
				$scope.defaultUploadScript[1] = data; 
				$scope.uploadScript = $scope.uploadScript || data
			});
			
		})($scope, $http);
		
		
		/* File End Upload Here*/
		
		$scope.importemployee = function() {
			
			if(typeof ($scope.uploaded_csv) == 'undefined' || $scope.uploaded_csv == ''){
				alert("Please upload a csv file.");
			}else{
				var message = confirm("Are you sure you want to import the employee data?")
				if (message) {
					Employee.empimport()
						.success(function(data) {
							Employee.get()
								.success(function(getData) {
									$scope.uploaded_csv = '';
									$scope.employees = getData;
									$scope.loading = false;
									$scope.successTextAlert = data.success;
									$scope.showSuccessAlert = true;
									$timeout(function(){
										$scope.showSuccessAlert = false;
									}, 10000);
								});
						})
						.error(function(data) {
							console.log(data);
						});
				}
			}
		};
		
		$scope.clearSearch = function() {
			$scope.searchText = undefined;
		};
		function suggest_values(term) {
			var q = term.toLowerCase().trim();
			var results = [];
			for (var i = 0; i < values.length && results.length < 10; i++) {
			  var value = values[i].first_name + " " + values[i].last_name;
			  if (value.toLowerCase().indexOf(q) === 0)
				results.push({ label: value, value: value });
			}
			return results;
		}
		function add_tag(selected) {
			$scope.searchText = selected.value;
		};
		$scope.autocomplete_options = {
			suggest: suggest_values,
			on_select: add_tag
		};
		
		
	})
	// inject the Receptionists service into our controller
	.controller('receptionistController', function($scope, $http, Receptionist, $timeout, $location, $anchorScroll, $upload) {
		//$scope.errorAlert = {};
		// object to hold all the data for the new Employee form
		$scope.receptionistData = {};
		$scope.successTextAlert = {};
		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		
		$scope.addForm = function(){
			$scope.buttonText = 'Add';
			$scope.receptionistData = {};
			$scope.saveForm = function() {
				//$scope.uploadURL = 'upload.php?uid=0';
				$scope.submitReceptionist();
			};
		};
		
		
	/* File Start Upload Here */		
	

	$scope.upload = function(files) {	
		var tmpFileName	= '';	
		$scope.formUpload = false;
		if (files != null) {
			for (var i = 0; i < files.length; i++) {
				tmpFileName = tmpFileName +','+ files[i].name;
				$scope.errorMsg = null;
				(function(file) {
					$scope.generateThumb(file);
					
					eval($scope.uploadScript);
				})(files[i]);
			}
			$scope.receptionistData.attachFile = tmpFileName.substring(1);
		  
		}
	};

	$scope.generateThumb = function(file) {
		if (file != null) {
			if ($scope.fileReaderSupported && file.type.indexOf('image') > -1) {
				$timeout(function() {
					var fileReader = new FileReader();
					fileReader.readAsDataURL(file);
					fileReader.onload = function(e) {
						$timeout(function() {
							file.dataUrl = e.target.result;
						});
					}
				});
			}
		}
	}
		
	$scope.acl = $scope.acl || 'private';
		
	$scope.uploadURL = 'upload.php?uid=0';

	(function handleDynamicEditingOfScriptsAndHtml($scope, $http) {
		$scope.defaultUploadScript = [];
		$http.get('public/js/upload-upload.js').success(function(data) {
			$scope.defaultUploadScript[1] = data; 
			$scope.uploadScript = $scope.uploadScript || data
		});
		
	})($scope, $http);
	
	
	/* File End Upload Here*/
		
		
		
		/*$scope.uploadFile=  function(){
			var  file=  $scope.myavatar;
			var  uploadUrl=  "api/receptionists/upload";
			Receptionist.uploadFileToUrl(file,  uploadUrl);
		};*/
		
		// get all the receptionists first and bind it to the $scope.receptionists object
		// use the function we created in our service
		// GET ALL Receptionists ==============
		Receptionist.get()
			.success(function(data) {
				$scope.receptionists = data;
				$scope.random_no = Math.floor((Math.random()*10000000)+1);
				$scope.loading = false;
				
			});
		
		$scope.editReceptionist = function($id) {
			$scope.loading = true;
			$scope.buttonText = 'Update';
			Receptionist.show($id)
				.success(function(data) {
					//$location.hash('maincont');
					$anchorScroll();
					$scope.receptionistData = data;
					$scope.receptionistData.password = data.password_org;
					$scope.receptionistData.password_confirmation = data.password_org;
					
					$scope.uploadURL = 'upload.php?uid=' + $id;
					
					$scope.saveForm = function(data) {
						$scope.loading = true;
						Receptionist.update(data.id, data)
						.success(function(data) {
							$scope.receptionistData = {};
							$scope.isFormOpen = false;
							$scope.successTextAlert = data.success;
							$scope.showSuccessAlert = true;
							$timeout(function(){
								$scope.showSuccessAlert = false;
							}, 10000);
							Receptionist.get()
							.success(function(getData) {
								$scope.receptionists = getData;
								$scope.random_no = Math.floor((Math.random()*10000000)+1);
								$scope.loading = false;
							});

						})
						.error(function(data) {
							console.log(data);
						});
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle submitting the form
		// SAVE A Receptionist ================
		
		$scope.submitReceptionist = function() {
			$scope.loading = true;
			//alert($scope.receptionistData.toSource());
			// save the receptionist. pass in receptionist data from the form
			// use the function we created in our service
			Receptionist.create($scope.receptionistData)
				.success(function(data) {
					
					/*if(data.success == ''){
						$scope.errorAlert = data['error'];								
					}else{*/
						$scope.receptionistData = {};
						$scope.isFormOpen = false;
						$scope.successTextAlert = data.success;
						$scope.showSuccessAlert = true;
						$timeout(function(){
							$scope.showSuccessAlert = false;
						}, 10000);
					/*}*/
					// if successful, we'll need to refresh the receptionist list
					Receptionist.get()
						.success(function(getData) {
							$scope.receptionists = getData;
							$scope.random_no = Math.floor((Math.random()*10000000)+1);
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		// function to handle deleting a receptionist
		// DELETE A Receptionist ====================================================
		$scope.deleteReceptionist = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this receptionist?")
			if (message) {
				// use the function we created in our service
				Receptionist.destroy(id)
					.success(function(data) {

						// if successful, we'll need to refresh the receptionist list
						Receptionist.get()
							.success(function(getData) {
								$scope.receptionists = getData;
								$scope.random_no = Math.floor((Math.random()*10000000)+1);
								$scope.loading = false;
								$scope.successTextAlert = data.success;
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};

	})
	.controller('reportController', function($scope, Report, $timeout, $location, $anchorScroll) {
		
		$scope.tbOptions = {
			data: [],
			aoColumns: [
			  { mData: 'card_no' },
			  { mData: 'first_name' },
			  { mData: 'signature' },
			  { mData: 'email' },
			  { mData: 'visitor_type' },
			  { mData: 'company_name' },
			  { mData: 'hostname' },
			  { mData: 'location_name' },
			  { mData: 'arival_date' },
			  { mData: 'arival_time' },
			  { mData: 'departure_time' },
			  { mData: 'status' }
			],
			aoColumnDefs: [  
				{
					aTargets: [ 3 ],
					mRender: function ( data, type, full ) {
						return '<a href="mailto:' + data + '" style=color:#1a84b0;>' + data + '</a>';
					}                               
				},
				{
					aTargets: [1],
					mRender: function (data, type, full) {
						var baseUrl = $location.absUrl();
						baseUrl = baseUrl.substring(0, baseUrl.indexOf("reports"));
						var imgurl = (full.avatar == 1) ? full.card_no : 'blank_face';
						return '<img src="'+baseUrl+'public/uploads/avatar/'+imgurl+'.jpg" alt="'+full.first_name+' '+full.last_name+'" title="'+full.first_name+' '+full.last_name+'" width="74" height="74"> ' + data + ' ' + full.last_name;
						 
					}
				},
				{
					aTargets: [2],
					mRender: function (data, type, full) {
						var baseUrl = $location.absUrl();
						baseUrl = baseUrl.substring(0, baseUrl.indexOf("reports"));
						var signatureurl = (full.signature == 1) ? full.card_no + '_signature.jpg' : 'blank_signature.png';
						return '<img src="'+baseUrl+'public/uploads/avatar/'+signatureurl+'" alt="" style="max-width:74px; height=auto;"> ';
						 
					}
				},
				{
					aTargets: [11],
					mRender: function (data, type, full) {
						return data == 1 ? '<span style="color:green">Checked In</span>' : '<span style="color:red">Checked Out</span>';
					}
				}
			] 
		};
		
		/*Report.get()
		.success(function(data) {
			$scope.visitors = data.visitors;
		})
		.error(function(data) {
			console.log(data);
		});*/
		
		Report.getVisitorTypes()
			.success(function(data) {
				$scope.visitortypes = data;
				$scope.loading = false;
			});
		Report.getVisitorLocations()
			.success(function(data) {
				$scope.locations = data;
				$scope.loading = false;
			});
		Report.getVisitorHosts()
			.success(function(data) {
				$scope.visitorhosts = data;
				$scope.loading = false;
			});
		
		$scope.dates1 = moment().startOf('day').format('DD/MM/YYYY') + "-" + moment().startOf('day').format('DD/MM/YYYY');
		$("#startDate").val(moment().startOf('day').format('DD-MM-YYYY'));
		$("#endDate").val(moment().startOf('day').format('DD-MM-YYYY'));
		filter_reports();
		
		$('input[name="dates1"]').daterangepicker({
			locale: {
				format: 'DD/MM/YYYY'
			}
		}, 
		function(start, end, label) {
			$("#startDate").val(start.format('DD-MM-YYYY'));
			$("#endDate").val(end.format('DD-MM-YYYY'));
			
		});
		$scope.reportsFilter = function () {			
			filter_reports()
		};
		function filter_reports(){
			var startDate = $("#startDate").val();
			var endDate = $("#endDate").val();
			/*alert(startDate + " / " + endDate);*/
			var jsonArg = new Object();
			jsonArg.startDate = startDate;
			jsonArg.endDate = endDate;
			jsonArg.visitor_type = $scope.visitor_type;
			jsonArg.visitor_host = $scope.visitor_host;
			jsonArg.visitor_location = $scope.visitor_location;
			
			var reportData = JSON.stringify(jsonArg);
			Report.reportfilter(reportData)
				.success(function(data) {
					//alert(data.toSource());
					//$scope.visitors = data.visitors;
					$scope.tbOptions.data = data.visitors;
					
				})
				.error(function(data) {
					console.log(data);
				});
		}
		
	})
	.controller('visitorController', function($scope, $http, VisitorData, $timeout, $location, $anchorScroll) {
		if (navigator.userAgent.match(/(android|webos|iphone|iPhone|ipad|iPad|ipod|iPod|blackberry|iemobile|opera mini)/)) {
			$("#iosdiv").show();
			$("#noniosdiv").hide();
		}else{
			$("#iosdiv").hide();
			$("#noniosdiv").show();
		}
	
		$scope.showCheckModal = false;
		$scope.showCheckModalUpdate = false;
		$scope.showflag = 0;
		$scope.switchBool = function (value) {
			$scope[value] = !$scope[value];
		};
		$scope.appointmentData = {};
		$scope.addAppointment = function(){
			VisitorData.reset()
			.success(function(data) {
				$scope.appointmentData = {};
				$scope.showCheckModal = false;
				getvisitordata();
				$('#results').html('<img src="'+$scope.base_image_path +'blank_face.jpg" alt=""/>');
				$('#sign_results').html('<img src="'+$scope.base_image_path +'blank_signature.png" alt=""/>');
				$scope.saveAppointment = function() {
					if($scope.appointmentData.signature_url == "blank_signature.png"){
						alert("Please add your signature below.");
					}else{
						$scope.showCheckModal = !$scope.showCheckModal;
					}
					//$scope.submitAppointment();
				};
			}).error(function(data) {
				console.log(data);
			});
			
		};
		$scope.saveAppointment = function() {
			if($scope.appointmentData.signature_url == "blank_signature.png"){
				alert("Please add your signature below.");
			}else{
				$scope.showCheckModal = !$scope.showCheckModal;
			}
			//$scope.submitAppointment();
		};
		$scope.changeStatus = function(status) {
			$scope.appointmentData.status = status;
			$scope.submitAppointment();
		};
		$scope.changeStatusUpdate = function(status) {
			$scope.appointmentData.status = status;
			update_Appointment();
		};
		$scope.changeVisitorStatus = function(id, status) {
			var jsonObj = new Object();
			jsonObj.id = id;
			jsonObj.status = status;
			var vData = JSON.stringify(jsonObj);
			VisitorData.statuschange(vData)
				.success(function(data) {
					$scope.appointmentData = {};
					getvisitordata();
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		var getvisitordata = function() {
			VisitorData.get()
			.success(function(data) {
				
				if(typeof (data.session_visitor) == 'string' && data.session_visitor != ''){	  				
					//$scope.editAppointment(data.session_visitor);
					//data.visitordata = "";
					
					$id = data.session_visitor;
					VisitorData.show($id)
					.success(function(data) {
						$scope.appointmentData = data[0];
						$scope.hostname = data[0].hostname;
						$scope.location_id = data[0].location;
						$scope.location = data[0].location_name;
						if(data[0].avatar == 1){
							$scope.appointmentData.image_url = data[0].card_no + ".jpg";
						}else{
							$scope.appointmentData.image_url = "blank_face.jpg";
						}
						if(data[0].signature == 1){
							$scope.appointmentData.signature_url = data[0].card_no + "_signature.jpg";
						}else{
							$scope.appointmentData.signature_url = 'blank_signature.png';
						}
						$('#results').html('<img src="'+$scope.base_image_path + $scope.appointmentData.image_url +'" alt=""/>');
						$('#sign_results').html('<img src="'+$scope.base_image_path + $scope.appointmentData.signature_url +'" alt=""/>');
						$scope.showflag = 1;
						$scope.visitor_id = $id;
						$scope.visitor_status = data[0].status;
						
						$scope.saveAppointment = function(data) {
							
							VisitorData.updateappointment(data.id, data)
							.success(function(data) {
								$scope.appointmentData = {};
								$scope.successTextAlert = data.success;
								/*$scope.appointmentData.image_url = "blank_face.jpg";
								$scope.appointmentData.signature_url = "blank_signature.png";*/
								$('#results').html('<img src="'+$scope.base_image_path +'blank_face.jpg" alt=""/>');
								$('#sign_results').html('<img src="'+$scope.base_image_path +'blank_signature.png" alt=""/>');
								
								$scope.showSuccessAlert = true;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
								getvisitordata();
							})
							.error(function(data) {
								console.log(data);
							});
						};
						$scope.loading = false;
					})
					.error(function(data) {
						console.log(data);
					});
				}
				 
				$scope.appointmentData.card_no = data.card_no;
				$scope.appointmentData.arival_date = data.arival_date;
				$scope.appointmentData.arival_time = data.arival_time;
				$scope.visitors = data.visitors;
				$scope.visitortypes = data.visitortypes;
				$scope.hostnames = data.hostnames;
				$scope.location = data.location;
				$scope.appointmentData.location_id = data.location_id;
				$scope.appointmentData.image_url = "blank_face.jpg";
				$scope.appointmentData.signature_url = "blank_signature.png";
				$scope.visitor_counts = data.visitor_counts;
				$scope.status = data.status;
				
				$scope.hostname = '';
				$scope.showflag = 0;
				
				var arival_date = $scope.appointmentData.arival_date;
				var a = arival_date.split("-") ;
				var date = new Date( a[2], (a[1] - 1), a[0] ) ;
				var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
				$scope.arival_day = weekdays[date.getDay()];
				
				$scope.visitor_status = '';
			
			}).error(function(data) {
				console.log(data);
			});
		};
		
		getvisitordata();
		
		$scope.getHostname = function(id) {
			VisitorData.gethost(id)
				.success(function(data) {
					$scope.hostname = data.hostname;
				}).error(function(data) {
					console.log(data);
				});
		};
		
		$scope.editAppointment = function($id) {
			$scope.appointmentData = {};
			VisitorData.show($id)
				.success(function(data) {
					$scope.appointmentData = data[0];
					$scope.hostname = data[0].hostname;
					$scope.location_id = data[0].location;
					$scope.location = data[0].location_name;
					//alert($scope.location);
					if(data[0].avatar == 1){
						$scope.appointmentData.image_url = data[0].card_no + ".jpg";
					}else{
						$scope.appointmentData.image_url = "blank_face.jpg";
					}
					if(data[0].signature == 1){
						$scope.appointmentData.signature_url = data[0].card_no + "_signature.jpg";
					}else{
						$scope.appointmentData.signature_url = 'blank_signature.png';
					}
					$('#results').html('<img src="'+$scope.base_image_path + $scope.appointmentData.image_url +'" alt=""/>');
					$('#sign_results').html('<img src="'+$scope.base_image_path + $scope.appointmentData.signature_url +'" alt=""/>');
					$scope.showflag = 1;
					$scope.visitor_id = $id;
					$scope.visitor_status = data[0].status;
					$scope.appointmentData.status = data[0].status;
					/*alert(data[0].toSource());*/
					$scope.saveAppointment = function(data) {
						
						if($scope.appointmentData.status == 0){
							$scope.showCheckModalUpdate = true;
						}else{
							update_Appointment();						
						}					
						
					};
					$scope.loading = false;
				})
				.error(function(data) {
					console.log(data);
				});
		};
		function update_Appointment(){
			$scope.appointmentData.image_url = $("#results img").attr('src');
			//alert($scope.appointmentData.toSource());
			VisitorData.updateappointment($scope.appointmentData.id, $scope.appointmentData)
				.success(function(udata) {
					
					$scope.appointmentData = {};
					$scope.successTextAlert = udata.success;
					/*$scope.appointmentData.image_url = "blank_face.jpg";
					$scope.appointmentData.signature_url = "blank_signature.png";*/
					$('#results').html('<img src="'+$scope.base_image_path +'blank_face.jpg" alt=""/>');						
					$('#sign_results').html('<img src="'+$scope.base_image_path +'blank_signature.png" alt=""/>');
					
					$scope.showSuccessAlert = true;
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
					
					getvisitordata();
					
				})
				.error(function(udata) {
					console.log(udata);
				});
		}		
		$scope.submitAppointment = function() {
			
			$scope.appointmentData.image_url = $("#results img").attr('src');
			
			var visitor_no = $scope.appointmentData.visitor_no;
			var company_name = $scope.appointmentData.company_name;
			var visitor_type = $scope.appointmentData.role_id;
			var host_name = $scope.appointmentData.host_name;
			var hostname = $scope.hostname;
					
			VisitorData.createappointment($scope.appointmentData)
				.success(function(data) {
					
					if($.isNumeric( visitor_no ) && visitor_no > 1){
						visitor_no -= 1;
					}else{
						visitor_no = '';
						company_name = '';
						visitor_type = '';
						host_name = '';
						hostname = '';
					}
					$scope.appointmentData = {};
					
					$scope.successTextAlert = data.success;
					$scope.appointmentData.image_url = "blank_face.jpg";
					$scope.appointmentData.signature_url = "blank_signature.png";
					
					$scope.showSuccessAlert = true;
					$timeout(function(){
						$scope.showSuccessAlert = false;
					}, 10000);
					// if successful, we'll need to refresh the visitor list
					getvisitordata();
					$('#results').html('<img src="'+$scope.base_image_path +'blank_face.jpg" alt=""/>');
					$('#sign_results').html('<img src="'+$scope.base_image_path +'blank_signature.png" alt=""/>');
					$timeout(function(){
						
						$scope.appointmentData.company_name = company_name;
						$scope.appointmentData.role_id = visitor_type;
						$scope.appointmentData.host_name = host_name;
						$scope.hostname = hostname;
						$scope.appointmentData.visitor_no = visitor_no;
					}, 1000);
				})
				.error(function(data) {
					console.log(data);
				});
		};
		
		/** Capture Signature **/
		var wrapper = document.getElementById("signature-pad"),
			canvas = wrapper.querySelector("canvas"),
			signaturePad;

		// Adjust canvas coordinate space taking into account pixel ratio,
		// to make it look crisp on mobile devices.
		// This also causes canvas to be cleared.
		function resizeCanvas() {
			// When zoomed out to less than 100%, for some very strange reason,
			// some browsers report devicePixelRatio as less than 1
			// and only part of the canvas is cleared then.
			var ratio =  Math.max(window.devicePixelRatio || 1, 1);
			canvas.width = canvas.offsetWidth * ratio;
			canvas.height = canvas.offsetHeight * ratio;
			canvas.getContext("2d").scale(ratio, ratio);
		}

		window.onresize = resizeCanvas;
		resizeCanvas();

		signaturePad = new SignaturePad(canvas);

		$scope.clearSignature = function() {
			signaturePad.clear();
		};
		
		$scope.showSignatureModal = false;
		$scope.buttonClicked = "";
		$scope.toggleSignatureModal = function(btnClicked){
			if (signaturePad.isEmpty()) {
				alert("Please provide signature first.");
			} else {
				document.getElementById("agreeConditions").checked = false;
				$scope.buttonClicked = btnClicked;
				$scope.showSignatureModal = !$scope.showSignatureModal;
			}
		};
		
		$scope.captureSignature = function() {
			var agreeConditions = document.getElementById("agreeConditions");
			if (agreeConditions.checked) {
				/*window.open(signaturePad.toDataURL());*/
				//$("#signature_url").val(signaturePad.toDataURL());
				$scope.appointmentData.signature_url = signaturePad.toDataURL();
				document.getElementById('sign_results').innerHTML =	'<img src="'+signaturePad.toDataURL()+'" alt=""/>';
				signaturePad.clear();
				$scope.showSignatureModal = false;
			} else {
				alert("You must agree with conditions.");
			}
		};
		/** End Capture Signature **/
		
		
		
	})
	.controller('allvisitorController', function($scope, $http, AllVisitorData, $timeout, $location, $anchorScroll) {
		AllVisitorData.get()
			.success(function(data) {
				$scope.visitors = data.visitors;
			}).error(function(data) {
				console.log(data);
			});
			
		$scope.loadAppointment = function(id) {
			AllVisitorData.showAppointment(id)
			.success(function(data) {
				var baseUrl = $location.absUrl();
				baseUrl = baseUrl.substring(0, baseUrl.indexOf("visitors"));
				var url = baseUrl + "create-appointment";
				window.location.href = url;
				
			})
			.error(function(data) {
				console.log(data);
			});
		};
		// DELETE A Visitor ====================================================
		$scope.deleteVisitor = function(id) {
			$scope.loading = true; 
			var message = confirm("Are you sure you want to delete this visitor?")
			if (message) {
				// use the function we created in our service
				AllVisitorData.destroy(id)
					.success(function(data) {
						
						$scope.successTextAlert = data.success;
						$scope.showSuccessAlert = true;
						// if successful, we'll need to refresh the receptionist list
						AllVisitorData.get()
							.success(function(data) {
								$scope.visitors = data.visitors;
								$scope.loading = false;
								$timeout(function(){
									$scope.showSuccessAlert = false;
								}, 10000);
							});

					});
			}
		};
	})
	.controller('cameraController', function ($scope, $http, ModalData) {
		$scope.showModal = false;
		$scope.buttonClicked = "";
		$scope.toggleModal = function(btnClicked){
			$scope.buttonClicked = btnClicked;
			$scope.showModal = !$scope.showModal;
			
			Webcam.set({
				width: 320,
				height: 240,
				
				// device capture size
				dest_width: 640,
				dest_height: 480,
				
				// final cropped size
				//crop_width: 480,
				//crop_height: 480,
				
				// format and quality
				image_format: 'jpeg',
				jpeg_quality: 90,
			});
			Webcam.attach( '#my_camera' );
		};
		
		$scope.take_snapshot = function(){
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				$scope.appointmentData.image_url = data_uri;
				/*ModalData.createimage($scope.appointmentData)
				.success(function(data) {
					$scope.appointmentData.image_url = data.image_name;
				})
				.error(function(data) {
					console.log(data);
				});*/
				// display results in page
				document.getElementById('results').innerHTML =	'<img src="'+data_uri+'" alt=""/>';
			});
		};
		
		/** Capture Photo from IOS Device **/
		/*var desiredWidth;
		desiredWidth = window.innerWidth;
		
		if(!("url" in window) && ("webkitURL" in window)) {
			window.URL = window.webkitURL;   
		}
		$scope.gotPic = function(event) {
			console.log("Changed");
			
			if(event.target.files.length == 1 && 
			   event.target.files[0].type.indexOf("image/") == 0) {
				$scope.appointmentData.image_url = event.target.files[0];
				$("#results img").attr("src",URL.createObjectURL(event.target.files[0]));
			}
		}*/
		/** End Capture Photo from IOS Device **/
	});