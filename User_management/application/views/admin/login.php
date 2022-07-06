<?php echo $title;?>
<?php echo validation_errors();?>
<?php echo $msg;?>
<div >  
  <div class="global-container">  
    <div class="card login-form">  
      <div class="card-body">  
        <h3 class="card-title text-center"> Login </h3>  
        <div class="card-text">  
          <?php echo form_open('user/login'); ?>  
          <div class="form-group">  
            <label for="useremail"> Username </label>                                                  
            <input type="email" class="form-control form-control-sm" name="useremail" id="useremail" aria-describedby="emailHelp" placeholder="Email">  
          </div>  
          <div class="form-group">  
            <label for="userpw">Password </label>  
            <input type="password" class="form-control form-control-sm" name="userpw" id="userpw" placeholder="Password">  
          </div>  
          <button type="submit" class="btn btn-primary btn-block"> Sign in </button>  
          </form>  
        </div>  
      </div>  
    </div>  
  </div> 
</div> 