app.controller('populaFormCtrl', function($scope,aluno) {
     $scope.title = "Modo de Edição e Visualização";
	 $scope.alunos = aluno.data.result[0];
     $scope.editarAluno = function(aluno){
        console.log("editar");
     };
});