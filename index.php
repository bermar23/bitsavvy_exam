<?php

require './autoload.php';

if(!$_SESSION['login_user']){
    header('Location: login.php');
}

$sort_field = 'name';
$sort_by = 'asc';
$q = '';

if(isset($_GET['q'])){
    $q = $_GET['q'];
}

if(isset($_GET['sort_field'])){
    $sort_field = $_GET['sort_field'];
}

if(isset($_GET['sort_by'])){
    $sort_by = $_GET['sort_by'];
}

$data = \Models\Address::getData($q, $sort_field, $sort_by);

include './templates/header.php';
?>
<div class="address-body">
    <h1>Address Book</h1>
    <p><input id="add_button" value="+" type="button"/></p>

    <table class="address-table">
        <thead>
            <tr>
                <th><a href="#">Name</a></th>
                <th><a href="#">Address</a></th>
                <th><a href="#">City</a></th>
                <th><a href="#">State</a></th>
                <th><a href="#">Zip</a></th>
                <th><a href="#">Phone</a></th>
                <th><a href="#">Actions</a></th>
            </tr>
        </thead>
        <tbody>            
            <?php foreach($data as $row){?>  
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['city'] ?></td>
                    <td><?php echo $row['state'] ?></td>
                    <td><?php echo $row['zipcode'] ?></td>
                    <td><?php echo $row['phone'] ?></td>
                    <td><a href="#" class="edit_action">Edit</a> | <a href="#" class="delete_action">Delete</a></td>
                </tr>            
            <?php }?> 
        </tbody>
        <tfoot></tfoot>
    </table>
    
</div>
<script>

</script>

<?php
include './templates/footer.php';
?>
