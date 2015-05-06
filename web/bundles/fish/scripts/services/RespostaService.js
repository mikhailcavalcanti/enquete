app.factory('RespostaService', function ($http, BASE_URL) {
    var Resposta = {
        create: function (resposta) {
            return $http.post(BASE_URL + '/resposta', resposta);
        },
        update: function (resposta) {
            return $http.put(BASE_URL + '/resposta/' + resposta.id, resposta);
        },
        readAll: function () {
            return $http.get(BASE_URL + '/resposta');
        },
        delete: function (resposta) {
            return $http.delete(BASE_URL + '/resposta/' + resposta.id);
        },
        votar: function (resposta) {
            return $http.patch(BASE_URL + '/resposta/' + resposta.id, { operation: 'increase', fragment: 'quantidade_votos' });
        }
    };
    return Resposta;
});
