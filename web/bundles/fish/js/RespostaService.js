app.factory('RespostaService', function ($http) {
	var respostas = [];
	var Resposta = {
		read: function() {
			return $http.get('http://enquete.xys/app_dev.php/resposta/.json');
		}
	};
	return Resposta;
});
