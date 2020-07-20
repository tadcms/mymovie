<div class="halim-item">
    @php
        $genres = $item->getGenres();
        $countries = $item->getCountries();

        $genre_str = '';
        foreach ($genres as $genre) {
            $genre_str .= '<span class=category-name>'. $genre->name .'</span>';
        }

        $country_str = '';
        foreach ($countries as $country) {
            $country_str .= '<span class=category-name>'. $country->name .'</span>';
        }
    @endphp
        <a class="halim-thumb" href="{{ route('watch', ['slug' => $item->slug]) }}" title="{{ $item->name }}{{ $item->other_name ? ' - ' . $item->other_name : '' }}">
            <figure>
                <img class="lazyload blur-up img-responsive" data-sizes="auto" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ $item->getThumbnail() }}" alt="{{ $item->name }}{{ $item->other_name ? ' - ' . $item->other_name : '' }}" title="{{ $item->name }}{{ $item->other_name ? ' - ' . $item->other_name : '' }}">
            </figure>
            <span class="status">{{ $item->video_quality }}</span>
            <span class="episode">Tập 3</span>
            <div class="icon_overlay" data-html="true"
                 data-toggle="halim-popover"
                 data-placement="top"
                 data-trigger="hover"
                 title="<span class=film-title>{{ $item->name }}</span>"
                 data-content="<div class=org-title>{{ $item->other_name }} ({{ $item->year }})</div>                            <div class=film-meta>
                                
                                <div class=film-content>{{ $item->short_description }}</div>
                                <p class=category>@lang('app.countries'): {{ $country_str }}</p>                                <p class=category>@lang('app.genres'): {{ $genre_str }}</p>
                            </div>">
            </div>

            <div class="halim-post-title-box">
                <div class="halim-post-title ">
                    <h2 class="entry-title">{{ $item->name }}</h2><p class="original_title">{{ $item->other_name }} ({{ $item->year }})</p>
                </div>
            </div>
        </a>
    </div>