app.controller('RespostaController', function ($rootScope, $scope, $http, RespostaService) {
    $scope.init = function () {
        $scope.pergunta = new PerguntaModel();
    };
    $scope.save = function (resposta) {
        if (false === resposta.temporario) {
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
        $scope.resposta = new RespostaModel();
    };
    // Listeners
    $scope.$on('setRespostasToScope', function (event, args) {
        $scope.pergunta = args.pergunta;
    });
    $scope.$on('setPerguntasToScope', function (event, args) {
        $scope.clean();
        $scope.pergunta = new PerguntaModel();
    });
});
