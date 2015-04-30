app.factory('PerguntaService', function ($http, BASE_URL) {
    var perguntas = [];
    var Pergunta = {
        create: function (pergunta) {
            return $http.post(BASE_URL + '/pergunta', pergunta);
        },
        read: function () {
            return $http.get(BASE_URL + '/pergunta');
        },
        readAll: function() {
            return $http.get(BASE_URL + '/pergunta');
        },
        delete: function (pergunta) {
            return $http.delete(BASE_URL + '/pergunta/' + pergunta.id);
        }
    };
    return Pergunta;
});
