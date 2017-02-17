<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">  
</head>
<body>
<?php
function passwordGenerator($length,$count, $characters) {
 

    $symbols = array();
    $passwords = array();
    $selected_symbols = '';
    $pass = '';
 
// an array of different character types  
    $symbols["upper"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  
    $symbols["lower"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["numerals"] = '1234567890';
    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
 
    foreach ($characters as $key=>$value) {
        $selected_symbols .= $symbols[$value]; 
    }
    $symbols_length = strlen($selected_symbols) - 1; 
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); 
            $pass .= $selected_symbols[$n]; 
        }
        $passwords[] = $pass;
    }
     
    return $passwords; // 
}


 if(isset($_POST['submit'])){
 	$sendArr=[];
  $checkedLower="";
  $checkedUpper="";
  $checkedSymbol="";
  $checkedNumber="";
  
    // if you want a form like above
	    if (isset($_POST['lower'])){
	        $sendArr[]='lower';
          $checkedLower=true;
	    }
      if (isset($_POST['upper'])){
	        $sendArr[]='upper';
          $checkedUpper=true;
      }
	    if (isset($_POST['numerals']) ){
	        $sendArr[]='numerals';
          $checkedNumber=true;

	    }
	    if (isset($_POST['special_symbols'])){
          $sendArr[]='special_symbols';
          $checkedSymbol=true;
          
      }
      if (isset($_POST['length'])){
          $selLength=$_POST['length'];
          
      }
      if(empty($sendArr)){
	    	$sendArr=["lower","upper","numerals","special_symbols"];
	    }
      if ( (isset($_POST['length']) && $_POST['length']!="" ) && (isset($_POST['lower']) || isset($_POST['upper']) || isset($_POST['numerals']) || isset($_POST['special_symbols'])) ){
     
    	    $length = $selLength=$_POST['length'];
          $my_passwords = passwordGenerator($length,1,$sendArr);
          $password=$my_passwords[0];
    	}else{
       $error=true;
 	    }
 }
 
?>	
<div class="container">
  <div class="col-sm-12">
	<h2 style="padding:3rem">Password Generator</h2>
  <?php if(isset($error)){ ?>
  <div class="alert alert-danger">
    <strong>Error !</strong> Please Give Length of Password and select Password type.
  </div>
  
  <?php } ?>
  <div class="col-sm-12">
     <div class="well">
        <?php if(!empty($my_passwords)){ 
          foreach ($my_passwords as $key => $value) { ?>
            <div class="row">
              <div class="col-sm-9">
                <div class="form-group col-sm-10">
                  <label for="pwd">Your Password:</label>
                  <input  class="form-control  demo-<?php echo $key?>"   value="<?php echo $value; ?>"  placeholder="password">
                </div>
				<div class="col-sm-2" style="padding:2%">
                  <label for="pwd"> </label>
              </div>
              </div>

           </div>
         <?php }
         }else{
          echo "No Passwords Available!";
         }

        ?>
   </div>
 </div>
  
  
  <div class="col-sm-12">
     <div class="well">
      <form method="post">
        <div class="checkbox">
        <label><input type="checkbox" <?php echo !empty($checkedLower) ? 'checked' : "" ?> name="lower" value="1" checked="True"> Lower Case (a-z)</label>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" <?php echo !empty($checkedUpper) ? 'checked' : "" ?> name="upper" value="1" checked="True"> Upper Case (A-Z)</label>
      </div>

      <div class="checkbox">
        <label><input type="checkbox" <?php echo !empty($checkedNumber) ? 'checked' : "" ?> name="numerals" value="1" checked="True"> numerals (0-9)</label>
      </div>
      <div class="checkbox">
        <label><input type="checkbox" <?php echo !empty($checkedSymbol) ? 'checked' : "" ?> name="special_symbols" value="1" checked="True"> Special Characters (!?~@#-_+<>[]{})</label>
      </div>
<br/>
        <div class="form-group">
          <label for="">Length:</label>
          <input type="number"  name="length" class="form-control" value="<?php echo isset($selLength)?$selLength : ""?>" placeholder="Password Length" required="">
        </div>
        <button type="submit" name="submit" class="btn btn-sm btn-primary">Generate</button>
      </form>
      </div>
  </div>

</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
</body>
</html>