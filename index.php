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

<script>

function closeModal(){
    document.getElementById("modal").style.visibility = "hidden";
    document.getElementById("overlay").style.visibility = "hidden";
}

function openModal(){
    document.getElementById("modal").style.visibility = "visible";
    document.getElementById("overlay").style.visibility = "visible";
}

function addAddress(){
    openModal();
}

function funClick(){
    alert('Fun click');
}

function editAddress(id){
    alert(id);
    return;
    openModal();
}

</script>
<div class="address-body">
    <h1>Address Book</h1>
    <p><input id="add_button" value="+" type="button" onclick="addAddress();"/></p>

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
                    <td class="name"><?php echo $row['name'] ?></td>
                    <td class="address"><?php echo $row['address']; ?></td>
                    <td class="city"><?php echo $row['city'] ?></td>
                    <td class="state"><?php echo $row['state'] ?></td>
                    <td class="zipcode"><?php echo $row['zipcode'] ?></td>
                    <td class="phone"><?php echo $row['phone'] ?></td>
                    <td><a href="#" class="edit_action" onclick="editAddress(<?php echo $row['id'] ?>);">Edit</a> | <a href="#" class="delete_action">Delete</a></td>
                </tr>            
            <?php }?> 
        </tbody>
        <tfoot></tfoot>
    </table>
    <div class="fun-button-wrapper"><input id="fun_button" value="FUN STUFF" type="button" onclick="funClick();"/></div>
    
</div>

<div id="overlay"></div>

<div id="modal">
    <form id="address_form" method="post" action="processAddress.php">
        <p>
        <strong>Add/Edit Address</strong>
        </p>
        <div class="controls">
            <label>Name</label>
            <input type="text" name="name"/>
            <input type="hidden" name="address_id"/>
        </div>
        <div class="controls">
            <label>Address</label>
            <input type="text" name="address"/>
        </div>
        <div class="controls">
            <label>City</label>
            <input type="text" name="city"/>
        </div>
        <div class="controls">
            <label>State</label>
            <input type="text" name="state"/>
        </div>
        <div class="controls">
            <label>Zip</label>
            <input type="text" name="zipcode"/>
        </div>
        <div class="controls">
            <label>Phone</label>
            <input type="text" name="phone"/>
        </div>
        <div class="controls">
            <input type="submit" value="Save"/>
            <input type="button" value="Cancel" onclick="closeModal();"/>
        </div>
    </form>

</div>

<script>


closeModal();
</script>

<?php
include './templates/footer.php';
?>
