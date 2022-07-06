<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

// Delete 
$('.delete').click(function(){
  var el = this;
 
  // Delete id
  var deleteid = $(this).data('id');

  var confirmalert = confirm("Are you sure?");
  if (confirmalert == true) {
     // AJAX Request
     $.ajax({
       type: 'POST',
               url: 'delete_user',
               dataType: 'json',
               data: {user_id: deleteid},
       success: function(response){

         if(response == 1){
           // Remove row from HTML Table
           $(el).closest('tr').css('background','tomato');
           $(el).closest('tr').fadeOut(800,function(){
              $(this).remove();
           });
         }else{
           alert('Invalid ID.');
         }

       }
     });
  }

});

});
  
</script>
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
                
                <div class="col-8 align-self-center">
                        <div class="card"> 
                                <div class="card-body">
                                        <h2><?php echo $title; ?></h2>
                                        <table class="table table-striped">
                                                <thead>
                                                        <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">UserName</th>
                                                        <th scope="col">User Group</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                        </tr>
                                                </thead>
                                                
                                                <tbody>
                                                <?php foreach ($user_list as $user): ?>
                                                        <tr>
                                                                <td><?php echo $user['user_id']; ?></td>
                                                                <td><?php echo $user['user_name']; ?></td>
                                                                <td><?php echo $user['ug_name']; ?></td>
                                                                <td><?php echo ($user['user_status']==1)? 'Active':'Inactive'; ?></td>
                                                                <td><span class='buttoncustom delete' data-id='<?= $user['user_id']; ?>'>Delete</span> 
                                                                <a class="buttoncustom" href="edit_user/<?= $user['user_id']; ?>">Edit</a></td>
                                                        </tr>
                                                <?php endforeach; ?>
                                                </tbody>
                                        </table>
                                </div>
                        </div>
                </div>
                <div class="col">
                        
                </div>
        </div>
</div>