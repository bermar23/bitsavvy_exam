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
    <p><input id="add_button" value="+" type="button" /></p>

    <table id="address-table" class="address-table">
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
                <tr id="row_<?php echo $row['id'] ?>">
                    <td class="name"><?php echo $row['name'] ?></td>
                    <td class="address"><?php echo $row['address']; ?></td>
                    <td class="city"><?php echo $row['city'] ?></td>
                    <td class="state"><?php echo $row['state'] ?></td>
                    <td class="zipcode"><?php echo $row['zipcode'] ?></td>
                    <td class="phone"><?php echo $row['phone'] ?></td>
                    <td><a href="#" class="edit_action" data-address_id="<?php echo $row['id'] ?>">Edit</a> | <a href="#" class="delete_action" data-address_id="<?php echo $row['id'] ?>">Delete</a></td>
                </tr>            
            <?php }?> 
        </tbody>
        <tfoot></tfoot>
    </table>
    <div class="fun-button-wrapper"><input id="fun_button" value="FUN STUFF" type="button"/></div>
    
</div>

<div id="overlay" style="display:none;"></div>

<div id="modal" style="display:none;">
    <form id="address_form" method="post" action="processAddress.php">
        <p>
        <strong>Add/Edit Address</strong>
        </p>
        <div class="controls">
            <label>Name</label>
            <input type="text" name="name" id="form_name" placeholder="enter text..."/>
            <input type="hidden" name="mode" id="form_mode"/>
            <input type="hidden" name="address_id" id="form_address_id"/>
            <input type="hidden" name="_token" value="1234567890bermar"/>
        </div>
        <div class="controls">
            <label>Address</label>
            <input type="text" name="address" id="form_address" placeholder="enter text..."/>
        </div>
        <div class="controls">
            <label>City</label>
            <input type="text" name="city" id="form_city" placeholder="enter text..."/>
        </div>
        <div class="controls">
            <label>State</label>
            <input type="text" name="state" id="form_state" placeholder="enter text..."/>
        </div>
        <div class="controls">
            <label>Zip</label>
            <input type="text" name="zipcode" id="form_zipcode" placeholder="enter text..."/>
        </div>
        <div class="controls">
            <label>Phone</label>
            <input type="text" name="phone" id="form_phone" placeholder="enter text..."/>
        </div>
        <div class="controls">
            <input id="save_button" type="button" value="Save"/>
            <input id="cancel_button" type="button" value="Cancel"/>
        </div>
    </form>

</div>

<br>
<br>
<script type="text/javascript">
	$(document).ready(function(){

        var $address_table = $("#address-table");


        function clearFields(){
            $('#form_address_id').val('');
            $('#form_name').val('');
            $('#form_address').val('');
            $('#form_city').val('');
            $('#form_state').val('');
            $('#form_zipcode').val('');
            $('#form_phone').val('');
        }

        $("#add_button").click(function(){   
            clearFields();         
            $('#overlay').show();          
            $('#modal').show();        
            $('#form_mode').val('add');
            
        });

        $("#cancel_button").click(function(){              
            $('#overlay').hide();          
            $('#modal').hide();
            return;
        });

        $("#fun_button").click(function(){
            $("#address-table tbody tr:nth-child(3) td:nth-child(3)").html('FUN STUFF');
        });

        $("#save_button").click(function(){ 
            var mode = $('#form_mode').val();  
            $.ajax({
				type: "POST",
                data : $("#address_form").serialize(),
				url: "./processAddress.php",
                dataType: "json",
				success: function(data){  
                    if(mode=='edit'){                                     
                        alert('Successfully updated address!');
                        $('#row_'+data.id).html('');
                        var new_row = '<td class="name">'+data.name+'</td>'+
                                        '<td class="address">'+data.address+'</td>'+
                                        '<td class="city">'+data.city+'</td>'+
                                        '<td class="state">'+data.state+'</td>'+
                                        '<td class="zipcode">'+data.zipcode+'</td>'+
                                        '<td class="phone">'+data.phone+'</td>'+
                                        '<td><a href="#" class="edit_action" data-address_id="'+data.id+'">Edit</a> | <a href="#" class="delete_action" data-address_id="'+data.id+'">Delete</a></td>';
                        $('#row_'+data.id).html(new_row);
                    }else if(mode=='add'){             
                        alert('New address added!');
                        var new_row = '<tr id="row_'+data.id+'">'+
                                        '<td class="name">'+data.name+'</td>'+
                                        '<td class="address">'+data.address+'</td>'+
                                        '<td class="city">'+data.city+'</td>'+
                                        '<td class="state">'+data.state+'</td>'+
                                        '<td class="zipcode">'+data.zipcode+'</td>'+
                                        '<td class="phone">'+data.phone+'</td>'+
                                        '<td><a href="#" class="edit_action" data-address_id="'+data.id+'">Edit</a> | <a href="#" class="delete_action" data-address_id="'+data.id+'">Delete</a></td>'+
                                        '</tr>';
                        $("#address-table tbody").append(new_row);
                    }

                    $('#overlay').hide();          
                    $('#modal').hide();
				},
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error!');
                }
			});            
        });      

        $address_table.on('click', 'a.edit_action', function(e){
			e.preventDefault();
            clearFields();
            $('#overlay').show();          
            $('#modal').show();        
            $('#form_mode').val('edit');

            var address_id = $(this).data('address_id');
            
            var row = $(this).parents('tr');
            var name = $(row).find('td.name').html();
            var address = $(row).find('td.address').html();
            var city = $(row).find('td.city').html();
            var state = $(row).find('td.state').html();
            var zipcode = $(row).find('td.zipcode').html();
            var phone = $(row).find('td.phone').html();

            $('#form_address_id').val(address_id);
            $('#form_name').val(name);
            $('#form_address').val(address);
            $('#form_city').val(city);
            $('#form_state').val(state);
            $('#form_zipcode').val(zipcode);
            $('#form_phone').val(phone);
		});         

        $address_table.on('click', 'a.delete_action', function(e){

            e.preventDefault();

            var address_id = $(this).data('address_id');

            $.ajax({
				type: "POST",
                data : {'address_id':address_id},
				url: "./deleteAddress.php",
                dataType: "json",
				success: function(data){  
                    alert('Deleted successfully!');
                    $('#row_'+address_id).remove();
				},
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error!');
                }
			});
            
        }); 


	});
</script>

<?php
include './templates/footer.php';
?>
