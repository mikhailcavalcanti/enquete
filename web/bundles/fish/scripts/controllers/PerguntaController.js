app.controller('PerguntaController', function ($rootScope, $scope) {
    $scope.init = function () {
        $scope.pergunta = new PerguntaModel();
    };
    $scope.save = function (pergunta) {
        if (false === pergunta.temporario) {
            pergunta.temporario = true;
            $scope.enquete.perguntas.push(pergunta);
        }
        $scope.clean();
    };
    $scope.edit = function (pergunta) {
        $scope.pergunta = pergunta;
        $scope.selecionarPergunta(pergunta);
    };
    $scope.delete = function (index) {
        if (confirm('Deseja deletar esta pergunta?')) {
            $scope.enquete.perguntas.splice(index, 1);
        }
    };
    $scope.clean = function () {
        $scope.pergunta = new PerguntaModel();
    };
    $scope.selecionarPergunta = function (pergunta) {
        $scope.enquete.perguntas.forEach(function (perguntaScope) {
            perguntaScope.selecionada = perguntaScope.id === pergunta.id;
        });
        $rootScope.$broadcast('setRespostasToScope', {pergunta: pergunta});
    };
    // Listeners
    $scope.$on('setPerguntasToScope', function (event, args) {
        $scope.enquete.perguntas = args.enquete.perguntas;
    });
});
