<header class="inner-header">
    <a href="/" class="logo">
        <span class="brand-lief">{{ $content['navbar']['brandName'] }}</span>
        <span class="brand-market">{{ $content['navbar']['brandSub'] }}</span>
    </a>
    <nav class="inner-nav">
        @foreach ($menuLinks as $link)
            <a
                href="{{ $link['href'] }}"
                class="{{ request()->is(trim($link['href'], '/') ?: '/') ? 'active' : '' }}"
            >{{ $link['label'] }}</a>
        @endforeach
    </nav>
    <a href="/" class="back-home">← BERANDA</a>
</header>
