<?php

require './autoload.php';

if(!$_SESSION['login_user']){
    header('Location: login.php');
}

$sort_field = 'name';
$sort_by = 'asc';
$limit = '';
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

if(isset($_GET['limit'])){
    $limit = $_GET['limit'];
}

$address = \Models\Address::getData($q, $sort_field, $sort_by, $limit);

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
            <?foreach($address as $row){?>                
            <tr>
                <td><? echo $row['name']; ?></td>
                <td><? echo $row['address']; ?></td>
                <td><? echo $row['city']; ?></td>
                <td><? echo $row['state']; ?></td>
                <td><? echo $row['zipcode']; ?></td>
                <td><? echo $row['phone']; ?></td>
                <td><a href="#" class="edit_action">Edit</a> | <a href="#" class="delete_action">Delete</a></td>
            </tr>            
            <?}?>
        </tbody>
        <tfoot></tfoot>
    </table>
    
</div>
<script>

</script>

<?php
include './templates/footer.php';
?>
