<!-- popup START -->
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">ავტორიზაცია</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:;" method="post">
        <font color="#ff0000" id="register-error-message2" style="display:none"></font>
        <label>ელ-ფოსტა: <font color="#ff0000">*</font></label>
          <div class="input-group">
        <input type="text" class="form-control" value="" id="auth-email" autocomplete="off" />
      </div>
      <label>პაროლი: <font color="#ff0000">*</font></label>
          <div class="input-group">
        <input type="password" class="form-control" value="" id="auth-pass" autocomplete="off" />
      </div><div style="clear:both"></div>
      <a href="<?=$c["website.base"]?>პაროლის-აღდგენა" id="pass-recovery">პაროლის აღდგენა »</a> 
      <a href="javascript:;" class="btn btn-primary" role="button" id="auth-button">ავტორიზაცია</a>
      <div style="clear:both"></div>
        </form>
      </div>
      <div class="modal-footer">  
      <?php
      $lib_functions_facebook = new lib_functions_facebook(); 
      ?>   
        <a href="<?=$lib_functions_facebook->generateGoToUrl($c)?>" class="btn btn-primary" role="button" style="margin:0; width:100%;"><i class="fa fa-facebook-official" aria-hidden="true"></i> &nbsp;&nbsp; ავტორიზაცია</a>
      </div>

    </div>
  </div>
</div>
<!-- popup END -->

<!-- popup START -->
<div class="modal fade bs-example-modal-sm2" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">რეგისტრაცია</h4>
      </div>
      <div class="modal-body">
        <form action="javascript:;" method="post" id="registration" class="registration">
          <font color="#ff0000" id="register-error-message" style="display:none"></font>
          <label>ელ-ფოსტა: <font color="#ff0000">*</font></label>
          <div class="input-group">
            <input type="text" class="form-control" id="register-email" value="" autocomplete="off" />
          </div> 
          <label>პაროლი: <font color="#ff0000">*</font></label>
          <div class="input-group">
             <input type="password" class="form-control" id="register-password" value="" autocomplete="off" />
          </div>
          <label>გაიმეორეთ პაროლი: <font color="#ff0000">*</font></label>
          <div class="input-group">
            <input type="password" class="form-control" id="register-repassword" value="" autocomplete="off" />
          </div>
          <label>სახელი გვარი: <font color="#ff0000">*</font></label>
          <div class="input-group">
            <input type="text" class="form-control register-namelname" id="register-namelname" value="" autocomplete="off" />
          </div>
          <a href="javascript:void(0);" class="btn btn-primary register-button" role="button">რეგისტრაცია</a>
        </form>
      </div>


    </div>
  </div>
</div>
<!-- popup END -->
<script type="text/javascript" charset="utf-8">
GeoKBD.map('registration','register-namelname');
</script>