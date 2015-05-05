app.controller('PerguntaController', function ($rootScope, $scope) {
    $scope.init = function () {
        $scope.pergunta = PerguntaModel;
    };
    $scope.save = function (pergunta) {
        if (!pergunta.temporario) {
            pergunta.temporario = true;
            $scope.perguntas.push(pergunta);
        }
        $scope.clean();
    };
    $scope.edit = function (pergunta) {
        $scope.pergunta = pergunta;
        $scope.selecionarPergunta(pergunta);
    };
    $scope.delete = function (index) {
        if (confirm('Deseja deletar esta pergunta?')) {
            $scope.perguntas.splice(index, 1);
        }
    };
    $scope.clean = function () {
        $scope.pergunta = {id: null, pergunta: null, respostas: []};
    };
    $scope.selecionarPergunta = function (pergunta) {
        $scope.perguntas.forEach(function (perguntaScope) {
            perguntaScope.selecionada = perguntaScope.id === pergunta.id;
        });
        $rootScope.$broadcast('setRespostasToScope', {pergunta: pergunta});
    };
    // Listeners
    $scope.$on('setPerguntasToScope', function (event, args) {
        $scope.perguntas = args.enquete.perguntas;
    });
});
