app.controller('RespostaController', function ($rootScope, $scope, $http, RespostaService) {
    $scope.save = function (resposta) {
        if (!resposta.id) {
            $scope.create(resposta);
        } else {
            $scope.update(resposta);
        }
    };
    $scope.edit = function (resposta) {
        $scope.resposta = resposta;
    };
    $scope.create = function (resposta) {
        RespostaService.create(resposta).success(function (data, status) {
            if (status === 201) {
                $scope.respostas.push(angular.copy(data));
                $scope.clean();
                alert('Sucesso');
            }
        });
    };
    $scope.readAll = function () {
        RespostaService.readAll().success(function (respostas) {
            $scope.respostas = respostas;
        });
    };
    $scope.update = function (resposta) {
        RespostaService.update(resposta).success(function (data, status) {
            if (status === 200) {
                $scope.clean();
                alert('Sucesso');
            }
        });
    };
    $scope.delete = function (resposta) {
        if (confirm('Deseja deletar esta resposta de TODAS as enquetes?')) {
            RespostaService.delete(resposta).success(function (respostadata, status) {
                if (204 === status) {
                    for (var index = 0; index < $scope.respostas.length; index++) {
                        if ($scope.respostas[index].id === resposta.id) {
                            $scope.respostas.splice(index, 1);
                            $scope.clean();
                        }
                    }
                }
            });
        }
    };
    $scope.clean = function () {
        $scope.resposta = {id: null, resposta: null};
    };
    $scope.addRespostaToPergunta = function (resposta) {
//        $scope.$emit('addRespostaToPergunta', {respsota: resposta});
        $rootScope.$broadcast('addRespostaToPergunta', {resposta: resposta});
    };
});
