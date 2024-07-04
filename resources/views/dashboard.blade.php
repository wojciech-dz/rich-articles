
<x-app-layout>
    <x-slot name="header">
        <x-bladewind::notification />
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
                    <input name="meat" id="article_contents" type="hidden" value="">
                </div>

                <div>
                    <x-bladewind::textarea
                        id="contents_editor"
                        name="contents_editor"
                        required="true"
                        placeholder="{{ __('dashboard.new_article') }}"
                        toolbar="true"
                    />
                </div>

                <div class="text-center">
                    <x-bladewind::button
                        name="btn-save"
                        id="btn-save"
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
    <style>
        #contents_editor {
            background-color: white;
            color: black;
        }
    </style>

    <x-bladewind::modal
        name="delete-article"
        type="error" title="{{ __('dashboard.confirm_article_delete') }}">
        {{ __('dashboard.delete_article_question-1') }}
        '<b class="title"></b>'
        {{ __('dashboard.delete_article_question-2') }}
    </x-bladewind::modal>


    <script>
        const submitButton = document.querySelector('#btn-save');
        submitButton.addEventListener('click', function () {
            article_contents.value = quill_contents_editor.root.innerHTML
        });

        deleteArticle = (id, title) => {
            const question = "{{ __('dashboard.delete_article_question-1') }}"
                + title
                + "{{ __('dashboard.delete_article_question-2') }}";
            const userResponse = confirm(question);
            if (userResponse) {
                deleteArticleAjax(id);
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
                    showNotification('Akcja wykonana', 'Artykuł został usunięty.');
                }
            });
        }
    </script>
</x-app-layout>
