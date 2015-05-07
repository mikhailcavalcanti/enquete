app.controller('ResponderEnqueteController', function ($scope, EnqueteService, RespostaService) {
    $scope.init = function () {
        $scope.readAll();
    };
    $scope.readAll = function () {
        EnqueteService.readAll().success(function (data) {
            $scope.enquetes = data;
        });
    };
    $scope.votar = function (resposta) {
        RespostaService.votar(resposta)
                .success(function (data) {
                    resposta.quantidade_votos++;
                    alert('Sucesso');
                })
                .error(function (data) {
                    alert(data.messages);
                });
    };
});
