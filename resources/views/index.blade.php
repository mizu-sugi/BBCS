@extends('layouts.default')
@section('title', 'トップページ')

@section('content')


<section class>
  <div class="container mx-auto py-40 relative">
    <h1 class="mt-2 text-5xl font-bold font-heading text-center">Blessed to be a <br>Breast Cancer Survivor!</h1>


  </div>
</section>

<div class="bg-gray">
  <section id="course01">
    <div class="course-box flex flex-row-reverse">
      <div class="course-box__info flex justify-start items-center box-border w-1/2 px-12">
        <div class="course-box__inner max-w-[570px]">
          <h3 class="course-box__title mb-10 text-[2.1rem] font-bold">Health Management</h3>
          <p class="course-box__paragraph text-justify leading-relaxed"></p>
        </div>
      </div>
      <div class="course-box__img w-1/2 m-0">
        <img src="/images/index/yoga.jpg" alt="">
      </div>
    </div>
  </section>

  <section id="course02">
    <div class="course-box course-box__reverse flex flex-row">
      <div class="course-box__info course-box__info-reverse flex justify-end items-center box-border w-1/2 px-12">
        <div class="course-box__inner max-w-[570px]">
          <h3 class="course-box__title mb-10 text-[2.1rem] font-bold">Community Board</h3>
          <p class="course-box__paragraph text-justify leading-relaxed"></p>
        </div>
      </div>
      <p class="course-box__img w-1/2 m-0">
        <img src="/images/index/notebook.jpg" alt="">
      </p>
    </div>
  </section>

  <section id="course03">
    <div class="course-box flex flex-row-reverse">
      <div class="course-box__info flex justify-start items-center box-border w-1/2 px-12">
        <div class="course-box__inner max-w-[570px]">
          <h3 class="course-box__title mb-10 text-[2.1rem] font-bold"></h3>
          <p class="course-box__paragraph text-justify leading-relaxed"></p>
        </div>
      </div>
      <p class="course-box__img w-1/2 m-0">
        <img src="" alt="">
      </p>
    </div>


 <!--news-->
 <section id="news">
    <div class="layout-news">
      <h2 class="text-3xl font-bold text-black text-center">News</h2>
      <div class="wrapper">
        <ul class="flex flex-wrap justify-between list-none p-5 mb-10 -ml-6">
          @foreach($latestBlogs as $blog)
            <li class="flex-1 max-w-1/3 box-border px-6 mb-6">
              <a href="{{ route('blogs.show', $blog->id) }}">
                <p class="mb-6">
                  <img src="{{ asset('storage/'. $blog->image) }}" alt="ブログ画像">
                </p>
                <div class="px-4 pt-6">
                  <h3 class="text-xl font-bold mb-6">{{ $blog->title }}</h3>
                  <p class="text-justify leading-relaxed mb-4">{{ Str::limit($blog->body, 100) }}</p>
                  <p class="text-gray-600">{{ $blog->updated_at->format('Y.m.d') }}</p>
                </div>
              </a>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="text-center">
        <a href="/blogs/index" class="block w-64 mx-auto py-5 bg-purple-500 text-white text-lg text-center mb-20">see more</a>
      </div>
    </div>
  </section>
  <!--//news-->
  </section>


@endsection