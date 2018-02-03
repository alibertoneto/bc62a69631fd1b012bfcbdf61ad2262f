const appService = angular.module('atividades', []);
appService.service('AppService', function($http) {
    return {
        listar: function() {
            return $http
                .get(
                    'https://sandboxapi.campuse.ro/agenda/list/campus-party-brasil-2018/',
                )
                .then(function(result) {
                    return result.data;
                })
                .catch(function(erro) {
                    console.log('deu ruim!!!', erro);
                });
        },
        detalhes: function(nome) {
            return $http
                .get('https://campuse.ro/api/v2/events/activity/' + nome)
                .then(function(result) {
                    return result.data;
                })
                .catch(function(erro) {
                    console.log('deu ruim!!!', erro);
                });
        },
    };
});