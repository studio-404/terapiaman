var AJAX = "http://"+document.domain+"/ajax"; 

$(document).on("click",".register-button",function(){
	var email = $("#register-email").val(); 
	var password = $("#register-password").val(); 
	var repassword = $("#register-repassword").val(); 
	var namelname = $("#register-namelname").val(); 
	$(".form-control").css("border","solid 1px #1fa67a"); 
	if(email=="" || typeof(email)=="undefinded"){
		$("#register-error-message").html("ელ-ფოსტის ველი სავალდებულოა !<br/>").fadeIn("slow"); 
		$("#register-email").css("border","solid 1px #ff0000"); 
	}else if(validateEmail(email)!=true){
		$("#register-error-message").html("გადაამოწმეთ ელ-ფოსტის ველი !<br/>").fadeIn("slow"); 
		$("#register-email").css("border","solid 1px #ff0000"); 
	}else if(password=="" || typeof(password)=="undefinded"){
		$("#register-error-message").html("პაროლის ველი სავალდებულოა !<br/>").fadeIn("slow"); 
		$("#register-password").css("border","solid 1px #ff0000"); 
	}else if(repassword=="" || typeof(repassword)=="undefinded"){
		$("#register-error-message").html("გთხოვთ დაადასტუროთ პაროლი !<br/>").fadeIn("slow"); 
		$("#register-repassword").css("border","solid 1px #ff0000"); 
	}else if(password!=repassword){
		$("#register-error-message").html("პაროლები არ ემთხვევა ერთმანეთს !<br/>").fadeIn("slow"); 
		$("#register-repassword").css("border","solid 1px #ff0000"); 
	}else if(namelname=="" || typeof(namelname)=="undefinded"){
		$("#register-error-message").html("სახელი გვარის ველი სავალდებულოა !<br/>").fadeIn("slow"); 
		$("#register-namelname").css("border","solid 1px #ff0000"); 
	}else{
		$(".bs-example-modal-sm2").modal("hide");
		$(".loader-spin").fadeIn("slow"); 
		$.post(AJAX, { func:"insertuser", e:email, p:password, n:namelname }, function(result){
			$(".message-body").html(result);  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show");  
		});
	}
});

$(document).on("click","#auth-button",function(){
	var email = $("#auth-email").val(); 
	var password = $("#auth-pass").val(); 
	$(".form-control").css("border","solid 1px #1fa67a"); 
	if(email=="" || typeof(email)=="undefinded"){
		$("#register-error-message2").html("ელ-ფოსტის ველი სავალდებულოა !<br/>").fadeIn("slow"); 
		$("#auth-email").css("border","solid 1px #ff0000"); 
	}else if(validateEmail(email)!=true){
		$("#register-error-message2").html("გადაამოწმეთ ელ-ფოსტის ველი !<br/>").fadeIn("slow"); 
		$("#auth-email").css("border","solid 1px #ff0000"); 
	}else if(password=="" || typeof(password)=="undefinded"){
		$("#register-error-message2").html("პაროლის ველი სავალდებულოა !<br/>").fadeIn("slow"); 
		$("#auth-pass").css("border","solid 1px #ff0000"); 
	}else{
		$(".bs-example-modal-sm").modal("hide");
		$(".loader-spin").fadeIn("slow"); 
		$.post(AJAX, { func:"signin", e:email, p:password }, function(result){
			if(result=="true"){ 
				location.reload();
			}else{
				$(".message-body").html(result);  
				$(".loader-spin").fadeOut("slow"); 
				$(".message-box").modal("show");  
			}
		});
	}
});

