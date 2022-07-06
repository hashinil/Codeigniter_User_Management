<div class="container">
        <div class="row">
        <div class="col align-self-start">
                    <div class="btn-group-vertical">
                        <a class="btn btn-primary" href="<?php echo site_url('user/welcome');?>" role="button">Home&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                        <?php if($user_group == 'admin'){?>
                                <div class="dropdown show">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Users&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                <div class="dropdown-menu" aria-labelledby="userMenuLink">
                                    <a class="dropdown-item" href="<?php echo site_url('user/user_list');?>">Users</a>
                                    <a class="dropdown-item" href="<?php echo site_url('user/create');?>">Add User</a>
                                </div>
                        </div>
                        <div class="dropdown show">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="groupMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Groups</a>
                                <div class="dropdown-menu" aria-labelledby="groupMenuLink">
                                    <a class="dropdown-item" href="<?php echo site_url('user/usergroup_list');?>">User Groups</a>
                                    <a class="dropdown-item" href="<?php echo site_url('user/create_user_group');?>">Add User Group</a>
                                </div>
                        </div>
                        <?php } ?>
                        <a class="btn btn-primary" href="<?php echo site_url('user/logout');?>" role="button">Logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                    </div>
                </div>
                
                <div class="col-6 align-self-center">
                        <div class="card"> 
                                <div class="card-body">
                                        <h2><?php echo $title; ?></h2>
                                        <?php echo validation_errors();?>
                                        <?php echo $msg;?>

                                        <?php echo form_open('user/create_user_group'); ?>
                                            <div class="form-group row">
                                                <label for="usergroupname" class="col-sm-4 col-form-label">Username </label>
                                                <div class="col-sm-8">
                                                <input type="text" class="form-control" name="usergroupname" id="usergroupname" placeholder="User Group">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-8">
                                                <input type="submit" class="btn btn-primary" name="submit" value="Add User Group" />
                                                </div>
                                            </div>
                                        </form>
                                </div>
                        </div>
                </div>
                <div class="col">
                        
                </div>
        </div>
</div>