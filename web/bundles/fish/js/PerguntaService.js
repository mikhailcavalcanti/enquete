app.factory('PerguntaService', function ($http, BASE_URL) {
    var perguntas = [];
    var Pergunta = {
        read: function () {
            return $http.get(BASE_URL + '/pergunta');
        }
    };
    return Pergunta;
});
