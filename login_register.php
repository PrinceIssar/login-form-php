<?php

require ('connection.php');
// session helps us to use a variable to use in multiple pages
session_start();
// FOR LOG IN
if (isset($_POST['login']))
{
    $query= "SELECT * FROM `testing`.registered_users WHERE `email`='$_POST[email_username]' OR `username`='$_POST[email_username]'";
    $result = mysqli_query($con,$query);

    if ($result)
    {
       if(mysqli_num_rows($result) ==1)
       {
         $result_fetch= mysqli_fetch_assoc($result);
         //now matching the database password, now it'll verify the real password in the encrypt password, only this function
           if (password_verify($_POST['password'],$result_fetch['password']))
           {
            // if password matched
               $_SESSION['logged_in']=true;
               $_SESSION['username']= $result_fetch['username'];
               //thx to this function we can go back to to our index file
               header("location: index.php");

           }
           else
           {
               //if incorrect password
               echo  "<script>
                    alert('Incorrect Password');
                    window.location.href='index.php';
                   </script>";
           }
       }
       else
       {
           echo  "<script>
                    alert('Email or username not Registered');
                    window.location.href='index.php';
                   </script>";
       }
    }
    else
    {
        echo  "<script>
                    alert('Cannot run query');
                    window.location.href='index.php';
                   </script>";
    }
}





//so if someone click register it'll check if the user exist
//FOR REGISTRATION
if (isset($_POST['register'])){
 $user_exist_query = "SELECT * FROM `testing`.registered_users WHERE `username`='$_POST[username]'OR `email`='$_POST[email]'";
  $result = mysqli_query($con,$user_exist_query);

  if ($result)
  {
      // this will check the no. of row fetch of $result
      //it'll be executed if username email is already exist
    if (mysqli_num_rows($result) > 0){ // if it's greater then 0 ,when on row is matched, if the have username/email matched then it'll run this function
        // if any user has already taken username or email
        $result_fetch = mysqli_fetch_assoc($result); // fetch the data of the person
        if ($result_fetch['username']==$_POST['username'])//if username matches then show this alert
        {
            // error for username already registered
            echo  "<script>
                    alert('$result_fetch[username] - Username already taken');
                    window.location.href='index.php';
                   </script>";
        }
        else{
            //error for email already registered
            echo  "<script>
                    alert('$result_fetch[email] - E-mail already registered');
                    window.location.href='index.php';
                   </script>";
        }
}

  else // it will be executed if no one has taken username or email before
  {
      // this will take a string into a hash and it'll run a algo crypt blowfish algo(it's of 60 digit)
      $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
      $query =" INSERT INTO `testing`.registered_users(full_name, username, email, password) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')"; //we have passed in variable password
      if (mysqli_query($con,$query))
      {
//        if data inserted successfully
          echo  "<script>alert('Registration successfully');
           window.location.href='index.php';
          </script>";
      }
      else
      {
          //if data cannot be inserted
          echo  "<script>alert('Cannot run query');
           window.location.href='index.php';
          </script>";
      }
  }
  }
  {
      // if query doesn't work this function will give us the ability to go back to index.php
    echo  "<script>alert('Cannot run query');
           window.location.href='index.php';
          </script>";

  }
}