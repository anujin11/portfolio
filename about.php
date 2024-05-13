<?php 
    ob_start();
    if(!session_start()){
      session_start();
    }
    include("template/front/header.php");
    include("template/front/navbar.php");
    include("config/database.php");
?>
<?php
	  $i=1;
	 $statement = $conn->prepare('SELECT * FROM about ORDER BY about_id DESC');
	 $statement->execute();
	  $about = $statement->fetchAll(PDO::FETCH_ASSOC);
	  $sNo  = 1;
	 foreach ($about as $about); 
   ?>

<section class="about">

    <h1 class="heading">  <span>Миний тухай</span> </h1>

    <div class="row">

        <div class="info-container">

            <h1>Хувийн мэдээлэл</h1>

            <div class="box-container">

                <div class="box">
                    <h3> <span>Нэр : </span> <?php echo $about['about_name']; ?> </h3>
                    <h3> <span>Нас : </span> <?php echo $about['about_age']; ?> </h3>
                    <h3> <span>Имайл : </span> <?php echo $about['about_email']; ?> </h3>
                    <h3> <span>Хаяг : </span><?php echo $about['about_address']; ?> </h3>
                </div>

                <div class="box">
                    <h3> <span>Чөлөөт цаг : </span> <?php echo $about['about_free']; ?> </h3>
                    <h3> <span>Чадвар : </span> <?php echo $about['about_skill']; ?> </h3>
                    <h3> <span>Хэл : </span> <?php echo $about['about_lang']; ?></h3>
                </div>
            </div>


        </div>
        
    </div>
</section>

<section class="skills">
    <h1 class="heading"> <span>Миний чадвар</span>  </h1>
    <div class="box-container">
        <div class="box">
            <img src="storage/skills/icon-1.png">
            <h3>html</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-2.png">
            <h3>css</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-3.png">
            <h3>javascript</h3>
        </div>
        <div class="box">
            <img src="storage/skills/icon-5.png">
            <h3>jquery</h3>
        </div>
        </div>
    </div>

</section>

<section class="education">
    <h1 class="heading"> <span>Боловсрол</span>  </h1>
    <div class="box-container">
        <?php
$a=1;
$stmt = $conn->prepare(
     "SELECT * FROM education");
$stmt->execute();
$education = $stmt->fetchAll();
foreach($education as $row) 
{  	    
?>
        <div class="box">
            <i class="fas fa-graduation-cap"></i>
            <span><?php echo $row['education_year']; ?></span>
            <h3><?php echo $row['education_title']; ?></h3>
            <p><?php echo $row['education_desc']; ?></p>
        </div>
        <?php } ?>
    </div>
</section>

<?php include("template/front/navbar.php"); ?>