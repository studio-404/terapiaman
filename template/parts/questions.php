<!-- popup START -->
<div class="modal fade bs-example-modal-sm4" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">კითხვის დასმა</h4>
      </div>
      <div class="modal-body">
		
       	<form action="javascript:;" method="post" id="addQuestionForm" class="addQuestionForm">
          <label>კითხვა: </label>
          <div class="input-group">
          <textarea class="form-control mycomment" id="mycomment" data-maxlength="<?=$c["post.max.length"]?>"></textarea><b /r>
          <span><span id="count">0</span> / <?=$c["post.max.length"]?></span>
          </div>
          <div class="input-group" style="margin-top:10px;">
          <label class="anonim-box">
            <input type="hidden" name="anonim" id="anonim" class="anonim" value="1" />
            <i class="fa fa-toggle-off" aria-hidden="true"></i> 
            <span>კითხვის დასმა ანონიმურად</span>
          </label>
          </div>
          <a href="javascript:;" class="btn btn-primary addquestions" role="button">დამატება</a>
       	</form>
        <script type="text/javascript" charset="utf-8">
        GeoKBD.map('addQuestionForm','mycomment');
        </script>
      </div>


    </div>
  </div>
</div>
<!-- popup END -->

<!-- popup START -->
<div class="modal fade bs-example-modal-sm3" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">კომენტარის დამატება</h4>
      </div>
      <div class="modal-body">
      	<font color="red">კომენტარის დამატება შეუძლიათ მხოლოდ რეგისტრირებულ მომხმარებლებს !</font><br />
       	<form action="javascript:;" method="post">
    		<label>კომენტარი: </label>
       		<div class="input-group">
			  <textarea class="form-control mycomment"></textarea>
			</div>
			
			<a href="javascript:;" class="btn btn-primary" role="button">დამატება</a>
       	</form>
      </div>


    </div>
  </div>
</div>
<!-- popup END -->