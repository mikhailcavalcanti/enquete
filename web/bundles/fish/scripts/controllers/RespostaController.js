app.controller('RespostaController', function ($rootScope, $scope, $http, RespostaService) {
    $scope.save = function (resposta) {
        if (!resposta.temporario) {
            resposta.quantidade_votos = 0;
            resposta.temporario = true;
            $scope.pergunta.respostas.push(resposta);
        }
        $scope.clean();
    };
    $scope.edit = function (resposta) {
        $scope.resposta = resposta;
    };
    $scope.delete = function (index) {
        if (confirm('Deseja deletar esta resposta?')) {
            $scope.pergunta.respostas.splice(index, 1);
        }
    };
    $scope.clean = function () {
        $scope.resposta = {id: null, resposta: null};
    };
    // Listeners
    $scope.$on('setRespostasToScope', function (event, args) {
        $scope.pergunta = args.pergunta;
    });
});
