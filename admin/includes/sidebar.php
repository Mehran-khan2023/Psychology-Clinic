<?php  //error_reporting(0);
     

?>
<nav class="sidebar">
    <div class="logo my-2 px-0">
        <span style="font-size:24px;  color:orange">Psychology </span><span
            style="font-size:20px;  color:red">clinic</span>

    </div>
    <div class="mx-5 mb-4 py-2"> <a href="index.php"><i class="fa fa-home fa-4x text-info"></i>Home</a></div>

    <div>
        <ul id="sidebar_menu">
            <li class="side_menu_title">
                <span>Admin</span>
            </li>
            <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 1) {?>
            <li class="mm-active">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span>Admin Section</span>

                </a>
                <ul>
                    <li>
                        <a class="active" href="admin.php"> <i class="fa fa-user-cog"></i> Admin</a>
                    </li>

                </ul>

            </li>
            <li class="side_menu_title">
                <span>Doctors</span>
            </li>
            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span>Doctor Section</span>
                </a>
                <ul>
                    <li><a href="total_doctor.php">Doctors List</a></li>

                </ul>
            </li>

            <li class="side_menu_title">
                <span>Patients</span>
            </li>
            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span> Patients Section</span>
                </a>
                <ul>
                    <li><a href="total_patient.php">Patients List</a></li>

                </ul>
            </li>



            <li class="side_menu_title">
                <span>Appointments</span>
            </li>
            <li class="">
                <a class="has-arrow" href="#" aria-expanded="false">
                    <img src="img/menu-icon/2.svg" alt="">
                    <span> Appointments Section</span>
                </a>
                <ul>
                    <li><a href="total_appointment.php">Appointments</a></li>

                </ul>
            </li>

    </div>
    <?php }?>









    <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 3) {?>
    <li class="side_menu_title">
        <span>Appointment Details</span>
    </li>
    <li class="">
        <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/2.svg" alt="">
            <span> Appointment Section</span>
        </a>
        <ul>
            <li><a href="patient_appointments.php">Appointments List</a></li>

        </ul>
    </li>
    <?php } ?>



    <?php if($_SESSION['IS_LOGIN'] && $_SESSION['RULE'] == 2) {?>
    <li class="side_menu_title">
        <span>Appointment Details</span>
    </li>
    <li class="">
        <a class="has-arrow" href="#" aria-expanded="false">
            <img src="img/menu-icon/2.svg" alt="">
            <span> Appointment Section</span>
        </a>
        <ul>
            <li><a href="doctor_appointment.php">Appointment List</a></li>

        </ul>
    </li>

    <?php }?>


    </ul>

</nav>