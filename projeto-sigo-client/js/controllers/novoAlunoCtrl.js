app.controller('novoAlunoCtrl', function($scope,$location,alunoAPI) {
	$scope.title = "Cadastro de Alunos";
    $scope.adicionarAluno = function(aluno) {
        alunoAPI.saveAluno(aluno).success(function(data){
            delete $scope.aluno;
            $scope.novoAlunoForm.$setPristine();
            $location.path("/pesquisaAluno");
        }).error(function(data) {
        	 console.log(data);
        });
    };
});