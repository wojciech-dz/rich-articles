<x-app-layout>
    <x-slot name="header">
        <x-bladewind::notification />
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
        backdrop_can_close="false"
        name="old-toggle-admin"
        type="warning"
        ok_button_action="saveProfileAjax()"
        ok_button_label="Update"
        close_after_action="false"
        title="{{ __('dashboard.confirm_toggle_admin') }}"
    >

        {{ __('dashboard.toggle_admin_question') }}
        '<b class="name"></b>'?

        <x-bladewind::processing
            name="status-updating"
            message="Updating user status." />

        <x-bladewind::process-complete
            name="profile-update-yes"
            process_completed_as="passed"
            button_label="Done"
            button_action="hideModal('form-mode-ajax')"
            message="Status updated successfully." />
    </x-bladewind::modal>

    <x-bladewind::modal
        name="toggle-admin"
        type="warning"
        title="{{ __('ddashboard.confirm_toggle_admin') }}"
    >
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
        sendMessage = (id) => {
            $.ajax({
                method: 'POST',
                url: "/admindashboard/send-notification",
                data: {
                    "_token": document.querySelector('meta[name="csrf-token"]').content,
                    "params": {'id': id}
                },
                datatype: 'json',
                success: function(result) {
                    console.log('powiadomienie wysłane')
                    showNotification('Wysłano', 'Powiadomienie wysłane do użytkownika');
                }
            });
        }

        toggleAdmin = (id, name) => {
            const question = "{{ __('dashboard.toggle_admin_question') }}" + name;
            const userResponse = confirm(question);
            if (userResponse) {
                saveProfileAjax(id);
            }
        }

        deleteUser = (id, name) => {
            const question = "{{ __('dashboard.delete_user_question-1') }}"
                + name
                + "{{ __('dashboard.delete_user_question-2') }}";
            const userResponse = confirm(question);
            if (userResponse) {
                deleteProfileAjax(id);
            }
        }

        deleteArticle = (id, title) => {
            const question = "{{ __('dashboard.delete_article_question-1') }}"
                + title
                + "{{ __('dashboard.delete_article_question-2') }}";
            const userResponse = confirm(question);
            if (userResponse) {
                deleteArticleAjax(id);
            }
        }

        redirect = (url) => {
            window.open(url);
        }

        saveProfileAjax = (id) => {
            var token = document.querySelector('meta[name="csrf-token"]').content,
                url = "/profile/toggle-admin",
                method = 'POST',
                params = {"id": id};
            makeAjaxCall(url, method, token, params);
        }

        deleteProfileAjax = (id) => {
            var token = document.querySelector('meta[name="csrf-token"]').content,
                url = "/profile/user-delete",
                method = 'DELETE',
                params = {"id": id};
            makeAjaxCall(url, method, token, params);
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
                    showNotification('Akcja wykonana', 'Element został zmieniony');
                }
            });
        }
    </script>
</x-app-layout>
