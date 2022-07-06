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

                                        <?php echo validation_errors(); ?>

                                        <?php echo form_open('user/edit_user/'.$user_data['user_id']); ?>
                                            <div class="form-group row">
                                                <label for="username" class="col-sm-4 col-form-label">Username </label>
                                                <div class="col-sm-8">
                                                <input type="email" class="form-control" name="username" id="username" placeholder="Email" value="<?php echo $user_data['user_name'] ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="usergroup" class="col-sm-4 col-form-label">User Group</label>
                                                <div class="col-sm-8">
                                                <?php foreach ($usergroups as $ug): 
                                                $group = $ug['ug_name'];
                                                $ug_id = $ug['ug_id'];
                                                $ug_status = $ug['ug_status'];
                                                ?>
                                                    <div class="form-check">
                                                        <?php if($ug_status == 1) {
                                                            if($user_data['user_group_id'] == $ug_id){?>
                                                                <input class="form-check-input" type="radio" name="ugRadios" id="ugRadios" value="<?php echo $ug_id; ?>" checked="checked">
                                                                <label class="form-check-label" for="ugRadios"><?php echo $group; ?></label>
                                                            <?php } else {?>
                                                                <input class="form-check-input" type="radio" name="ugRadios" id="ugRadios" value="<?php echo $ug_id; ?>" >
                                                                <label class="form-check-label" for="ugRadios"><?php echo $group; ?></label>
                                                            <?php } ?>
                                                        <?php } else {?>
                                                            <input class="form-check-input" type="radio" name="ugRadios" id="ugRadios" value="<?php echo $ug_id; ?>" disabled>
                                                            <label class="form-check-label" for="ugRadios"><?php echo $group; ?></label>
                                                        <?php } ?>
                                                    </div>
                                                <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-8">
                                                <input type="submit" class="btn btn-primary" name="submit" value="Update User" />
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