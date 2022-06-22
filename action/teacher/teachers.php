

<!DOCTYPE html>
<html lang="en">

<head>
<?php  include "../../inc/header.php"; ?>
    <title>teachers</title>


<body>

    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class=""></span> <span>Hospital</span></h2>
        </div>
       
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="students.php" ><span class="las la-users">
                    </br><p style="font-size:12px;">students</p></span>
                    </span>
                    <span>students</span></a>
                </li>
              
                <li>
                    <a href="teachers.php" class="active"><span class="las la-user"></span>
                    </br><p style="font-size:12px;">teachers</p></span>
                    <span>teachers</span></a>
                </li>
               
                <li>
                    <a href="exams.html"><span class="las la-book-medical">
                    </br><p style="font-size:15px;">exams</p></span>
                    <span>exams</span></a>
                </li>
                <li>
                    <a href="branches.html"><span class="las la-clinic-medical">
                    </br><p style="font-size:12px;">branches</p></span>
                    </span>
                    <span>branches</span></a>
                </li>
                
            </ul>
        </div>
    </div>

    <div class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    
                </label> I-<font style="color:#2ecc71">Exam</font>
            </h2>

            <!-- <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="SEARCH" />
            </div> -->
            <div class="user-wrapper">
               <a href="profile.php"><img src="img/setting.png" width="40px" height="40px" alt=""></a>
                <div>
                    <h4>Admin</h4>
                    <small>abdelkader ali</small>
                </div>
            </div>


            <div class="msg_icon" onclick="toggleNotifi()">
                <img src="img/bell.png" alt="">
                         <span> 0<!-- number of notifications --></span>
                    
            </div>
               <div class="notifi-box" id="box">
                <h2>Notifications 
                    <span> 0<!-- number of notifications --></span>
                </h2>
                
                  <div class="notifi-item"  id="msg">
                    <img src="" alt="profile image" class="img">
                      <div class="text">
                               
                               <h4>  
                                 <!-- username sender -->
                               </h4>
                               <p>
                                     <!-- notif text -->
                                  <a href=""   onclick="return confirm('Are You sure you want to delete this notification ?');">
                                  <img src="img/delete.png" style="width:20px; margin-right:5%;margin-top:95%"></a>
                              </p>
                      </div> 
                  </div>
    
                </div>







        </header>

        <main>
            <div class="cards">

                <div class="card-single">
                    <div>
                        <h1><?php echo $num_exams;?></h1>
                        <span>total exams</span>
                    </div>
                    <div>
                        <span class="las la-book-medical"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $num_teachers;?></h1>
                        <span>totals teachers</span>
                    </div>
                    <div>
                        <span class="las la-user"></span>
                    </div>
                </div>

                <div class="card-single">
                    <div>
                        <h1><?php echo $num_students;?></h1>
                        <span>total students</span>
                    </div>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>

                
            </div>
            <!--Tabla-->
            <div class="recent-grid" >
                <div class="projects" >
                    <div class="card" >
                        <div class="card-header">
                            <h3>Students</h3>

                        </div>

                        <div class="card-body" >
                            <!-- <div class="table-responsive"> -->
                                <table >
                                    <thead>
                                    <tr style="background-color:#2ecc71;">
                                            <td>id</td>
                                            <td>Full name</td>
                                            <td>departement</td>
                                            <td>mobile</td>
                                            <td>role</td>
                                            <td>adress</td>
                                            <td></td>
                                            
                                            
                                        </tr>
                                    </thead>
                                   <?php

                                    while($row = mysqli_fetch_assoc($result2)): 
                                    
                                        $id_depart_1=$row['id_depart_1'];

                                        $sql2="SELECT * FROM departement where departement.id_departement=$id_depart_1 ";
                                    
                                        $result2=mysqli_query($conn, $sql2);
                                        $row2 = mysqli_fetch_assoc($result2);
                                    
                                    
                                    
                                    ?>
                                    <tbody>
                                       
                                            <td> <?php echo $row['id']; ?> </td>
                                            <td><?php  echo $row['first_name'].' '.$row['last_name']; ?> </td>
                                            <td> <?php echo $row2['name_departement']; ?></td>
                                            <td> <?php echo $row['mobile']; ?></td>
                                            <td> <?php echo $row['role']; ?> </td>
                                            <td> <?php echo $row['adress']; ?> </td>
                                            <td><button class="btn"><a href="edit.php?id_info=<?php echo $row['id']; ?>" >
                                                more info</a>  </td>
                                            <td><button class="btn"><a href="student_info.php?id_edit=<?php echo $row['id']; ?>" >
                                                edit </a>  </td>
                                            <td><button class="btn"><a href="edit.php?id_delete=<?php echo $row['id']; ?>" onclick="return confirm('Are You sure ?');">
                                                delete </a>  </td>

                                        </tr>
                                        
                                        <?php   endwhile; ?>
                                   
                                    </tbody>
                                </table>
                            <!-- </div> -->
                        </div>

                    </div>
                </div>

                <!-- <div class="customers">

                    <div class="card">
                        <div class="card-header">
                            <h3>New students</h3>

                            <button><a href="""> More details </a> <span class="las la-arrow-right">
                            </span></button>
                        </div>

                        <div class="card-body">


                            <div class="customer">
                                <div class="info">
                                    <img src="avatars/2.png" 40px " height="40px " alt=" ">
                                    <div>
                                        <h4>students 1</h4>
                                        <small>Arab</small>
                                    </div>
                               

                                    <label class="switch"  style="margin-left: 810px; " name="check">
                                        <a href=" "  onclick="return confirm('Are You sure ?');">
                                             <input type="checkbox"  checked >
                                             <span class="slider round" name="switch"></span>
                                       </a>           
                                    </label>


                                </div>
                                <div class="contact ">
                                    <span class="las la-user-circle "></span>
                                    <span class="lab la-whatsapp "></span>
                                    <span class="las la-phone "></span>
                                </div>
                            </div>

                            <div class="customer ">
                                <div class="info ">
                                    <img src=" " width="40px " height="40px " alt=" ">
                                    <div>
                                        <h4>students 2</h4>
                                        <small>machine learning</small>
                                    </div>
                                </div>
                                <div class="contact ">
                                    <span class="las la-user-circle "></span>
                                    <span class="lab la-whatsapp "></span>
                                    <span class="las la-phone "></span>
                                </div>
                            </div>

                            <div class="customer ">
                                <div class="info ">
                                    <img src=" " width="40px " height="40px " alt=" ">
                                    <div>
                                        <h4>students 3</h4>
                                        <small>robotics</small>
                                    </div>
                                </div>
                                <div class="contact ">
                                    <span class="las la-user-circle "></span>
                                    <span class="lab la-whatsapp "></span>
                                    <span class="las la-phone "></span>
                                </div>
                            </div>

                        
                            
                        </div>
                    </div>
                </div>  -->
                


            </div>
        </main>

    </div>
    <script src="js/stat.js"></script>
    <script src="js/js_notification.js"></script>
</body>

</html>