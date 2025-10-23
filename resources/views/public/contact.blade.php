@extends('layouts.public_layout')

@section('content')
    <main>
        <!-- BREADCRUMB SECTION START -->
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Contact Us</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="index.html"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Contact Us</span>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB SECTION END -->


        <!-- CONTACT INFO SECTION START -->
        <section class="ul-contact-infos">
            <!-- single contact info -->
            <div class="ul-contact-info">
                <div class="icon"><i class="flaticon-location"></i></div>
                <div class="txt">
                    <h6 class="title">Our Address</h6>
                    <p class="descr mb-0">2715 Ash Dr. San Jose, South Dakota 83475</p>
                </div>
            </div>

            <!-- single contact info -->
            <div class="ul-contact-info">
                <div class="icon"><i class="flaticon-email"></i></div>
                <div class="txt">
                    <h6 class="title">Email Address</h6>
                    <p class="descr mb-0">
                        <a href="mailto:info@ticstube.com">info@ticstube.com</a>
                        <a href="mailto:contact@ticstube.com">contact@ticstube.com</a>
                    </p>
                </div>
            </div>

            <!-- single contact info -->
            <div class="ul-contact-info">
                <div class="icon"><i class="flaticon-stop-watch-1"></i></div>
                <div class="txt">
                    <h6 class="title">Hours of Operation</h6>
                    <p class="descr mb-0">
                        <span>Sunday-Fri: 9 AM – 6 PM</span><br>
                        <span>Saturday: 9 AM – 4 PM</span>
                    </p>
                </div>
            </div>
        </section>
        <!-- CONTACT INFO SECTION END -->

        <div class="ul-contact-from-section mt-20" style="margin-top: 40px;">
            <div class="ul-contact-form-container">
                <h3 class="ul-contact-form-container__title">Get in Touch</h3>

                {{-- Success Message Dikhane Ke Liye --}}
                @if (session('success'))
                    <div
                        style="padding: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 20px;">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Form ko update karein --}}
                <form action="{{ route('contact.store') }}" method="POST" class="ul-contact-form">
                    @csrf {{-- CSRF Protection - Bohat Zaroori! --}}
                    <div class="grid">

                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" name="first_name" placeholder="First Name"
                                    value="{{ old('first_name') }}">
                                <span class="field-icon"><i class="flaticon-user"></i></span>
                            </div>
                            @error('first_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="position-relative">
                                <input type="text" name="last_name" placeholder="Last Name"
                                    value="{{ old('last_name') }}">
                                <span class="field-icon"><i class="flaticon-user"></i></span>
                            </div>
                            @error('last_name')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="position-relative">
                                <input type="tel" name="phone_number" placeholder="Phone Number"
                                    value="{{ old('phone_number') }}">
                                <span class="field-icon"><i class="flaticon-user"></i></span> {{-- Icon change kar sakte hain to flaticon-phone --}}
                            </div>
                            @error('phone_number')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="position-relative">
                                <input type="email" name="email" placeholder="Enter Email Address"
                                    value="{{ old('email') }}">
                                <span class="field-icon"><i class="flaticon-email"></i></span>
                            </div>
                            @error('email')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="position-relative">
                                <textarea name="message" placeholder="Write Message...">{{ old('message') }}</textarea>
                                <span class="field-icon"><i class="flaticon-edit"></i></span>
                            </div>
                            @error('message')
                                <span style="color: red;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </main>
@endsection
