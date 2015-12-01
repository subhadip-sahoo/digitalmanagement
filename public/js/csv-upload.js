var data = $scope.formUpload ? {
	username: $scope.username
} : {};

if ($scope.generateErrorOnServer) {
	data.errorCode = $scope.serverErrorCode;
	data.errorMessage = $scope.serverErrorMsg;
}

file.upload = $upload.upload({
	url: $scope.uploadURL,
	method: 'POST',
	//headers: {'my-header' : 'my-header-value'},
	headers: {'Content-Type': file.type},
	//data: data,
	data: file,
	file: file,
	//fileFormDataName: 'myFile',
	
});

file.upload.then(function(response) {
	$timeout(function() {
		file.result = response.data;
	});
	
}, function(response) {
	if (response.status > 0)
		$scope.errorMsg = response.status + ': ' + response.data;
});

file.upload.progress(function(evt) {
	// Math.min is to fix IE which reports 200% sometimes
	file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
});

file.upload.xhr(function(xhr) {
	// xhr.upload.addEventListener('abort', function(){console.log('abort complete')}, false);
});