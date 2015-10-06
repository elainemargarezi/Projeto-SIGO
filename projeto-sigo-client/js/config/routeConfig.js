app.config(function($routeProvider){
	$routeProvider.when("/",{
		templateUrl:"views/home.html",
		controller:"homeCtrl"
	});
	$routeProvider.when("/novaOcorrencia",{
		templateUrl:"views/novaOcorrencia.html",
		controller:"novaOcorrenciaCtrl"
	});
	$routeProvider.when("/novoParecer",{
		templateUrl:"views/novoParecer.html",
		controller:"novoParecerCtrl"
	});
	$routeProvider.when("/novoAluno",{
		templateUrl:"views/novoAluno.html",
		controller:"novoAlunoCtrl"
	});
	$routeProvider.when("/pesquisaOcorrencia",{
		templateUrl:"views/pesquisaOcorrencia.html",
		controller:"pesquisaOcorrenciaCtrl"
	});
	$routeProvider.when("/pesquisaParecer",{
		templateUrl:"views/pesquisaParecer.html",
		controller:"pesquisaParecerCtrl"
	});
	$routeProvider.when("/pesquisaFeedback",{
		templateUrl:"views/pesquisaFeedback.html",
		controller:"pesquisaFeedbackCtrl"
	});
	$routeProvider.when("/pesquisaAluno",{
		templateUrl:"views/pesquisaAluno.html",
		controller:"pesquisaAlunoCtrl",
		resolve: {
			aluno: function(alunoAPI) {
				return alunoAPI.getAlunos();
			}
		}
	});
	$routeProvider.when("/novoAluno/:id",{
		templateUrl:"views/novoAluno.html",
		controller:"populaFormCtrl",
		resolve: {
			aluno: function(alunoAPI,$route) {
				return alunoAPI.getAluno($route.current.params.id);
			}
		}
	});
	$routeProvider.otherwise({redirectTo:"/"});
});