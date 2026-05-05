@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Demo Mail') }}</div>

                {{-- <h1>{{ $mailData['title'] }}</h1>
                 <p>{{ $mailData['body'] }}</p> --}}

                 <p>Thank you for using our application.</p>

                 <p>Best regards,</p>
                 <p>Jackson Kishan</p>

                 <p>Email: <a href="mailto:jackson@jackson-kishan.com">jackson@jackson-kishan.com</a></p>
                 <p>Phone: <a href="tel:+919876543210">+91 9876543210</a></p>
                 <p>Website: <a href="https://www.jackson-kishan.com">https://www.jackson-kishan.com</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
