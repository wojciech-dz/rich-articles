<div>
    <x-bladewind::textarea
        label="{{ __('dashboard.article_contents') }}"
        placeholder="{{ __('dashboard.new_article') }}"
        required="true"
        id="contents"
        name="contents"
        error_message="{{ __('dashboard.fill_article_contents') }}"
        show_error_inline="true"
    />
</div>
