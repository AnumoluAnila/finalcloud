<?php
     include 'dbconn.php';
     
     session_start();
   
   if(isset($_POST['addtocart']))
   {
     $mid=$_POST['name'];
     $email=$_SESSION['mail'];
     $quantity=1;
     $date=date("Y-m-d H:i:s");
     
     $select="select * from cart where mid='$mid'";
     $query=mysqli_query($con,$select);
     $a=mysqli_num_rows($query);
   echo $a;
   if($a==0){
     $insertquery="insert into cart(mid,cemail,qty,date) values('$mid','$email','$quantity','$date')";
   $query1=mysqli_query($con,$insertquery);
   echo '<script>alert("Medicine added to cart successfully")</script>';
   echo "<script>location.href='medicine.php'</script>";
   }
   else{
     echo '<script>alert("Medicine already added in cart")</script>';
     echo "<script>location.href='mycart.php'</script>";
   }
   }
   
   
   
   

     if(isset($_POST['action'])){
         $sql="select * from medicine";
        $mcate=[];
         if(isset($_POST['mcate'])){
             $mcate=$_POST['mcate'];
             
         }
         $output='';
        
       $finoutput="";


         if(count($mcate)>0)
         {
            foreach ($mcate as $cate) {
              
            
                $output ='<div class="card  mt-4 mx-4">
                <div class="card-header"><h5 class="text-center" id="textchange">'.$cate.'</h5></div>
               
                <div class="card-body">
               
                    <div class="row" >';
                        
                           
                             $d=$cate;
                             $selectquery2="select * from medicine where mcate='$d'";
                             $output1="";
                            //  echo $selectquery;
                             $query=mysqli_query($con,$selectquery2) or die( mysqli_error($con));
                             while($result=mysqli_fetch_assoc($query)){
                        
                       $output1.= '<div class="col-md-3">
                       <form method="POST">
                            <div class="card mt-3 " style="width: 15rem; height:22rem">
                            <img src="'. $result['mlink'].'"  height="180px" class="card-img-top px-4 py-4">
                                <div class="card-body">
                                   
                                    <p class="card-title " style=" height:5rem">'.$result['mname'].'</p>
                                    <p class="card-text text-danger">Rs '.$result['price'].'
                                    <button type="submit" name="addtocart" class="btn btn-primary btn-sm float-right">Add to cart</button> 
                                    
                                    <input type="text" name="name" style="display:none" value="'. $result['mid'].'">
                                    </p>
                                </div>
                            </div>
                            </form>
                        </div>';
                             }
                    $output3= '
                    </div>
                    </div>
                  </div> ';
                  $finoutput.=$output.$output1.$output3;

            }
         }
         else{
            $finoutput="<h3>NO Products Found!</h3>" ;
         }
         echo  $finoutput;
     }
?>