<h2>{{ __('mail.dear') }} {{ $userName }}</h2>

<div>
    @if ($articleTitle == '' )
        {{ __("mail.write-some-article") }}
    @else
        {{ __("mail.article-you-wrote-1") }} <b>{{ $articleTitle }}</b> {{ __("mail.article-you-wrote-2") }}
    @endif

        {{ __("mail.regards") }}
</div>

