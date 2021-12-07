
function showPassword() {
    var password = document.getElementById('pwd');
    if (password.type === 'password') {
        password.type = "text";
    }
    else {
        password.type = "password";
        }
    }


    function login() {
        
        var student_id = $('#student_id').val();
        var surname = $('#pwd').val() // surname

        var data = new FormData();
        data.append('method', 'student_login');
        data.append('student_id', student_id);
        data.append('surname', surname);
        axios.post('handler.php', data)
        .then(function(r) {
            console.log(r.data);
            if(r.data == 1) {
                window.location = "admin.php";
            }
            else if(r.data == 2) {
                window.location = 'index.php';
            }
            else {
                alert('invalid username or password');
            }
        })
    }

    $('#btn-login').click(function() {
        login();
    })


    function register(event) {
        var data = new FormData(event.target);
        data.append('method', 'register');
        axios.post('handler.php', data)
        .then(function(r) {
            console.log(r.data);
            if(r.data == 1) {
                Swal.fire(
                    'Account Created Sucessfully!',
                    'You can now login and vote for your favorite candidate!',
                    'success'
                  )
            }
            else {
                alert('Please try agaain..!');
            }
        })
        .catch(function(error) {
            console.log(error);
        })
    }

    function delete_student(event) {
        var data = new FormData(event.target);
        data.append('method', 'delete_student');
        axios.post('handler.php', data)
        .then(function(r) {
            console.log(r.data == 1);
            if(r.data == 1) { 
               alert("Sucessfully deleted!");
               document.location.reload(); // reload the page
            }
        })
    }

    var update_id = null;
    function on_edit(id) {
        update_id = id;
    }

    function update_student() {
        var studentId = $("#update_studentId").val();
        var surname = $("#update_surname").val();
        var type = $("#update_type").val();

        if(surname != '' && studentId != '') {
            var data = new FormData();
            data.append('method', 'update_student');
            data.append('update_id', update_id);
            data.append('update_studentId', studentId);
            data.append('update_surname', surname);
            data.append('update_type', type);
            axios.post('handler.php', data)
            .then(function(r) {
            if(r.data == 1) {
                let timerInterval
                Swal.fire({
                title: 'Updating!',
                html: 'Processing request in <b></b> milliseconds.',
                timer: 2000,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                    window.location = "admin.php";
                }
                })
            }
        })
    }
    else {
        Swal.fire({
            title: '<strong>Something wrong!</strong>',
            icon: 'info',
            html:
              '<div class="alert alert-warning" role="alert">Please fill in all the fields, try again, Thanks! </div>',
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
              '<i class="fa fa-thumbs-up"></i> Great!',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText:
              '<i class="fa fa-thumbs-down"></i>',
            cancelButtonAriaLabel: 'Thumbs down'
          })
    }
    } 


 $("#btn_update").click(function() {
     update_student();
 })

function add_category(event) {
    var data = new FormData(event.target);
    data.append('method', 'add_category');
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
            alert("Category added successfully!");             
        }
        else{
            alert("Something went wrong, please try again!");
        }
    })
}


function delete_category(id) {
    var data = new FormData();
    data.append("method", 'delete_category');
    data.append('category_id', id);
    axios.post('handler.php', data)
    .then(function(r) {
       if(r.data == 1) {
           alert("Category deleted successfully!");
           window.location = "admin.php";
       }
       else {
           alert("Something went wrong..!");
       }
    })
}

var edit_categoryId = null;
function edit_category(id) {
    edit_categoryId = id;
}

function update_category() {
    var update_category = $("#update_category").val();
    var data = new FormData();
    data.append('method', 'update_category');
    data.append('category_id', edit_categoryId);
    data.append('update_category', update_category);
    axios.post('handler.php', data)
    .then(function(r) {
       if(r.data == 1) {
           alert("Updated Sucessfully!");
           window.location = "admin.php";
       }
       else {
           alert("Something went wrong, please try again!");
       }
    })
}

function add_votingList(event) {
    var data = new FormData(event.target);
    data.append('method', 'add_votingList');
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
            alert("Voting list added successfully!");
        }
        else {
            alert("Something went wrong, please try again!");
        }
    })
}

var votingList_id = null;
 function get_votingList(id) {
     votingList_id = id;
 }

function update_votingList() {
    var title = $("#update_votingList_title").val();
    var description = $("#update_votingList_description").val();
    var data = new FormData();
    data.append('method', 'update_votingList');
    data.append('update_votingList_id', votingList_id);
    data.append('update_votingList_title', title);
    data.append('update_votingList_description', description);
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
            alert("Voting list updated successfully!");
            window.location = "admin.php";
        }
        else {
            alert("Something went wrong, please try again!");
        }
    })
}

function delete_votingList(id) {
    var data= new FormData();
    data.append('method', 'delete_votingList');
    data.append('delete_votingList_id', id);
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
            alert("Voting list deleted successfully!");
            window.location = "admin.php";
        }
        else {
            alert("Something went wrong, please try again!");
        }
    })
}

function on_status(id) {
    var data = new FormData();
    data.append('method', 'on_status');
    data.append('status_id', id);
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
            alert("Turned On Sucessfully!");
            window.location = "admin.php";
        }
    })
}

function add_candidate(event) {
    var data = new FormData(event.target);
    data.append('method', 'add_candidate');
    axios.post('handler.php', data)
    .then(function(r) {
        if(r.data == 1) {
        let timerInterval
        Swal.fire({
          title: 'Adding Please wait!',
          html: 'Adding candidate in <b></b> milliseconds.',
          timer: 2000,
          timerProgressBar: true,
          didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
              b.textContent = Swal.getTimerLeft()
            }, 100)
          },
          willClose: () => {
            clearInterval(timerInterval)
            window.location = "admin.php";
          }
        })
    }
    else {
        alert("Something went wrong, please try again later..!");
    }
    })
}

function delete_candidate(id) {
    var data = new FormData();
    data.append('method', 'delete_candidate');
    data.append('delete_candidate_id', id);
    axios.post('handler.php', data)
    .then(function(r) {
        console.log(r.data);
        if(r.data == 1) {
            alert("Delete Sucessfully");
            window.location = "admin.php";
        }
        else {
            alert("Something went wrong, Please try again!");
        }
    })
}

var candidate_id = null;
function edit_candidate(id) {
   candidate_id = id;
}

function update_candidate(event)  {
    var data = new FormData(event.target);
    data.append('method', 'update_candidate');
    data.append('candidate_id', candidate_id);
    axios.post('handler.php', data)
    .then(function(r) {
        console.log(r.data);
        if(r.data == 1) {
            alert("Sucessfully updated!");
            window.location = "admin.php";
        }
        else {
            alert("Something went wrong, please try again!");
        }
    })
}