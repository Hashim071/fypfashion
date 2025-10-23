@extends('layouts.public_layout')

@section('content')
    <main>
        <!-- BREADCRUMB SECTION START -->
        <div class="ul-container">
            <div class="ul-breadcrumb">
                <h2 class="ul-breadcrumb-title">Blog</h2>
                <div class="ul-breadcrumb-nav">
                    <a href="index.html"><i class="flaticon-home"></i> Home</a>
                    <i class="flaticon-arrow-point-to-right"></i>
                    <span class="current-page">Blog</span>
                </div>
            </div>
        </div>
        <!-- BREADCRUMB SECTION END -->


        <!-- BLOG SECTION START -->
        <section>
            <div class="ul-inner-page-container">
                <div class="row ul-bs-row row-cols-md-3 row-cols-2 row-cols-xxs-1">

                    @forelse ($blogs as $blog)
                        <div class="col">
                            <div class="ul-blog">
                                <div class="ul-blog-img">
                                    @if ($blog->image && Str::startsWith($blog->image, 'admin/'))
                                        <img src="{{ asset($blog->image) }}" alt="{{ $blog->title }}">
                                    @else
                                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}">
                                    @endif

                                    <div class="date">
                                        <span class="number">{{ $blog->published_at->format('d') }}</span>
                                        <span class="txt">{{ $blog->published_at->format('M') }}</span>
                                    </div>
                                </div>

                                <div class="ul-blog-txt">
                                    <div class="ul-blog-infos flex gap-x-[30px] mb-[16px]">
                                        <div class="ul-blog-info">
                                            <span class="icon"><i class="flaticon-user-2"></i></span>
                                            <span class="text font-normal text-[14px] text-etGray">By
                                                {{ $blog->user->name ?? 'Admin' }}
                                            </span>
                                        </div>
                                    </div>

                                    <h3 class="ul-blog-title">
                                        <a href="{{ route('public.blog.details', $blog->slug) }}">{{ $blog->title }}</a>
                                    </h3>


                                    <a href="{{ route('public.blog.details', $blog->slug) }}" class="ul-blog-btn">Read More
                                        <span class="icon"><i class="flaticon-up-right-arrow"></i></span></a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No blog posts found at the moment.</p>
                        </div>
                    @endforelse

                </div>

                <div class="ul-pagination pt-0 border-0 d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>

            </div>
        </section>
        <!-- BLOG SECTION END -->
    </main>
@endsection
