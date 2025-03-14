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
    <div class="container mt-5">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            <img src="{{ asset('uploads/' . session('image')) }}" width="300">
        @endif

        <form action="{{ url('/upload-image') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Choose Image:</label>
                <input type="file" name="image" class="form-control">
                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

</body>
</html>
