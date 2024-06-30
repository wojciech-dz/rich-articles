
<x-app-layout>
    <x-slot name="header">
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('dashboard.dashboard') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __('dashboard.login_success') }}
            </div>
        </div>
    </x-slot>

    <x-bladewind::notification />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <x-articles :articles="$articles" :action_icons="$action_icons" />
            </div>

            <form method="POST" action="{{ route('article.store') }}">
                @csrf

                <h1 class="my-2 text-2xl font-light text-blue-900/80">{{ __('dashboard.new_article') }}</h1>

                <div>
                    <x-bladewind::input
                        id="title"
                        name="title"
                        type="text"
                        label="{{ __('dashboard.article_title') }}"
                        placeholder="{{ __('dashboard.article_title') }}"
                        required="true"
                        show_error_inline="true"
                    />
                </div>

                <div>
                    <x-bladewind::textarea
                        id="meat"
                        name="meat"
                        rows="5"
                        required="true"
                        label="{{ __('dashboard.article_contents') }}"
                        placeholder="{{ __('dashboard.new_article') }}"
                        {{--                        toolbar="true"--}}
                        {{--                        except="underline, align, indent, link, color, background, list, image, blockquote, code-block, clean"--}}
                        error_message="{{ __('dashboard.fill_article_contents') }}"
                        show_error_inline="true"
                    />
                </div>

                <div class="text-center">
                    <x-bladewind::button
                        name="btn-save"
                        has_spinner="true"
                        type="primary"
                        outline="true"
                        border_width="2"
                        can_submit="true"
                        class="mt-3"
                    >
                        {{ __('dashboard.publish') }}
                    </x-bladewind::button>
                </div>

            </form>
        </div>
    </div>

    <x-bladewind::modal
        name="delete-article"
        type="error" title="{{ __('dashboard.confirm_article_delete') }}">
        {{ __('dashboard.delete_article_question-1') }}
        '<b class="title"></b>'
        {{ __('dashboard.delete_article_question-2') }}
    </x-bladewind::modal>


    <script>
        deleteArticle = (id, title) => {
            const question = "{{ __('dashboard.delete_article_question-1') }}"
                + title
                + "{{ __('dashboard.delete_article_question-2') }}";
            const userResponse = confirm(question);
            if (userResponse) {
                deleteArticleAjax(id);
                // domEl('.bw-delete-article .title').innerText = `${title}`;
            }
        }

        deleteArticleAjax = (id) => {
            var token = document.querySelector('meta[name="csrf-token"]').content,
                url = "/article/delete",
                method = 'DELETE',
                params = {"id": id};
            makeAjaxCall(url, method, token, params);
        }

        makeAjaxCall = (url, method, token, params) => {
            $.ajax({
                method: method,
                url: url,
                data: {"_token": token, "params": params},
                datatype: 'json',
                success: function(result) {
                    hide('.status-updating');
                    unhide('.profile-update-yes')
                }
            });
        }
    </script>
</x-app-layout>
