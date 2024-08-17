<?php

session_start();
include_once "config.php";
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    // Let's check user email is valid or not
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { /* If email is valid */
        // Let's check that email is arleady exist in the data base or not
        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) { // if email already exist
            echo "$email already exist!";
        } else { // let check user upload file or not
            if (isset($_FILES['image'])) { // if file is uploaded
                $img_name = $_FILES['image']['name']; //getting user uploaded img name
                $tmp_name = $_FILES['image']['tmp_name']; //this temporary name is used to save/move file in our folder

                //let's explode image and get the last extention like jpj png
                $img_explode = explode('.', $img_name);
                $img_ext = end($img_explode); //here we get the extention of an user uploaded img file

                $extensions = ['png', 'jpeg', 'jpg']; //these are some valid img ext and we've store them in array
                if (in_array($img_ext, $extensions) === true) { // if user uploaded img ext is matched with any array extentions  
                    $time = time(); //this will return us current time...
                    //we need the time becausewhen you uploading user img to in our folder we rename user file with current time
                    //so all the image fill will have a unique name
                    // let more the user uploaded img to our particular folder
                    $new_img_name = $time.$img_name;

                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) { //if user upload img move to our folder succefully

                        $status = "Connecté"; //once user signed up then his status will be active now)
                        $random_id = rand(time(), 10000000); //creating random id from user

                        //let insert all user data inside table
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        if ($sql2) { // if this data inserted
                            $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                               $row = mysqli_fetch_assoc($sql3);
                               $_SESSION['unique_id'] = $row['unique_id']; //using this session we used  user unique_id in other php file
                               echo "success";
                               
                            }
                        }else {
                            echo "Quelque chose s'est mal passé !";
                        }
                    }
                } else {
                    echo "Veuillez sélectionner un fichier d'images - jpeg, jpg, png !";
                }
            } else {
                echo "Veuillez sélectionner un fichier d'images !";
            }
        }
    } else {
        echo "$email n'est pas un e-mail valide !";
    }
} else {
    echo "Tous les champs d'entrée sont nécessaires !";
}
