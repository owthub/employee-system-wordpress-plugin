<?php
   global $wpdb;
   $message = "";

   // Delete Block
   if($_SERVER['REQUEST_METHOD'] == "POST"){

     if(isset($_POST['emp_del_id']) && !empty($_POST['emp_del_id'])){

        $wpdb->delete("{$wpdb->prefix}ems_form_data", array(
            "id" => intval($_POST['emp_del_id'])
        ));

        $message = "Employee deleted successfully";
     }
   }

   $employees = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}ems_form_data", ARRAY_A);
?>

<div class="container">
    <div class="row">
        <div class="col-sm-10">
            <h2>List Employee</h2>

            <div class="panel panel-primary">
                <div class="panel-heading">List Employee</div>
                <div class="panel-body">

                    <?php
                    if(!empty($message)){
                        ?>
                    <div class="alert alert-success">
                        <?php echo $message; ?>
                    </div>
                    <?php
                    }
                    ?>

                    <table class="table" id="tbl-employee">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>#Name</th>
                                <th>#Email</th>
                                <th>#Gender</th>
                                <th>#Designation</th>
                                <th>#Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if(count($employees) > 0){

                                foreach($employees as $employee){
                                    ?>
                            <tr>
                                <td><?php echo $employee['id'] ?></td>
                                <td><?php echo $employee['name'] ?></td>
                                <td><?php echo $employee['email'] ?></td>
                                <td><?php echo ucfirst($employee['gender']); ?></td>
                                <td><?php echo $employee['designation'] ?></td>
                                <td>
                                    <a href="admin.php?page=employee-system&action=edit&empId=<?php echo $employee['id'] ?>"
                                        class="btn btn-warning">Edit</a>

                                    <form id="frm-delete-employee-<?php echo $employee['id'] ?>" method="post"
                                        action="<?php echo $_SERVER['PHP_SELF'] ?>?page=list-employee">

                                        <input type="hidden" name="emp_del_id" value="<?php echo $employee['id'] ?>">
                                    </form>

                                    <a href="javascript:void(0)"
                                        onclick="if(confirm('Are you sure want to delete?')){jQuery('#frm-delete-employee-<?php echo $employee['id'] ?>').submit();}"
                                        class="btn btn-danger">Delete</a>

                                    <a href="admin.php?page=employee-system&action=view&empId=<?php echo $employee['id'] ?>"
                                        class="btn btn-info">View</a>
                                </td>
                            </tr>
                            <?php
                                }
                            }else{

                                echo "No Employee found";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>