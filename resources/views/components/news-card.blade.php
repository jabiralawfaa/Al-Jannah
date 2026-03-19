@props(['image', 'tags', 'title', 'url', 'visible' => false])

<article class="news-card" data-visible="{{ $visible ? 'true' : 'false' }}">
    <div class="news-card-image">
        <img src="{{ $image }}" alt="{{ $title }}">
    </div>
    <div class="news-card-content">
        <div class="news-card-tags">
            @foreach($tags as $tag)
                <span class="news-card-tag">{{ $tag }}</span>
            @endforeach
        </div>
        <h3 class="news-card-title">{{ $title }}</h3>
        <a href="{{ $url }}" class="news-card-button">
            Lihat Berita
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
    </div>
</article>

<style>
    .news-card {
        background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3);
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(22, 66, 60, 0.5);
    }

    .news-card-image {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .news-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .news-card:hover .news-card-image img {
        transform: scale(1.05);
    }

    .news-card-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        flex: 1;
    }

    .news-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .news-card-tag {
        font-family: "Poppins", sans-serif;
        font-size: 0.75rem;
        font-weight: 600;
        color: #16423C;
        background-color: #ffffff;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .news-card-title {
        font-family: "Poppins", sans-serif;
        font-size: 1.125rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.5;
        margin: 0;
        flex: 1;
    }

    .news-card-button {
        font-family: "Poppins", sans-serif;
        font-size: 0.875rem;
        font-weight: 600;
        color: #16423C;
        background-color: #ffffff;
        padding: 0.625rem 1.25rem;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        align-self: flex-start;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .news-card-button:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .news-card-button svg {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .news-card-button:hover svg {
        transform: translateX(3px);
    }

    @media (max-width: 768px) {
        .news-card-image {
            height: 180px;
        }

        .news-card-title {
            font-size: 1rem;
        }

        .news-card-button {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
        }
    }
</style>
