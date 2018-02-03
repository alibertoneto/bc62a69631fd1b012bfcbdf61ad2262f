var app = angular.module('app', ['atividades']);
app.controller('AppCtrl', function($scope, AppService) {
    $scope.nome = 'Erick';
    $scope.items = [];
    $scope.ativo = false;
    $scope.atividade = {};

    AppService.listar().then(function(resultado) {
        //$scope.items = resultado.results;
        var i = 0;
        $.each(resultado.results, function (indice, valor) {
            if (i < 6) {
                $scope.items[i] = valor;
            }
            i++;
        });
        console.log('$scope.items', $scope.items);
    });
    // $scope.clickDetalhes = clickDetalhes;
    // function clickDetalhes(nome) {
    //     $scope.ativo = true;
    //     AppService.detalhes(nome).then(function(resultado) {
    //         $scope.atividade = resultado;
    //         console.log('$scope.atividade', $scope.atividade);
    //     });
    // }
});
