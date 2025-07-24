@extends('app')

@section('body')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">

    <!-- Stores Section -->
    <section class="news-stores-section">
        <div class="news-container">
            <h2 class="news-section-title">Tất cả bài viết</h2>

            <div class="news-articles-grid">
                <!-- Article 1 -->

                @foreach ($news_all as $item)
                    <a style="text-decoration: none" class="news-article-card" href="new_detail/{{ $item->id }}">
                        <span class="news-article-badge"><i class="fa-solid fa-eye"></i> {{ $item->views }}</span>
                        <div class="news-article-image">
                            <img src="{{ asset('img/' . $item->image) }}" alt="Ảnh {{ $item->id }}">
                        </div>
                        <div class="news-article-content">
                            <span class="news-article-category">{{ $item->new_category->name }}</span>
                            <h3 class="news-article-title">{{ $item->title }}</h3>
                            <p class="news-article-excerpt">{{ $item->description }}</p>
                            <div class="news-article-meta">
                                <div class="news-meta-item">
                                    <i class="far fa-user"></i>
                                    <span>{{ $item->author }}</span>
                                </div>
                                <div class="news-meta-item">
                                    <i class="far fa-calendar"></i>
                                    <span>{{ $item->posted_date }}</span>
                                </div>
                                <div class="news-meta-item">
                                    {{-- <i class="fa-solid fa-eye"></i> --}}
                                    {{-- <span>{{ $item->views }}</span> --}}
                                </div>

                            </div>
                        </div>
                    </a>
                @endforeach

                {{-- Hiển thị nút phân trang --}}
                <div class="chuyentrang">
                    {{ $news_all->links('pagination') }}
                </div>



            </div>
        </div>
    </section>
@endsection
