
angular.module('todoApp', ['files'])
  .controller('mp3Controller', function($scope, $http, $httpParamSerializer, $fileUploader) {

	$scope.alert = {
		Status:false,
		Text: "",
		Class:""
	};
	$scope.progress = true;
    	$scope.mp3 = [];
 	data = {"index":"null"},
	url = "index.php/api/listmp3/";
	var mp3List = {};
	mp3List.listing = function() {
	$http({
		method: 'post', 
		url: url, 
		headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		data: $httpParamSerializer(data)
		})
		.success(function(data, status) {
			angular.forEach(data.text, function(value, key){;
				$scope.mp3.push(value);
			});
        	});
	};
	mp3List.listing();
	// create a uploader with options
        var uploader = $fileUploader.create({
            url: 'index.php/api/upload',
            removeAfterUpload: true,
        });
        uploader.bind( 'afteraddingfile', function( event, item ) {

		$scope.progress=true;
		$scope.$$phase || $scope.$apply();
	});
	/* Review for later use
	uploader.bind( 'afteraddingall', function( event, items ) {console.log( 'After adding all files', items );});
        uploader.bind( 'changedqueue', function( items ) {$scope.$$phase || $scope.$apply();});
        uploader.bind( 'beforeupload', function( event, item ) {$scope.$apply();console.log( 'Before upload', item );});
        uploader.bind( 'progress', function( event, item, progress ) {console.log( 'Progress: ' + progress );});
        uploader.bind( 'success', function( event, xhr, item ) {console.log( 'Success: ' + xhr.response );});
	*/
        uploader.bind( 'complete', function( event, xhr, item ) {

		var r = angular.fromJson(xhr.response);
		$scope.alert.Status = true;
		if(r.error) {
			$scope.alert.Text = r.error.replace(/<[^>]+>/gm, '');
			$scope.alert.Class="uk-alert-danger";

		} else {
			$scope.alert.Text = "Success!!";
			$scope.alert.Class="uk-alert-success";
			$scope.mp3.unshift({ id: r.id, title: r.title, preview: r.preview, original: r.original });
		}

		$scope.progress=false;
		$scope.$$phase || $scope.$apply();
        });
        /* Review for later use
	uploader.bind( 'progressall', function( event, progress ) {console.log( 'Total progress: ' + progress );});
        uploader.bind( 'completeall', function( event, items ) {console.log( 'All files are transferreds' );$scope.alert.Status=true;});
	*/
        $scope.uploader = uploader;
  });

