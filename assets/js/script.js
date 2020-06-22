// atualização chat
function atualizar() {
  $.ajax({
    type: "POST",
    url: "https://projetocomun.com/ajax/getMessages",
    dataType: "html",
    success: function (html) {
      $("#lista").html(html);
    },
    error: function () {
      alert("Ocorreu um erro");
    },
  });

  $("#lista").animate({ scrollTop: $("#lista")[0].scrollHeight });
}

$(function () {
  // mudança de cor da barra
  $(window).bind("scroll", function () {
    if ($(this).scrollTop() > 70) {
      $("#mainNav").addClass("bg-white");
      $("#mainNav a").css("color", "#F4511E");
      $("#mainNav li a").css("color", "#2c3e50");
      $("#mainNav").addClass("border");
    } else {
      $("#mainNav").removeClass("bg-white");
      $("#mainNav a").removeAttr("style");
      $("#mainNav").removeClass("border");
    }
  });

  // scroll suave
  $('a[href^="#"]').on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("href"),
      targetOffset = $(id).offset().top;

    $("html, body").animate(
      {
        scrollTop: targetOffset - 100,
      },
      100
    );
  });

  $('nav a[href^="#"]').on("click", function (e) {
    e.preventDefault();
    var id = $(this).attr("href"),
      targetOffset = $(id).offset().top;

    $("html, body").animate(
      {
        scrollTop: targetOffset - 100,
      },
      100
    );
  });

  // mudança de cor de fundo do form
  $("#formulario").bind("mouseover", function () {
    $(this)
      .css("background-color", "#f5f5f5")
      .css("transition", "0.5s all ease-in-out");
  });

  $("#formulario").bind("mouseout", function () {
    $(this).css("background-color", "#FFF");
  });

  //requisição ajax envio de e-mail
  $("#contactForm").bind("submit", function (e) {
    e.preventDefault();

    var form = $("#contactForm");

    $("#contactForm").validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        message: {
          required: true,
          minlength: 5,
          maxlength: 150,
        },
      },
      messages: {
        email: {
          required: "Favor preencher este campo",
          email: "Favor preencher com um e-mail válido",
        },
        message: {
          required: "Favor preencher este campo",
          minlength: "Digite uma mensagem de no mínimo 5 caracteres",
          maxlength: "Digite uma mensagem de no máximo 150 caracteres",
        },
      },
    });

    if (form.valid() == true) {
      var data = $("#contactForm").serializeArray();
      console.log(data);

      $.ajax({
        type: "POST",
        url: "https://projetocomun.com/ajax/enviarmensagem",
        data: data,
        dataType: "json",
        success: function (resultado) {
          if (resultado.status == "OK") {
            $("div #alert").html(
              '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Sucesso! </strong>Sua mensagem foi enviada, retornaremos em breve!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            $("#email").val("");
            $("#message").val("");
          } else {
            $("div #alert").html(
              '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível enviar sua mensagem, pelo menos um campo não foi preenchido!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
          }
        },
      });

      return false;
    } else {
      $("div #alert").html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível enviar sua mensagem tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      );
    }
  });

  // Validação add_user

  $("#add_user").bind("submit", function (e) {
    e.preventDefault();

    var form = $("#add_user");

    $("#add_user").validate({
      rules: {
        nome: {
          required: true,
          minWords: 2,
        },
        email: {
          required: true,
          email: true,
        },
        senha: {
          required: true,
          minlength: 5,
          maxlength: 15,
        },
      },
      messages: {
        nome: {
          required: "Favor preencher este campo",
          minWords: "O nome precisa ter no mínimo duas palavras",
        },
        email: {
          required: "Favor preencher este campo",
          email: "Favor preencher com um e-mail válido",
        },
        senha: {
          required: "Favor preencher este campo",
          minlength: "Digite uma senha de no mínimo 5 caracteres",
          maxlength: "Digite uma senha de no máximo 20 caracteres",
        },
      },
    });

    if (form.valid() == true) {
      var data = $("#add_user").serializeArray();

      $.ajax({
        type: "POST",
        url: "https://projetocomun.com/ajax/addUsuario",
        data: data,
        dataType: "json",
        success: function (resultado) {
          if (resultado.Status == "ok") {
            $("div #alert").html(
              '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Sucesso! </strong>Usuário cadastrado!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            console.log("entrou");

            $("#email").val("");
            $("#nome").val("");
            $("#senha").val("");
          } else {
            $("div #alert").html(
              '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível cadastrar usuário, verifique os dados e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );

            console.log("deu ruim");
          }
        },
      });

      return false;
    } else {
      $("div #alert").html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível cadastrar usuário, verifique os dados e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      );
    }
  });

  // Enviar arquivos administrador

  $("#form_envia_user").validate({
    rules: {
      arquivo: {
        required: true,
      },
      comment: {
        required: true,
        minlength: 5,
        maxlength: 100,
      },
    },
    messages: {
      arquivo: {
        required: "Você precisa selecionar um arquivo!",
      },
      comment: {
        required: "Favor preencher este campo",
        minlength: "Digite uma mensagem de no mínimo 5 caracteres",
        maxlength: "Digite uma mensagem de no máximo 100 caracteres",
      },
    },
  });

  // Enviar arquivos administrador

  $("#form_envia_arquivos_user").validate({
    rules: {
      arquivo: {
        required: true,
      },
      comment: {
        required: true,
        minlength: 5,
        maxlength: 100,
      },
    },
    messages: {
      arquivo: {
        required: "Você precisa selecionar um arquivo!",
      },
      comment: {
        required: "Favor preencher este campo",
        minlength: "Digite uma mensagem de no mínimo 5 caracteres",
        maxlength: "Digite uma mensagem de no máximo 100 caracteres",
      },
    },
  });

  // scroll edição de dados user

  $("#edita").hide();
  $("#envia").hide();

  $("#edita_user").bind("click", function () {
    $("#envia").hide();
    $("#edita").slideToggle("slow");
  });

  $("#envia_user").bind("click", function () {
    $("#edita").hide();
    $("#envia").slideToggle("slow");
  });

  // $('#chat_enviar').bind('click',function(){;
  // 	$('#chat').slideToggle('slow');
  // });
  //requisição para mostrar dados do usuário a ser editado
  $("#edita_user").bind("click", function (e) {
    e.preventDefault();

    const id = $("#id_user").val();

    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/getDadosUser",
      // data: {
      // 	id_user: id
      // },
      dataType: "json",
      success: function (resultado) {
        if (resultado.id == id) {
          $("#nome").val(resultado.nome);
          $("#email").val(resultado.email);
          $("#senha").val(resultado.senha);
        } else {
          $("#alert").html(
            '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível encontrar os dados, e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          );
        }
      },
    });
  });

  //requisição para eviar os dados do usuário editado
  // $('#envia_alter').bind('click', function (e) {
  // 	e.preventDefault();

  // 	var id = $('#id_user').val();
  // 	var nome = $('#nome').val();
  // 	var email = $('#email').val();
  // 	var senha = $('#senha').val()

  // 	$.ajax({
  // 		type: "POST",
  // 		url: "funcs/edita_user.php",
  // 		data: {
  // 			id_user: id,
  // 			nome: nome,
  // 			email: email,
  // 			senha: senha
  // 		},
  // 		dataType: "json",
  // 		success: function (resultado) {
  // 			if (resultado.Status == 'OK') {
  // 				$('#alert').html('<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Sucesso! </strong>Salvamos seus dados!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  // 			} else {
  // 				$('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível encontrar os dados, e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
  // 			}
  // 		}
  // 	});
  // });

  //requisição para eviar os dados do usuário editado(validação)

  $("#form_editar").bind("submit", function (e) {
    e.preventDefault();

    var form = $("#form_editar");

    $("#form_editar").validate({
      rules: {
        nome: {
          required: true,
          minWords: 2,
        },
        email: {
          required: true,
          email: true,
        },
        senha: {
          required: true,
          minlength: 5,
          maxlength: 15,
        },
      },
      messages: {
        nome: {
          required: "Favor preencher este campo",
          minWords: "O nome precisa ter no mínimo duas palavras",
        },
        email: {
          required: "Favor preencher este campo",
          email: "Favor preencher com um e-mail válido",
        },
        senha: {
          required: "Favor preencher este campo",
          minlength: "Digite uma senha de no mínimo 5 caracteres",
          maxlength: "Digite uma senha de no máximo 20 caracteres",
        },
      },
    });

    if (form.valid() == true) {
      var data = $("#form_editar").serializeArray();

      $.ajax({
        type: "POST",
        url: "https://projetocomun.com/ajax/salvarAlteracoesUser",
        data: data,
        dataType: "json",
        success: function (resultado) {
          if (resultado.Status == "OK") {
            $("#alert").html(
              '<div class="alert alert-primary alert-dismissible fade show" role="alert"><strong>Sucesso! </strong>Salvamos seus dados!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
          } else {
            $("#alert").html(
              '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível encontrar os dados, e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            );
          }
        },
      });

      return false;
    } else {
      $("div #alert").html(
        '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Erro! </strong>Não foi possível editar usuário, verifique os dados e tente novamente!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
      );
    }
  });

  // scroll do chat
  console.log(window.location.pathname);
  // if (window.location.pathname == "/projetocomun/chat/conversa") {
  setInterval("atualizar()", 3000);
  // }
  $("#form-chat").bind("submit", function (e) {
    e.preventDefault();

    var txt = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/sendMessage",
      data: txt,
      success: function (result) {
        $("#status").html("tudo funcionando: " + result);
      },
    });

    $("#mensagem").val("");
  });

  //busca de usuarios sem refresh
  $("#pesquisa").keyup(function () {
    var pesquisa = $(this).val();

    //Verificar se há algo digitado
    if (pesquisa == "") {
      var dados = {
        palavra: pesquisa,
      };
      $.post("https://projetocomun.com/ajax/buscaUsers", dados, function (
        retorna
      ) {
        //Mostra dentro da ul os resultado obtidos
        $(".pagination").show();
        $("#content").html(retorna);
      });
    } else if (pesquisa != "") {
      var dados = {
        palavra: pesquisa,
      };
      $.post("https://projetocomun.com/ajax/buscaUsers", dados, function (
        retorna
      ) {
        //Mostra dentro da ul os resultado obtidos
        $(".pagination").hide();
        $("#content").html(retorna);
      });
    } else {
      $("#content").html("");
    }
  });

  // função para checar mensagens visualizadas

  if (window.location.pathname == "/admin/mensagem") {
    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/atualizarStatusMensagens",
      dataType: "json",
      success: function (resultado) {
        if (resultado.Status == "OK") {
          console.log("Status Atualizado");
        } else {
          console.log("Erro ao atualizar status");
        }
      },
    });
  }

  // função para checar arquivos visualizados

  // $('.acessa').bind('click',function(e){

  // 	e.preventDefault();
  // 	var teste = $(this).attr("href");
  // 	var repartido = teste.split('=');
  // 	var id = repartido[1];

  // 	console.log(id);

  // 	$.ajax({
  // 		type: "POST",
  // 		url: "funcs/atualiza_arquivos.php",
  // 		data:{ id_user : id },
  // 		dataType: "json",
  // 		success: function (resultado) {
  // 			if (resultado.Status == 'OK') {
  // 				console.log("Status Atualizado");
  // 			} else {
  // 				console.log("Erro ao atualizar status");
  // 			}
  // 		}
  // 	});
  // 	$(location).attr('href', 'caixa_arquivos_admin.php?id_user='+id);
  // });
});

