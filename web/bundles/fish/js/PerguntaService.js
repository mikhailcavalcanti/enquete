app.factory('PerguntaService', function ($http) {
	var perguntas = [];
	var Pergunta = {
		read: function() {
			return $http.get('http://enquete.xys/app_dev.php/pergunta/.json');
		}
	};
	return Pergunta;
});
