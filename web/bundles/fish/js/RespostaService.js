app.factory('RespostaService', function ($http, BASE_URL) {
    var respostas = [];
    var Resposta = {
        read: function () {
            return $http.get(BASE_URL + '/resposta');
        }
    };
    return Resposta;
});
