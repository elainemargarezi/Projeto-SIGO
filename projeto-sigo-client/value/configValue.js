//Value usado para configurações da aplicação, no lugar do value pode ser usado o constant
//eles são iguais, salvo que o constante pode ser injetado em serviços do tipo provider
app.value("config",{
	baseURL: "http://localhost",
	baseURLExterna: "http://localhost/projeto-sigo/projeto-sigo-server"
});