// desativar usuario
function deactivateUser(id) {
  $("#ExcluirUsuario").modal("show");

  let confirmaExclusao = document.querySelector("#confirmaExcluir");

  confirmaExclusao.addEventListener("click", () => {
    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/deactivateUser",
      data: { id: id },
      success: function () {
        linhas = $("#usersList>tbody>tr");
        e = linhas.filter(function (i, elemento) {
          return elemento.cells[0].textContent == id;
        });
        if (e) {
          e.fadeOut(400, function () {
            this.remove();
          });
        }
      },
    });
    $("#ExcluirUsuario").modal("hide");
  });
}

// deletar usuario
function deleteUser(id) {
  $("#ExcluirUsuario").modal("show");

  let confirmaExclusao = document.querySelector("#confirmaExcluir");

  confirmaExclusao.addEventListener("click", () => {
    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/delete",
      data: { id: id },
      success: function () {
        linhas = $("#usersList>tbody>tr");
        e = linhas.filter(function (i, elemento) {
          return elemento.cells[0].textContent == id;
        });
        if (e) {
          e.fadeOut(400, function () {
            this.remove();
          });
        }
      },
    });
    $("#ExcluirUsuario").modal("hide");
  });
}

// Reativar usuario
function activateUser(id) {
  $("#ReativarUsuario").modal("show");

  let confirmaExclusao = document.querySelector("#confirmaReativar");

  confirmaExclusao.addEventListener("click", () => {
    $.ajax({
      type: "POST",
      url: "https://projetocomun.com/ajax/reativarUser",
      data: { id: id },
      success: function () {
        linhas = $("#usersList>tbody>tr");
        e = linhas.filter(function (i, elemento) {
          return elemento.cells[0].textContent == id;
        });
        if (e) {
          e.fadeOut(400, function () {
            this.remove();
          });
        }
      },
    });
    $("#ReativarUsuario").modal("hide");
  });
}
