<?php
   $connection = new mysqli('localhost', 'root', '', 'cpc_votingdb'); // connecting to the database
   session_start();
    $student_id = $_SESSION['student_id'];
    $surname = $_SESSION['surname'];
    if(!$student_id && !$surname){
        header("location:login.html");
    }
  
    $queryCategory = "SELECT * FROM category ORDER BY id ASC";
    $sql_category = mysqli_query($connection, $queryCategory);
    $voting_list_id = null;
    $query_ongoing_election = "SELECT * FROM voting_list WHERE status = 1";
    $sql_ongoing_election = mysqli_query($connection, $query_ongoing_election);
    while ($election = mysqli_fetch_array($sql_ongoing_election)) {
        $voting_list_id = $election['id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote</title>
</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|PT+Sans:400,400italic,700' rel='stylesheet' type='text/css'>
    <link href="assets/css/vote.css" rel="stylesheet" type="text/css">
    <!-- STYLESHEET -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
<body>
        <!-- SITE HEADER -->
        <header class="site-header" style="margin-bottom: 60px;">
            <div class="top-bar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 trending-topics hidden-sm hidden-xs">
                            <h4>Trending</h4>
                            <ul class="list-inline">
                                <li><a href="#">Cordova Public College Online Election</a></li>
                            </ul>
                        </div> <!-- .col-md-6 ends -->
                        <div class="col-md-6 social-links">
                            <ul class="list-inline">
                                <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="icon ion-social-instagram-outline"></i></a></li>
                                <li><a href="#"><i class="icon ion-social-linkedin-outline"></i></a></li>
                            </ul>
    
                        </div> <!-- .col-md-6 ends -->
                    </div> <!-- .row ends -->
                </div> <!-- .container-fluid ends -->
            </div> <!-- .top-bar ends -->
    
            <nav class="navbar navbar-default politics-navbar">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#politics-navbar-real" area-expanded="false">
    
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="glyphicon glyphicon-menu-hamburger"></span>
    
                        </button>
    
                        <a class="navbar-brand" href="#">Politics</a>
                    </div> <!-- .navbar-header ends -->
                    <div class="collapse navbar-collapse" id="politics-navbar-real">
                        <ul class="nav navbar-nav navbar-left">
                            <li><a href="index.php">Home <span class="sr-only">(current)</span></a></li>
                            <li class="active"><a href="vote.php">Vote</a></li>
                        </ul> <!-- .nav navbar-nav ends -->
    
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="contact.html">Contact</a></li>
                        </ul> <!-- .nav navbar-nav ends -->
                    </div> <!-- .collapse navbar-collapse ends -->
                </div> <!-- .container ends -->
            </nav> <!-- .navbar navbar-default ends -->
    
        </header> <!-- .site-header ends --> 
    
<div class="container">
    <form onsubmit="event.preventDefault();" id="myForm">
    <?php while ($category = mysqli_fetch_array($sql_category)) { $title = $category['title']; ?>
        <div class="row">
        <ul class="directory-list">
    <?php for($i = 0; $i < strlen($title); $i++) { ?>
        <li><a href="#"><?php echo $title[$i]; ?></a></li>
    <?php } ?>
    </ul>
    </div>

<div class="directory-info-row">
    <div class="row">
    <?php   $cat = $category['id'];
            $query_candidate = "SELECT * FROM candidate WHERE category_id =  $cat AND voting_list_id = $voting_list_id"; 
            $candidate_info = mysqli_query($connection, $query_candidate);
            while ($candidate = mysqli_fetch_array($candidate_info)) { ?>
        <div class="col-md-6 col-sm-6">
            <div class="panel">
                <div class="panel-body">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="thumb media-object" src="assets\images\candidate\<?php echo $candidate['image']; ?>" alt="candidate" />
                        </a>
                        <div class="media-body">
                            <h4><?php echo $candidate['name']; ?> <span class="text-muted small"> - <?php echo $candidate['course']; ?></span></h4>
                            <ul class="social-links">
                                <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
                                <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
                                <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
                                <li><a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Skype"><i class="fa fa-skype"></i></a></li>
                            </ul>
                            <address>
                                <?php echo $candidate['address']; ?> <br />
                                <abbr title="Phone">Phone:</abbr> <?php echo $candidate['number']; ?><br />
                                <div class="radio">
                                    <label>
                                    <input type="radio" name="radioName" id="candidate_id" value="<?php echo $candidate['id']."-".$candidate['category_id']. "-". $candidate['name']; ?>">
                                     <strong>vote</strong>
                                    </label>
                                  </div>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php } ?>
    </form>
</div>

<!-- MAIN FOOTER -->
<footer class="main-footer" id="main-footer" style="margin-top: 20px;">
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 copyright-block">
                    <p>All rights reserved &copy; 2021 -2022 <a href="#">Cordova Public College</a></p>
                </div> <!-- .col-md-4 ends -->
                <div class="col-lg-4 social-block">
                    <ul class="social-icon-list list-inline">
                        <li><a href="#"><i class="icon ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-googleplus"></i></a></li>
                        <li><a href="#"><i class="icon ion-social-dribbble"></i></a></li>
                    </ul>
                </div> <!-- .col-lg-4 ends -->
                <div class="col-lg-4 extra-links-block">
                    <ul class="extra-links list-inline">
                        <li><a href="#">Terms &amp; Condition</a></li>
                        <li><a href="#">Legal</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul> <!-- .extra-links ends -->
                </div> <!-- .col-lg-4 ends -->
            </div> <!-- .row ends -->
        </div> <!-- .container-fluid ends -->
    </div> <!-- .bottom-bar ends -->
</footer> 
<!-- .main-fooer ends -->

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $('#myForm input').on('change', function() {
        var data = $('input[name=radioName]:checked').val().split('-');
        var student_id = "<?php echo $student_id; ?>";
        var candidate_id = data[0];
        var category_id = data[1];
        var form_data = new FormData();
        form_data.append('method', 'vote');
        form_data.append('vote_student_id', student_id);
        form_data.append('vote_candidate_id', candidate_id);
        form_data.append('vote_category_id', category_id);
        axios.post('handler.php', form_data)
        .then(function(r) {
            console.log(r.data);
           if(r.data == 1) {
            alert("You vote for " + data[2], '#myForm');
           }
           else {
               alert("Something went wrong.. Try again!");
           }
        }).catch(function(error) {
            console.log(error);
        })
       
    });
</script>
</body>
</html>