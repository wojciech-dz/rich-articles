<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin`s Dashboard') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-red-500">
                {{ __("You're logged in with admin privileges, please be careful!") }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <x-users-admin :users="$users" :action_icons="$users_icons" />
            </div>
            <div>
                <x-articles :articles="$articles" :action_icons="$articles_icons" />
            </div>
        </div>
    </div>

    <x-bladewind::modal
        name="toggle-admin"
        type="error" title="{{ __('dashboard.confirm_toggle_admin') }}">
        {{ __('dashboard.toggle_admin_question') }}
        '<b class="name"></b>'?
    </x-bladewind::modal>

    <x-bladewind::modal
        name="delete-user"
        type="error" title="{{ __('dashboard.confirm_user_delete') }}">
        {{ __('dashboard.delete_user_question-1') }}
        '<b class="name"></b>'
        {{ __('dashboard.delete_user_question-2') }}
    </x-bladewind::modal>

    <x-bladewind::modal
        name="delete-article"
        type="error" title="{{ __('dashboard.confirm_article_delete') }}">
        {{ __('dashboard.delete_article_question-1') }}
        '<b class="title"></b>'
        {{ __('dashboard.delete_article_question-2') }}
    </x-bladewind::modal>

    <script>
        toggleAdmin = (id, name) => {
            console.log(id, name);
            showModal('toggle-admin');
            domEl('.bw-toggle-admin .name').innerText = `${name}`;
        }

        deleteUser = (id, name) => {
            console.log(id, name);
            showModal('delete-user');
            domEl('.bw-delete-user .name').innerText = `${name}`;
        }

        deleteArticle = (id, title) => {
            console.log(id, title);
            showModal('delete-article');
            domEl('.bw-delete-article .title').innerText = `${title}`;
        }

        redirect = (url) => {
            window.open(url);
        }
    </script>
</x-app-layout>
