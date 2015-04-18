app.factory('EnqueteService', function ($http) {
	var enquetes = [];
	var Enquete = {
		create: function(enquete) {
			return $http.post('http://enquete.xys/app_dev.php/enquete/', enquete);
		},
		read: function() {
			return $http.get('http://enquete.xys/app_dev.php/enquete/.json');
		}
	};
	return Enquete;
});