$(document).on("click",".askquestion",function(){
	if($(this).hasClass("off")){
		$(".message-body").html("კითხვის დასმა შეუძლიათ მხოლოდ ავტორიზებულ მომხმარებლებს !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if($(this).hasClass("on")){
		$(".bs-example-modal-sm4").modal("show"); 
	}
});

$(document).on("keyup",".mycomment",function(){
	var val = $(this).val(); 
	var c = strlen(val);
	if(c>800){
		$(this).css({"color":"red","border":"solid 1px red"}); 
	}else if(c<=800){
		$(this).css({"color":"#555","border":"solid 1px #cccccc"}); 
	}
	$("#count").text(c); 
});

$(document).on("click",".addquestions",function(){
	var question = $(".mycomment").val();
	var mycomment = strlen(question); 
	$(".bs-example-modal-sm4").modal("hide"); 
	if(mycomment>800){
		$(".message-body").html("კითხვა არ უნდა აჭარბებდეს 800 სიმბოლოს !"); 
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show");  
	}else{
		$(".bs-example-modal-sm4").modal("hide"); 
		$(".loader-spin").fadeIn("slow"); 
		$.post(AJAX, { func:"addQuestion", q:question }, function(result){
			if(result==1){
				location.reload(); 
			}else{
				$(".loader-spin").fadeOut("slow"); 
				$(".message-body").html(result); 			
				$(".message-box").modal("show"); 
			}
		});
	}
	
});

$(document).on("click",".signout-button",function(){
	$(".loader-spin").fadeIn("slow"); 
	$.post(AJAX, { func:"signout" }, function(result){
		if(result=="true"){
			location.reload();
		}else{
			$(".message-body").html("მოხდა შეცდომა !");  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show");  
		}
	});
});


$(document).on("click",".heart",function(){
	var i = $(this).data("itemid");
	var s = $(this).data("signed");
	var countFav = parseInt($(".likes_"+i).html()) + 1;
	var countFavMin = parseInt($(".likes_"+i).html()) - 1;

	if(s=="no"){
		$(".message-body").html("სტატიის ფავორიტებში დამატებისთვის გთხოვთ გაიაროთ ავტორიზაცია !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else{
		if($(this).hasClass("off")){
			$(this).removeClass("off");
			$(this).addClass("on");
			$(".likes_"+i).html(countFav); 
			$(".loader-spin").fadeIn("slow"); 
			$.post(AJAX, { func:"addFavourites", item:i }, function(result){
				$(".message-body").html(result);  
				$(".loader-spin").fadeOut("slow"); 
				$(".message-box").modal("show"); 
			});
		}else if($(this).hasClass("on")){
			$(this).removeClass("on");
			$(this).addClass("off");
			$(".likes_"+i).html(countFavMin); 
			$(".loader-spin").fadeIn("slow"); 
			$.post(AJAX, { func:"removeFavourites", item:i }, function(result){
				$(".message-body").html(result);  
				$(".loader-spin").fadeOut("slow"); 
				$(".message-box").modal("show"); 
			});
		}
		
	}
});

$(document).on("click",".navbar-toggle",function(){
	$(".navigarion nav ul").slideToggle("slow"); 
});

$(document).on("click",".calc-button",function(){
	var weight = parseInt($("#weight").val());
	var height = parseInt($("#height").val()) / 100;

	if(weight > 0 && height > 0){
		var indexx = weight / (height * height);
		if(indexx < 18){ var msg = 'თქვენი წონა მკვეთრად ჩამოუვარდება ჯანსაღ წონას ! მიმართეთ ექიმს.'; }
		else if(indexx > 24.9 && indexx < 29){ var msg = 'კატეგორია ჭარბი წონა ! მიმართეთ ექიმს.'; }
		else if(indexx > 30){ var msg = 'კატეგორია მსუქანი ! მიმართეთ ექიმს '; }
		else{ var msg = 'თქვენ ჯანსაღი წონის ბრძანდებით !'; }
		$(".mycalc-popup").html('წონის ინდექსი: <b>'+parseInt(indexx)+'</b> <br /><font color="red">'+msg+'</font>');
	}else{
		$(".mycalc-popup").html("მოხდა შეცდომა !");
	}

});

function strlen(string) {
  var str = string + '';
  var i = 0,
    chr = '',
    lgth = 0;

  if (!this.php_js || !this.php_js.ini || !this.php_js.ini['unicode.semantics'] || this.php_js.ini[
    'unicode.semantics'].local_value.toLowerCase() !== 'on') {
    return string.length;
  }
}

function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function include(arr,obj) {
    return (arr.indexOf(obj) != -1);
}
