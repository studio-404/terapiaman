var AJAX = "http://"+document.domain+"/ajax"; 

$(document).on("click", ".logo", function(){
	location.href = "http://"+document.domain;
});

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
	}else if(strlen(password) < 6){
		$("#register-error-message").html("პაროლის უნდა აღემატებოდეს 5 სიმბოლოს !<br/>").fadeIn("slow"); 
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

$(document).on("click",".readActivity", function(){
	var link = $(this).attr("data-urllink"); 
	var acid = $(this).attr("data-acid"); 
	$(".loader-spin").fadeIn("slow"); 
	$.post(AJAX, { func:'readActivity', i:acid }, function(r){
		var obj = $.parseJSON(r); 
		if(obj.error=="false"){
			location.href = link;
		}else{
			$(".loader-spin").fadeOut("slow"); 
			$(".message-body").html(obj.message);
			$(".message-box").modal("show");
		}
	});
});

$(document).on("click","#newpassword_button", function(){
	var newpassword = $("#newpassword").val();
	var comfirmNewPassword = $("#comfirmNewPassword").val();
	var param = urlParamiters();
	if(typeof(newpassword)=="undefinded" || newpassword=="" || typeof(comfirmNewPassword)=="undefinded" || comfirmNewPassword==""){
		$(".message-body").html("ყველა ველი სავალდებულოა !");  		
		$(".message-box").modal("show");
	}else if(strlen(newpassword) < 6){
		$(".message-body").html("პაროლი უნდა აღემატებოდეს 5 სიმბოლოს !");  		
		$(".message-box").modal("show");
	}else if(newpassword!=comfirmNewPassword){
		$(".message-body").html("პაროლები არ ემთხვევა ერტმანეთს !");  		
		$(".message-box").modal("show");
	}else{
		$(".loader-spin").fadeIn("slow"); 
		$.post(AJAX, { func:"rsPaswd", n:newpassword, c:comfirmNewPassword, re:param['recover'] }, function(r){
			var obj = $.parseJSON(r); 
			$(".loader-spin").fadeOut("slow"); 
			$(".message-body").html(obj.message);  		
			$(".message-box").modal("show"); 
			$("#newpassword").val('');
			$("#comfirmNewPassword").val('');
		});
	}
});

$(document).on("keyup",".mycomment",function(){
	var val = $(this).val(); 
	var c = strlen(val);
	var max = $(this).attr("data-maxlength"); 
	if(c>max){
		$(this).css({"color":"red","border":"solid 1px red"}); 
	}else if(c<=max){
		$(this).css({"color":"#555","border":"solid 1px #cccccc"}); 
	}
	$("#count").text(c); 
});

$(document).on("click",".addquestions",function(){
	var question = $(".mycomment").val();
	var anonim = $("#anonim").val();
	var max = $(".mycomment").attr("data-maxlength");
	var mycomment = strlen(question); 
	$(".bs-example-modal-sm4").modal("hide"); 
	if(mycomment>max){
		$(".message-body").html("კითხვა არ უნდა აჭარბებდეს "+max+" სიმბოლოს !"); 
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show");  
	}else{
		$(".bs-example-modal-sm4").modal("hide"); 
		$(".loader-spin").fadeIn("slow"); 
		$.post(AJAX, { func:"addQuestion", q:question, an:anonim }, function(result){
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
				if($("#myfavx_"+i).length){
					$("#myfavx_"+i).hide();
				}
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

$(document).on("click",".replay-link",function(){
	$('html, body').animate({
        scrollTop: $("#replay").offset().top
    }, 1000, function(){
    	$("#replay").focus();
    });
    
});

$(document).on("focus","#replay", function(){
	$(this).animate({
        height: 200 
    }, 500);
});

$(document).on("click","#contact_button",function(){
	var name = $("#contact_namelname").val();
	var subject = $("#contact_subject").val();
	var email = $("#contact_email").val();
	var message = $("#contact_message").val();
	$(".loader-spin").fadeIn("slow"); 
	$.post(AJAX, { func:"sendFeedback", n:name, s:subject, e:email, m:message }, function(result){
		var obj = $.parseJSON(result); 
		if(obj.error=="false"){
			$("#contact_namelname").val('');
			$("#contact_subject").val('');
			$("#contact_email").val('');
			$("#contact_message").val('');
		}
		$(".loader-spin").fadeOut("slow"); 
		$(".message-body").html(obj.message);  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	});
});

$(document).on("click","#recover_button",function(){
	var em = $("#recover_email").val(); 
	$(".loader-spin").fadeIn("slow"); 
	$.post(AJAX, { func:"recoverEmail", e:em }, function(result){
		var obj = $.parseJSON(result); 
		if(obj.error=="false"){
			$("#recover_email").val('');
		}
		$(".loader-spin").fadeOut("slow"); 
		$(".message-body").html(obj.message);  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	});
});

$(document).on("click",".removeQuestion",function(){
	var qid = $(this).attr("data-qid");
	var offon = $(this).attr("data-offon");
	if(offon=="off"){
		$(".message-body").html("გთხოვთ გაიაროთ ავტორიზაცია !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else{
		$(".message-body").html("<label id=\"comfirme_message\" style=\"float:left; width:100%\">გნებავთ მონაცემის წაშლა ?</label><div style=\"clear:both\"></div><a href=\"javascript:;\" class=\"btn btn-primary comfirm_yes\" data-qid=\""+qid+"\" role=\"button\" style=\"float:left; width:100%\">წაშლა</a><div style=\"clear:both\"></div>");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}
});

//
$(document).on("click",".removeAnswer",function(){
	var aid = $(this).attr("data-aid");
	var offon = $(this).attr("data-offon");
	if(offon=="off"){
		$(".message-body").html("გთხოვთ გაიაროთ ავტორიზაცია !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else{
		$(".message-body").html("<label id=\"comfirme_message\" style=\"float:left; width:100%\">გნებავთ მონაცემის წაშლა ?</label><div style=\"clear:both\"></div><a href=\"javascript:;\" class=\"btn btn-primary comfirm_yes_answer\" data-aid=\""+aid+"\" role=\"button\" style=\"float:left; width:100%\">წაშლა</a><div style=\"clear:both\"></div>");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}
});

$(document).on("click",".comfirm_yes", function(){
	var qid = $(this).attr("data-qid");
	$.post(AJAX, { func:"removeQuestion", q:qid }, function(result){
		var obj = $.parseJSON(result); 
		if(obj.error=="false"){
			location.href = "http://"+document.domain+"/კითხვა-პასუხი";
		}else{
			$(".message-body").html(obj.error);  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show"); 
		}
	});
});

$(document).on("click",".comfirm_yes_answer", function(){
	var aid = $(this).attr("data-aid");
	$.post(AJAX, { func:"removeAnswer", a:aid }, function(result){
		var obj = $.parseJSON(result); 
		if(obj.error=="false"){
			location.reload();
		}else{
			$(".message-body").html(obj.error);  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show"); 
		}
	});
});

$(document).on("click","#replay-answer",function(){
	var replay = $("#replay").val(); 
	var c = strlen(replay);
	var hqid = $("#hqid").val();
	var max = $("#replay").attr("data-maxlength"); 
	var min = parseInt($("#replay").attr("data-minlength")); 
	var minInt = min+1;
	var offon = $("#replay").attr("data-offon"); 
	if(offon=="off"){
		$(".message-body").html("გთხოვთ გაიაროთ ავტორიზაცია !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(c<=min){
		$(".message-body").html("პასუხი უნდა შედგებოდეს მინიმუმ "+minInt+" სიმბოლოსგან !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(c<=max){
		$.post(AJAX, { func:"addReplay", r:replay, q:hqid }, function(result){
			var obj = $.parseJSON(result);
			if(obj.error=="false"){
				$("#replay").val('');
				$("#typed").html("0");
			    var ins = '<div class="media" id="i'+obj.success.insertid+'" itemprop="suggestedAnswer" itemscope itemtype="http://schema.org/Answer">';
			    ins += '<div class="media-left" style="min-width:100px;">';
			    ins += '<div class="post-date">';
			    ins += '<div class="all">';
			    ins += '<span class="day">'+obj.success.date.day+'</span>';
			    ins += '<span class="month">'+obj.success.date.month+'</span>';
			    ins += '<span class="year">'+obj.success.date.year+'</span>';
			    ins += '<span class="time">'+obj.success.date.time+'</span>';
			    ins += '</div>';
			    ins += '</div>';
			    ins += '</div>';
			    ins += '<div class="media-body">';
			    ins += '<h4 class="media-heading">'+obj.success.namelname+'</h4>';
			    ins += '<p style="min-height:55px;" itemprop="text">'+obj.success.answer+'</p>';
			    ins += '<div class="actions-box">';
			    ins += '<a href=""><i class="fa fa-times" aria-hidden="true"></i>&nbsp;&nbsp; წაშლა</a>';
			    ins += '</div><div style="clear:both"></div></div></div>';
			    ins += '<div style="clear:both"></div>';
			    $(".alert-danger").hide();
			    $(".answers-box").prepend(ins);
			    $('html, body').animate({
			        scrollTop: $("#i"+obj.success.insertid).offset().top
			    }, 1000, function(){
			    	$("#replay").focus();
			    });
			}else{
				$(".message-body").html(obj.error);  
				$(".loader-spin").fadeOut("slow"); 
				$(".message-box").modal("show"); 
			}			
		});
	}
});

$(document).on("keyup","#replay",function(){
	var val = $(this).val(); 
	var c = strlen(val);
	var max = $(this).attr("data-maxlength");
	if(c>max){
		$(this).css({"color":"red","border":"solid 1px red"}); 
	}else if(c<=max){
		$(this).css({"color":"#555","border":"solid 1px #cccccc"}); 
	}
	$("#typed").text(c); 
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

$(document).on("click","#mystatia_button", function(){
	var type = $(this).attr("data-type");
	var date = $("#date").val();
	var category = $("#category").val();
	var title = encodeURIComponent($("#title").val());
	var metatitle = encodeURIComponent($("#metatitle").val());
	var metadescription = encodeURIComponent(tinyMCE.get('metadescription').getContent());
	var shortdescription = encodeURIComponent(tinyMCE.get('shortdescription').getContent());
	var text = encodeURIComponent(tinyMCE.get('text').getContent());
	var tags = $("#tags").val();
	$(".loader-spin").fadeOut("slow"); 
	if(typeof(date)=="undefined" || date==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 1!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(category)=="undefined" || category==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 2!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(title)=="undefined" || title==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 3!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(metatitle)=="undefined" || metatitle==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 4!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(metadescription)=="undefined" || metadescription==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 5!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(shortdescription)=="undefined" || shortdescription==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 6!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(text)=="undefined" || text==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 7!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else if(typeof(tags)=="undefined" || tags==""){
		$(".message-body").html("ყველა ველი სავალდებულოა 8!");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else{
		$(".loader-spin").fadeIn("slow"); 
		if(type=="add"){ var fff = "addStatia"; var statia_id = 0; }else{ var fff = "editStatia"; var statia_id = $("#statia_id").val(); }
		$.post(AJAX, { func:fff, d:date, ca:category, t:title, mt:metatitle, md:metadescription, sd:shortdescription, te:text, ta:tags, stid:statia_id },function(r){
			var obj = $.parseJSON(r);
			if(obj.error!="true"){
				if(type=="add"){
					console.log(obj.url);
					location.href = obj.url;
				}else{
					$(".message-body").html(obj.message);  
					$(".loader-spin").fadeOut("slow"); 
					$(".message-box").modal("show");
				}
			}else{
				$(".message-body").html(obj.message);  
				$(".loader-spin").fadeOut("slow"); 
				$(".message-box").modal("show"); 
			}
		});
	}
});

$(document).on("click", ".deleteMyStatia", function(){
	var sid = $(this).attr("data-itemid"); 
	$.post(AJAX, { func:"removeMyStatia", i:sid }, function(r){
		var obj = $.parseJSON(r);
		if(obj.error!="true"){
			location.reload();
		}else{
			$(".message-body").html(obj.message);  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show"); 
		}
	});
});

$(document).on("click","#edit-chvnshesaxeb",function(){
	var chvenshesaxebtext = tinyMCE.get('chvenshesaxebtext').getContent();
	$(".loader-spin").fadeIn("slow"); 
	$.post(AJAX, { func:'updateChvenShesaxeb', c:chvenshesaxebtext }, function(r){
		var obj = $.parseJSON(r); 
		$(".message-body").html(obj.message);  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show");
	});
});

$(document).on("click",'.anonim-box', function(){
	var anonim = $('#anonim').val();
	if(anonim==1){
		$('#anonim').val(2);
		$('.anonim-box i').removeClass('fa-toggle-off').addClass('fa-toggle-on');
	}else{
		$('#anonim').val(1);
		$('.anonim-box i').removeClass('fa-toggle-on').addClass('fa-toggle-off');
	}
});

$(document).on("click","#updateprofile", function(){
	var namelname = $("#namelname").val();
	var phonenumber = $("#phonenumber").val();
	var email = $("#email").val();
	$(".loader-spin").fadeIn("slow"); 
	if(typeof(namelname)=="undefined" || namelname==""){
		$(".message-body").html("სახელი გვარის ველი სავალდებულოა !");  
		$(".loader-spin").fadeOut("slow"); 
		$(".message-box").modal("show"); 
	}else{
		$.post(AJAX, { func:"updateprofile", n:namelname, p:phonenumber, e:email }, function(r){
			var obj = $.parseJSON(r); 
			$(".message-body").html(obj.message);  
			$(".loader-spin").fadeOut("slow"); 
			$(".message-box").modal("show"); 
		});
	}
});

$(document).on("click","#search-button",function(){
	var whereToSearch = $("#whereToSearch").val();
	var search = $("#search").val();
	if(strlen(search) <= 3){
		$(".message-body").html("საკვანძო სიტყვა უნდა აღემატებოდეს 3 სიმბოლოს !");  
		$(".message-box").modal("show"); 
	}else if(whereToSearch==1){
		var u = "http://"+document.domain+"/ყველა-სტატია/?search=" + encodeURIComponent(search);
		location.href = u; 
	}else if(whereToSearch==2){
		var u = "http://"+document.domain+"/კითხვა-პასუხი/?search=" + encodeURIComponent(search);
		location.href = u; 
	}else{
		$(".message-body").html("მოხდა შეცდომა გთხოვთ გადაამოწმოთ ველების სიზუსტე !");  
		$(".message-box").modal("show"); 
	}
});

function replaceTMContent(e, ed, tmContent){
	var cText = $(e.target).text();
	var cId = ed.id;
}

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

function urlParamiters()
{
	var query_string = new Array();
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		if (typeof query_string[pair[0]] === "undefined") {
		  query_string[pair[0]] = pair[1];
		} else if (typeof query_string[pair[0]] === "string") {
		  var arr = [ query_string[pair[0]], pair[1] ];
		  query_string[pair[0]] = arr;
		} else {
		  query_string[pair[0]].push(pair[1]);
		}
	} 
	return query_string;		
}