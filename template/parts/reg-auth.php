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
        <label>ელ-ფოსტა: </label>
          <div class="input-group">
        <input type="text" class="form-control" value="" id="auth-email" autocomplete="off" />
      </div>
      <label>პაროლი: </label>
          <div class="input-group">
        <input type="password" class="form-control" value="" id="auth-pass" autocomplete="off" />
      </div><div style="clear:both"></div>
      <a href="javascript:;" id="pass-recovery">პაროლის აღდგენა »</a> 
      <a href="javascript:;" class="btn btn-primary" role="button" id="auth-button">ავტორიზაცია</a>
      <div style="clear:both"></div>
        </form>
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
        <form action="javascript:;" method="post">
          <font color="#ff0000" id="register-error-message" style="display:none"></font>
          <label>ელ-ფოსტა: </label>
          <div class="input-group">
            <input type="text" class="form-control" id="register-email" value="" autocomplete="off" />
          </div> 
          <label>პაროლი: </label>
          <div class="input-group">
             <input type="password" class="form-control" id="register-password" value="" autocomplete="off" />
          </div>
          <label>გაიმეორეთ პაროლი: </label>
          <div class="input-group">
            <input type="password" class="form-control" id="register-repassword" value="" autocomplete="off" />
          </div>
          <label>სახელი გვარი: </label>
          <div class="input-group">
            <input type="text" class="form-control" id="register-namelname" value="" autocomplete="off" />
          </div>
          <a href="javascript:void(0);" class="btn btn-primary register-button" role="button">რეგისტრაცია</a>
        </form>
      </div>


    </div>
  </div>
</div>
<!-- popup END -->