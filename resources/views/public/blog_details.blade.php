@extends('layouts.public_layout')

@section('content')
    <main>
        <div class="ul-container">
            <div class="ul-breadcrumb">
                {{-- ✅ Dynamic Title --}}
                <h2 class="ul-breadcrumb-title">{{ $blog->title }}</h2>
                <div class="ul-breadcrumb-nav">
                    {{-- ✅ Dynamic Links --}}
                    <a href="{{ url('/') }}"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <a href="{{ route('public.blog') }}">Blog</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">{{ Str::limit($blog->title, 30) }}</span>
                </div>
            </div>
        </div>
        <section>
            <div class="ul-inner-page-container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <div class="ul-blog-details-wrapper">

                            <div class="ul-blog-details-img mb-4">
                                @if (Str::startsWith($blog->image, 'admin/'))
                                    <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100 rounded">
                                @else
                                    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid w-100 rounded">
                                @endif
                            </div>

                            <div class="ul-blog-infos flex-column flex-sm-row gap-y-3 justify-content-between align-items-sm-center mb-4">
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-user-2"></i></span>
                                    <span class="text font-normal text-[14px] text-etGray">By {{ $blog->user->name }}</span>
                                </div>
                                <div class="ul-blog-info">
                                    <span class="icon"><i class="flaticon-calendar"></i></span>
                                    <span class="text font-normal text-[14px] text-etGray">Published: {{ $blog->published_at->format('F d, Y') }}</span>
                                </div>
                            </div>

                            <h1 class="ul-blog-details-title mb-4">{{ $blog->title }}</h1>

                            <div class="ul-blog-details-body">
                                {!! $blog->body !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        </main>
@endsection
