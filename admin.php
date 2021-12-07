<?php
   $connection = new mysqli('localhost', 'root', '', 'cpc_votingdb'); // connecting to the database
   session_start();
    $student_id = $_SESSION['student_id'];
    $surname = $_SESSION['surname'];
    $type = $_SESSION['type'];
    if(!$student_id && !$surname){
        header("location:login.html");
    }
    else if($type != 1) {
      header("location:index.php");
    }
    // to displat student data
   $query_student = "SELECT * FROM student ORDER BY student_id ASC";
   $sql_student = mysqli_query($connection, $query_student);
   // to display category data
   $queryCategory = "SELECT * FROM category ORDER BY id ASC";
   $sql_category = mysqli_query($connection, $queryCategory);
    // to display voting list data
    $query_votingList = "SELECT * FROM voting_list ORDER BY id ASC";
    $sql_votingList = mysqli_query($connection, $query_votingList);
    $queryCategory1 = "SELECT * FROM category ORDER BY id ASC";
    $sql_category1 = mysqli_query($connection, $queryCategory1);
    $queryCategoryCandidate = "SELECT * FROM category ORDER BY id ASC";
    $sql_categoryCandidate = mysqli_query($connection, $queryCategoryCandidate);
    $query_ongoing_election = "SELECT * FROM voting_list WHERE status = 1";
    $sql_ongoing_election = mysqli_query($connection, $query_ongoing_election);
    $voting_list_id = null;
    $cat = null;
    $countVote = null;
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/css/admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/vote.css">
    <title>Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" style="height: 50px;" alt="logo">
             <span class="fw-bold"> Cordova Public College Online Voting System </span>       
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse dropdown navbar-collapse" id="navbarText">
                <span class="navbar-text fw-bold">
                    <a class="btn dropdown-toggle"href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-power-off fa-lg"></i>  
                  <?php  echo $surname;?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                      </ul>
                </span>
          </div>
        </div>
      </nav>
        <div class="d-flex align-items-start">
            <div class="nav flex-column nav-pills px-2 me-2 bg-light" style="height:700px" id="v-pills-tab" role="tablist" aria-orientation="vertical">
              <button class="nav-link fw-bold active mt-2" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fas fa-h-square fa-lg"></i> Home</button>
              <button class="nav-link fw-bold" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fas fa-th-list"></i> Category List</button>
              <button class="nav-link fw-bold" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fas fa-list-ol"></i> Voting List</button>
              <button class="nav-link fw-bold" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-users"></i> Students</button>
            </div>
            <div class="tab-content" id="v-pills-tabContent">
                <h2 class="fw-bold mt-3">░D░A░S░B░O░A░R░D░</h2>
      <!-- home-->
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
              <div class="card">
                  <div class="card-body">
                      <div class="col-lg-12">
                          <div class="text-center">
                          <?php while($election = mysqli_fetch_array($sql_ongoing_election)) { $voting_list_id = $election['id'];?>
                              <h3><b><?php echo $election['title']; ?></b></h3>
                              <small><b><?php
                                echo $election['description']; 
                                $status = $election['status'];?>
                              </b></small>
                            <?php } ?>	
                              </div>
                              <hr>
                                <div class="row">                                    <div class="col-md-12">
      <button class="btn btn-sm btn-primary float-end" type="button" data-bs-toggle="modal" data-bs-target="#candidateModal">Add Candidate <i class="fas fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                    <hr>
                          <div class="row mb-4">
                                <div class="col-md-12">
                                <div class="text-center">

  <div class="directory-info-row">
      <div class="row">
        <?php $queryCategory2 = "SELECT * FROM category ORDER BY id ASC";
              $sql_category2 = mysqli_query($connection, $queryCategory2);
              while ($category2 = mysqli_fetch_array($sql_category2)) { ?>
              <h3><?php echo $category2['title']; ?></h3>
              <?php $cat = $category2['id']; ?>
              <?php $query_candidate = "SELECT * FROM candidate WHERE category_id = $cat AND voting_list_id = $voting_list_id"; 
                    $candidate_info = mysqli_query($connection, $query_candidate);
                    while ($candidate = mysqli_fetch_array($candidate_info)) {
              ?>
               <div class="col-md-6 col-sm-6">
              <div class="panel">
                  <div class="panel-body">
                      <div class="media btn position-relative">
                          <a class="pull-left" href="#">
                              <img class="thumb media-object" src="assets/images/candidate/<?php echo $candidate['image']; ?>" alt="candidate" />
                          </a>
                    <?php $sql = "SELECT * from record_vote WHERE candidate_id = ".$candidate['id'];
                      if ($result = mysqli_query($connection, $sql)) {
                          $count = mysqli_num_rows($result);
                          $countVote = isset($count) ? $count : 0;
                      } ?>
                          <span class="position-absolute top-0 start-80 translate-middle badge rounded-pill bg-success">
                          <?php echo $countVote; ?>
                          </span>
                          <div class="media-body">
                              <h4><?php echo $candidate['name']; ?><span class="text-muted small"> - <?php echo $candidate['course']; ?></span></h4>
                              <address>
                                <?php echo $candidate['address'] ?>
                                <br>
                                  <abbr title="Phone">Cotact Number:</abbr> <?php echo $candidate['number']; ?><br />
                              </address>
                              <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-primary btn-sm" type="button" onclick="edit_candidate(<?php echo $candidate['id']; ?>)" data-bs-toggle="modal" data-bs-target="#updateCandidateModal"><i class="fas fa-pencil-alt"></i> Edit</button>
                                <button class="btn btn-danger btn-sm" type="button" onclick="delete_candidate(<?php echo $candidate['id']; ?>);"><i class="fas fa-trash-alt"></i> Delete</button>
                              </div>
                            
                             </div>
                          </div>
                      </div>
                  </div>
              </div>
              <?php } ?>
              <?php } ?>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<!-- end of home -->
  
              <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-4">
                      <div class="card my-3" style="width: 500px;">
                        <form onsubmit="add_category(event);">
                              <div class="card-header">Category Form</div>
                              <div class="card-body">
                                <h6 class="card-title">Category</h6>
                                <p class="card-text"><input type="text" class="form-control" name="category" placeholder="Enter Category"> </p>
                            </div>
                              <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary col-sm-2"> Save</button>
                                <button type="button" class="btn btn-sm btn-secondary col-sm-2"> Cancel</button>
                              </div>
                            </form>
                            </div>
                      </div>
                      <div class="col-lg-4">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">#ID</th>
                              <th scope="col">Category</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                      <?php while($category = mysqli_fetch_array($sql_category)) { ?>
                          <tr> 
                          <td><?php echo $category['id']; ?></td>
                          <td><?php echo $category['title']; ?></td>
                          <td>
                          <button type="button" data-bs-toggle="modal" onclick="edit_category(<?php echo $category['id']; ?>)" data-bs-target="#modalCategory" class="btn btn-primary">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="delete_category(<?php echo $category['id']; ?>)">Delete</button>
                                               <!-- Modal for category -->
                <div class="modal fade" id="modalCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categorylabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="categoryLabel">Update Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <input type="text" class="form-control" id="update_category" placeholder="Edit Category">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="update_category();" data-bs-dismiss="modal">Update</button>
                      </div>
                    </div>
                  </div>
                </div>
                        </td>
                          </tr>
                          <?php } ?>
                          </tbody>
                        </table>
                        </div>
                    </div>
                  </div>
              </div>
              <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <div class="container">
                              <div class="card m-3" style="width: 600px;">
                                <form onsubmit="add_votingList(event);">
                                      <div class="card-header">Voting Form</div>
                                      <div class="card-body">
                                        <div class="form-floating mb-3">
                                          <input type="text" class="form-control" name="title" id="title" placeholder="title">
                                          <label for="title">Enter Title</label>
                                        </div>
                                        <div class="form-floating">
                                          <textarea class="form-control" placeholder="Enter a description here" name="description" id="description" style="height: 100px"></textarea>
                                          <label for="description">Description</label>
                                        </div>
                                    </div>
                                      <div class="card-footer">
                                        <button type="submit" class="btn btn-sm btn-primary col-sm-2"> Save</button>
                                        <button type="button" class="btn btn-sm btn-secondary col-sm-2"> Cancel</button>
                                      </div>
                                    </form>
                                    </div>

                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">#ID</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">Description</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                              <?php while($voting_list = mysqli_fetch_array($sql_votingList)) { ?>
                          <tr> 
                          <td><?php echo $voting_list['id']; ?></td>
                          <td><?php echo $voting_list['title']; ?></td>
                          <td><?php echo $voting_list['description']; ?></td>
                         <?php if($voting_list['status'] == 0){ ?>
                          <td>
                              <button type="button" onclick="on_status(<?php echo $voting_list['id']; ?>)" class="btn btn-danger btn-sm">OFF</button>
                          </td>
                          <?php } else {?>
                            <td>
                              <button type="button" class="btn btn-success btn-sm">ON</button>
                          </td>
                            <?php } ?>
                          <td>
                          <button type="button" class="btn btn-primary" onclick="get_votingList(<?php echo $voting_list['id']; ?>)"  data-bs-toggle="modal" data-bs-target="#modalVotingList">Edit</button>
                          <button type="button" class="btn btn-danger" onclick="delete_votingList(<?php echo $voting_list['id']; ?>)">Delete</button>                              
                          </td>
                          </tr>
                          <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>

              <!-- update for voting list -->
              <div class="modal fade" id="modalVotingList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="votingLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="votingLabel">Update Voting List</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="update_votingList_title" placeholder="Update title">
                                        <label for="update_votingList_title">Edit Title</label>
                                      </div>
                                      <div class="form-floating">
                                        <textarea class="form-control" placeholder="Enter a description here" id="update_votingList_description" style="height: 100px">
                                        </textarea>
                                        <label for="update_votingList_description">Edit Description</label>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                      <button type="button" class="btn btn-primary" onclick="update_votingList();" data-bs-dismiss="modal">Update</button>
                                    </div>
                                  </div>
                                </div>
                              </div>


              <div class="tab-pane fade mx-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Student ID</th>
                          <th scope="col">Surname</th>
                          <th scope="col">Account Type</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php while($data = mysqli_fetch_array($sql_student)) { ?>
                          <tr> 
                          <td><?php echo $data['id']; ?></td>
                          <td><?php echo $data['student_id']; ?></td>
                          <td><?php echo $data['surname']; ?></td>
                          <td><?php 
                              if($data['type'] == 1) {
                                 echo "Admin"; 
                                }
                                else {
                                  echo "Student";
                                }  
                          ?></td>
                          <td>
                          <!-- update -->
                          <button  class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" onclick="on_edit(<?php echo $data['id']; ?>)" data-bs-target="#staticBackdrop"><i class='far fa-edit fa-sm'></i> </button>
                          <!-- delete -->
                      <form onsubmit="event.preventDefault(); delete_student(event);">
                          <input type="hidden" name="delete_id" value="<?php echo $data['student_id']; ?>"/>
                          <button type="submit" class="btn btn-danger btn-sm"><i class='far fa-trash-alt'></i></button>
                      </form>
                    </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Update</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="container">
                            <input type="number" class="form-control mb-3" id="update_studentId" placeholder="Enter Student ID" required>
                            <input type="text" class="form-control mb-3" id="update_surname"  placeholder="Enter Surname" required>
                            <select class="form-select form-select-sm" id="update_type" aria-label=".form-select-sm example">
                                <option selected>Update Account Type</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                          </select>
                          </div>
                        </div>
                     <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary" id="btn_update" data-bs-dismiss="modal">update</button>
            </div>
          </div>
        </div>
      </div>
  <!-- modal end-->

  
    <!-- modal for adding candidate-->
<div class="modal fade" id="candidateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="candidateLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form onsubmit="event.preventDefault(); add_candidate(event);">
      <div class="modal-header">
        <h5 class="modal-title" id="candidateLabel">New Candidate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="container">
            <div class="form-group mb-2">
              <label for="#categorySelect" class="control-label">Category</label>
              <select name="category" class="form-control my-1" required>
              <?php while($category1 = mysqli_fetch_array($sql_category1)) { ?>
                  <option value="<?php echo $category1['id']; ?>"> <?php echo $category1['title']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <label for="#image" class="control-label">Image</label>
              <input type="file" class="form-control"  name="image" required>
            </div>
            <div class="form-group mb-2">
              <label for="#candidate_name" class="control-label">Name</label>
              <input type="text" class="form-control"  name="candidate_name" required placeholder="Enter candidate name">
              <input type="hidden" name="voting_list_id" value="<?php echo $voting_list_id ?>" >
            </div>
            <div class="form-group mb-2">
              <label for="#course" class="control-label">Course</label>
              <input type="text" class="form-control"  required name="course" placeholder="Enter candidate course">
            </div>
            <div class="form-group mb-2">
              <label for="#candiate_number" class="control-label">Mobile Number</label>
              <input type="number" class="form-control" required name="candidate_number" placeholder="Enter candidate number">
            </div>
            <div class="form-floating my-2">
              <textarea class="form-control" required placeholder="Leave a comment here" name="candidate_address"  style="height: 100px"></textarea>
              <label for="address">Enter Candidate Adress</label>
            </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- end of modal-->

  <!-- modal for update candidate-->
<div class="modal fade" id="updateCandidateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="uLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form onsubmit="event.preventDefault(); update_candidate(event);">
      <div class="modal-header">
        <h5 class="modal-title" id="uLabel">Update Candidate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div class="container">
            <div class="form-group mb-2">
              <label for="candidateCategory" class="control-label">Category</label>
              <select  id="candidateCategory" name="candidateCategory" class="form-control my-1" required>
              <?php while($categoryCandidate = mysqli_fetch_array($sql_categoryCandidate)) { ?>
                  <option value="<?php echo $categoryCandidate['id']; ?>"> <?php echo $categoryCandidate['title']; ?></option>
              <?php } ?>
              </select>
            </div>
            <div class="form-group mb-2">
              <label for="#update_image" class="control-label">Change Image</label>
              <input type="file" class="form-control" id="update_image" name="update_image" required>
            </div>
            <div class="form-group mb-2">
              <label for="#update_name" class="control-label">Change Name</label>
              <input type="text" class="form-control" id="update_name" name="update_name" required placeholder="Enter candidate name">
              <input type="hidden" id="update_voting_list_id" name="update_voting_list_id" value="<?php echo $voting_list_id ?>" >
            </div>
            <div class="form-group mb-2">
              <label for="#candidateCourse" class="control-label">Change Course</label>
              <input type="text" class="form-control" id="update_course" name="update_course" required placeholder="Enter candidate course">
            </div>
            <div class="form-group mb-2">
              <label for="#update_number" class="control-label">Change Mobile Number</label>
              <input type="number" class="form-control" required id="update_number" name="update_number" placeholder="Enter candidate number">
            </div>
            <div class="form-floating my-2">
              <textarea class="form-control" required placeholder="Leave a address here" id="update_address" name="update_address" style="height: 100px"></textarea>
              <label for="update_address">Enter Candidate Adress</label>
            </div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="sbumit" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- end of modal-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="main.js"></script>
  </body>
</html> 