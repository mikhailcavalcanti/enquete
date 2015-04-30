app.factory('RespostaService', function ($http, BASE_URL) {
    var Resposta = {
        read: function () {
            return $http.get(BASE_URL + '/resposta');
        },
        readAll: function () { return $http.get(BASE_URL + '/resposta'); }
    };
    return Resposta;
});
