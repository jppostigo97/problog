// TODO: change if uploaded to any host
const APP_PATH = "https://jppostigo97.000webhostapp.com/";

function displayError(id, title, content) {
	$("#" + id).html(
		"<div class=\"error-title\">" + title + "</div>" +
		"<div class=\"error-content\">" + content + "</div>"
	);
	$("#" + id).show();
}

function validateLogin(e) {
	e.preventDefault();
	
	let username = $("#login_username").val();
	let password = $("#login_password").val();
	
	$.get(APP_PATH + "app/api/session/validate_login.php", {
		username: username,
		password: password
	}, function(data, status, jqxhr) {
		if (data == "true") {
			location.reload(true);
		} else {
			displayError("session-error", "Credenciales no válidas",
				"Las credenciales que has introducido no son válidas.");
		}
	});
}

function validateRegister(e) {
	e.preventDefault();
	
	let email    = $("#register_email").val();
	let username = $("#register_username").val();
	let password = $("#register_password").val();
	
	$.post(APP_PATH + "app/api/session/validate_register.php", {
		email: email,
		username: username,
		password: password
	}, function(data, status, jqhxr) {
		if (data == "true") {
 		} else {
			let error    = JSON.parse(data).error;
			let errorMsg = "";
			
			if (error == "email") {
				errorMsg = "La dirección de correo electrónico que has escogido ya está en uso.";
			} else if (error == "username") {
				errorMsg = "El nombre de usuario que has escogido ya está en uso.";
			} else {
				errorMsg = "Se ha producido un error al registrarte";
			}
			
			displayError("session-error", "Error al registrar", errorMsg);
		}
	});
}

function validateComment(e) {
	e.preventDefault();
	
	let author  = $("#comment-author-id").val();
	let comment = $("#new-comment-content").val();
	let post    = $("#comment-post-id").val();
	
	$.post(APP_PATH + "app/api/post/validate_comment.php", {
		"author":  author,
		"content": comment,
		"postid":  post
	}, function(data, status, jqhxr) {
		if (data != "true") {
			displayError("comment-error", "Error al comentar",
				"Se ha producido un error al comentar. " +
				"Por favor, inténtelo más tarde.");
		} else {
			location.reload(true);
		}
	});
}

$(function() {
	$("#login-toggle").click(function(e) {
		e.preventDefault();
		$("#session-content").slideToggle();
	});
	
	$("form#login").submit(validateLogin);
	$("form#register").submit(validateRegister);
	
	$("#write-comment").submit(validateComment);
	
	$(".btn.delete").click(function(e) {
		if (!confirm("¿Eliminar?")) e.preventDefault();
	});
});
