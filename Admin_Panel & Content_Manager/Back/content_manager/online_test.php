<?php
session_start();
include_once "header.php";
$_SESSION['club_id']='club_21';
if(isset($_GET['id'])){
    $req = 'select status from online_test where test_id= "'.$_GET['id'].'" ';
    $resp = $conn->query($req);
    $exists = $resp->fetch_array();
    if($exists['status']==1)
    {echo '<script>alert("Contetnt Already Approved Cannot Edit.");window.history.back() </script>'; die;}
    else
    {
    $id = $_GET['id'];
    $test_up = "SELECT test_name, test_data, duration, test_creator, school_price,mrp_price, vendor_id,topic_id,class_applicable_for,subscription_level from online_test where test_id= '$id'";
    $result = $conn->query($test_up);
    while($row = $result->fetch_array())
    {
     $title =$row['test_name'];
     $description = $row['test_data'];
     $duration =$row['duration'];
     $author = $row['test_creator'];
     $price =$row['mrp_price'];
     $vendor_id =$row['vendor_id'];
     $topic_id =$row['topic_id'];
     $class = explode(",",$row['class_applicable_for']);
     $sub = $row['subscription_level'];
     $school_price =$row['school_price'];
    }
}}
else{
}
?>
    <div class="content">
        <h1 class="ribbon">Online Test:</h1>
        <form action="" id="form">
        <div class="input-group">
                    <select id="topic" name="topic" class="__select">
                    <option value="" >Choose Topic</option>
                    <?php 
                   $v=$conn->query("select topic_id,topic_name from topic where club_id= '".$_SESSION['club_id']."'");
                    $vs=mysqli_num_rows($v);
                    if($vs > '0'){ 
                        while($v1=mysqli_fetch_array($v)){
                                  if(isset($topic_id) && $topic_id== $v1[0]){?>
                        <option value='<?php echo $v1[0]; ?>' selected><?php echo $v1[1]; ?></option> 
                   <?php   }  else{?>
                       <option value='<?php echo $v1[0]; ?>'><?php echo $v1[1]; ?></option>
                 <?php  }
                    ?>
                             <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Topics</option>   
                    <?php }?>
                    </select>
                </div>
            <div class="index-wrap">
                <div class="input-group">
                    <input type="text" value="<?php if(isset($title)){echo $title;}else{}?>" name="title" id="title" placeholder="Enter Title Here" />
                </div>
                <a href="#" class="more-link">Change Vendor</a>
            </div>
            <h1 class="text-head">Enter Description Below: </h1>
            <textarea name="editor1"><?php if(isset($description)){echo $description;}else{}?></textarea>
            <div class="left-right-div">
                <div class="input-group">
                    <input type="text" value="<?php if(isset($author)){echo $author;}else{}?>" name="author" id="author" placeholder="Enter Author Name" />
                </div>
                <div class="input-group">
                    <input type="text" value="<?php if(isset($duration)){echo $duration;}else{}?>" name="duration" id="duration" placeholder="Enter Duration In HH:MM" />
                </div>
            </div>
            <!--  <h1 class="text-head">Enter Prerequisite Below: </h1>
            <textarea name="editor2"></textarea> -->
            <h1 class="text-head">Class Is Applicable For:</h1>
            <div class="class-div">
            <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='6' <?php if(isset($class)){echo (in_array("6",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left: -15px">Class 6</span>
                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='7' <?php if(isset($class)){echo (in_array("7",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left: -15px">Class 7</span>
                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='8' <?php if(isset($class)){echo (in_array("8",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span>
                            <br> <span style="margin-left: -15px">Class 8</span>

                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='9' <?php if(isset($class)){echo (in_array("9",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left: -15px">Class 9</span>
                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='10' <?php if(isset($class)){echo (in_array("10",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left:-15px">Class 10</span>
                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='11' <?php if(isset($class)){echo (in_array("11",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left: -15px">Class 11</span>
                        </label>
                    </div>
                </div>
                <div class="div-card div-card-1">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="class[]" value='12' <?php if(isset($class)){echo (in_array("12",$class)) ? 'checked="checked"' : '';}else{}?>><span class="checkbox-material"><span class="check"></span></span><br>
                            <span style="margin-left: -15px">Class 12</span>
                        </label>
                    </div>
                </div>
            </div>
            <h1 class="text-head">Select Subscription Level:</h1>
            <div class="row flex-items-xs-middle flex-items-xs-center">
                <div class="col-xs-12 col-lg-4">
                    <div class="card text-xs-center">
                        <div class="card-header">
                            <h3 class="display-2"><span class="currency"><i class="fas fa-rupee-sign"></i></span>500<span
                                    class="period">/month</span></h3>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title">
                                Silver Plan
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item">Feature 1</li>
                                <li class="list-group-item">Feature 2</li>
                            </ul>
                            <div class="radio-btn-wrap">
                                <label>
                                <input type="radio" class="option-input radio" name="sub" value="silver"  id=""  <?php if(isset($sub)){echo ($sub=='silver') ? 'checked="checked"' : '';}else{}?> />
                                    Select Plan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="card text-xs-center">
                        <div class="card-header">
                            <h3 class="display-2"><span class="currency"><i class="fas fa-rupee-sign"></i></span>1000<span
                                    class="period">/month</span></h3>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title">
                                Gold Plan
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item">Feature 1</li>
                                <li class="list-group-item">Feature 2</li>
                            </ul>
                            <div class="radio-btn-wrap">
                                <label>
                                <input type="radio" class="option-input radio" name="sub" value="gold"  id="" <?php if(isset($sub)){echo ($sub=='gold') ? 'checked="checked"' : '';}else{}?> />
                                    Select Plan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-lg-4">
                    <div class="card text-xs-center">
                        <div class="card-header">
                            <h3 class="display-2"><span class="currency"><i class="fas fa-rupee-sign"></i></span>1500<span
                                    class="period">/month</span></h3>
                        </div>
                        <div class="card-block">
                            <h4 class="card-title">
                                Platinum Plan
                            </h4>
                            <ul class="list-group">
                                <li class="list-group-item">Feature 1</li>
                                <li class="list-group-item">Feature 2</li>
                            </ul>
                            <div class="radio-btn-wrap">
                                <label>
                                <input type="radio" class="option-input radio" name="sub" value="platinum"  id="" <?php if(isset($sub)){echo ($sub=='platinum') ? 'checked="checked"' : '';}else{}?> />
                                    Select Plan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h1 class="text-head">Type Of Test: </h1>
            <p class="para-text">Choose a topic that interests you enough to focus on it for at least a week or two. If
                your topic is broad, narrow it. Instead of writing about how to decorate your home, try covering how to
                decorate your home in country style on a shoestring budget. That’s more specific and, as such, easier
                to tackle.</p>

            <h1 class="text-head" style="text-align: center;">Start Your Test From Here: </h1>
            <a href="#" class="new-icon"><i class="fas fa-play "></i></a>
            <div class="left-right-center-div">
                <div class="input-group">
                    <select id="vendor" name="vendor" class="__select">
                        <option value="">Choose Vendor</option>
                    <?php 
                    $v=$conn->query("select vendor_id,vendor_name from vendor where 1");
                    $vs=mysqli_num_rows($v);
                    if($vs > '0'){ 
                        while($v1=mysqli_fetch_array($v)){
                                  if(isset($vendor_id) && $vendor_id== $v1[0]){?>
                        <option value='<?php echo $v1[0]; ?>' selected><?php echo $v1[1]; ?></option> 
                   <?php   }  else{?>
                       <option value='<?php echo $v1[0]; ?>'><?php echo $v1[1]; ?></option>
                 <?php  }
                    ?>
                             <?php }
                    }
                     else { ?>
                         <option  disabled="disabled" selected>No Vendors</option>   
                    <?php }  ?>
                    </select>
                </div>
                <div class="input-group">
                <input type="text" value="<?php if(isset($price)){echo $price;}else{}?>" name="mrp_price" id="price" placeholder="Enter MRP Price" class="field-right" />
                </div>
                <div class="input-group">
                <input type="text" value="<?php if(isset($school_price)){echo $school_price;}else{}?>" name="school_price" id="school_price" placeholder="Enter School Price" class="field-right" />
                </div>
            </div>
            <input type="hidden" name="id" value="<?php if(isset($id)){echo $id;}else{}?>"> 
            <input type="hidden" name="action" <?php if(isset($id)){echo 'value="update"';}else{echo 'value="publish"';}?>>
            <button name="submit" id="submit" value="submit" type="submit" onclick="ajaxbackend()" class="p__btn">Publish</button>        </form>
        </div>
    
	<?php include("footer.php"); ?>
	
    <script language="javascript">
    function ajaxbackend(){
    var checkboxes = document.getElementsByName('class[]');
    var vals = "";
    for (var i=0, n=checkboxes.length;i<n;i++) 
    {
        if (checkboxes[i].checked) 
        {
            vals += ","+checkboxes[i].value;
        }
    }
    if (vals) vals = vals.substring(1);
    for (instance in CKEDITOR.instances) { CKEDITOR.instances[instance].updateElement(); }
    var title= $('#title').val(); 
    var duration= $('#duration').val(); 
    var author= $('#author').val(); 
    var editor1= $('#editor1').val(); 
    var price= $('#price').val(); 
    var school_price= $('#school_price').val(); 
    var topic= $('#topic').val(); 
     
    if(topic == '' ||  title == '' || duration == '' || author == '' || editor1 == '' || price == '' || school_price == '' || vals =='')
                  {
		        alert('Please make sure all fields are filled.');
                event.preventDefault();

		            } else {if($('[name=sub]:checked').length){
                        event.preventDefault();            
                        var form = $('#form')[0];           
                    var data = new FormData(form);    
                    data.append("class", vals);          
                    $("#sub").prop("disabled", true);          
                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "online_test_back.php",
                        data: data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        success: function (data) {     
                            console.log(data);                          
                            if (data=='success')
                        {alert('Published Successfully !');
                        location.reload(true); 
                        }else if(data=='exists')
                        {alert('Already Exists !');}
                        else if(data=='updated')
                        {
                            alert('Updated Successfully !');
                            $("#submit").html('Updated');
                            $("#submit").css({'background-color':'#2abfd4'});
                            location.reload(true);
                        }                                                                        
                        },
                        error: function (e) {           
                            console.log(e);
                        }
                    });
                    }
                    else{alert('Choose Subscription');
                                event.preventDefault();
                }}}
        </script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <script>
        CKEDITOR.replace('editor1');
    </script>
    <script>
        CKEDITOR.replace('editor2');
    </script>
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>