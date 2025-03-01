<!DOCTYPE html>
<html>
<head>
    <title>JQuery Form Validataion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <style>
        label.error {
            color: #dc3545;
            font-size: 14px;
        }
    </style>
</head>
<body>
   <div class="container">

    <div class="card mt-5">
        <h3 class="card-header p-3">
            <i class="fa fa-star"></i> Form Validation
        </h3>
        <div class="card-body">

            @session('success')
             <div class="alert alert-success" role="alert">
                {{ $value }}
             </div>
            @endsession

            @if ($errors->any())
            <div class="alert alert-danger">
                There were some problem
                <ul>
                    @foreach ($errors->all() as $error)
                       <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif


            <form method="POST" action="{{ route('users.store') }}" id="regForm">

                {{ csrf_field() }}

                <div class="mb-3">
                    <label class="form-label" for="inputName">Name:</label>
                    <input
                        type="text"
                        name="name"
                        id="inputName"
                        class="form-control"
                        placeholder="Name">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Email:</label>
                    <input
                        type="text"
                        name="email"
                        id="inputEmail"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="password">Password:</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        placeholder="Password">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="inputPassword">Confirm Password:</label>
                    <input
                        type="password"
                        name="confirm_password"
                        id="inputPassword"
                        class="form-control"
                        placeholder="Password">
                </div>

                <div class="mb-3">
                    <button class="btn btn-success btn-submit"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
   </div>
</body>

<script type="text/javascript">
  $(document).ready(function(){
    $("#regForm").validate({
        rules: {
            name: {
                required: true,
                maxlength: 60,
            },
            email: {
                required: true,
                email: true,
                maxlength: 50,
            }
            password: {
                required: true,
                minlength: 5,
            },
            confirm_password: {
                required: true,
                equalTo: "#password",
            },
        },
        messages: {
            name: {
                required: "Name field is required",
                maxlength: "Name field cannot be more than 20 characters"
                },
            email: {
                required: "Email field is required",
                email: "Email field must be a valid email address",
                maxlength: "Email field cannot be more than 50 characters",
            },
            password: {
                required: "Password field is required",
                minlength: "Password field must be at least 5 characters"
            },
            confirm_password: {
                required:  "Confirm field password is required",
                equalTo: "Password field and confirm password field should same"
            }
        }
    })
  })

</script>

</html>
