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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        toggleAdmin = (id, name) => {
            const question = "{{ __('dashboard.toggle_admin_question') }}" + name;
            const userResponse = confirm(question);
            if (userResponse) {
                saveProfileAjax(id);
                // domEl('.bw-toggle-admin .name').innerText = `${name}`;
            }
            // showModal('toggle-admin');
        }

        deleteUser = (id, name) => {
            // showModal('delete-user');
            const question = "{{ __('dashboard.delete_user_question-1') }}"
                + name
                + "{{ __('dashboard.delete_user_question-2') }}";
            const userResponse = confirm(question);
            if (userResponse) {
                deleteProfileAjax(id);
                // domEl('.bw-delete-user .name').innerText = `${name}`;
            }
        }

        deleteArticle = (id, title) => {
            console.log(id, title);
            showModal('delete-article');
            domEl('.bw-delete-article .title').innerText = `${title}`;
        }

        redirect = (url) => {
            window.open(url);
        }

        saveProfileAjax = (id) => {
            var token = document.querySelector('meta[name="csrf-token"]').content,
                url = "/profile/toggle-admin",
                method = 'POST',
                params = {"id": id};
            if (validateForm('.profile-form-ajax')){
                // unhide('.status-updating');
                // hide('.profile-form-ajax');
                // hideModalActionButtons('form-mode-ajax');
                makeAjaxCall(url, method, token, params);
            } else {
                return false;
            }
        }

        deleteProfileAjax = (id) => {
            var token = document.querySelector('meta[name="csrf-token"]').content,
                url = "/profile/user-delete",
                method = 'DELETE',
                params = {"id": id};
            if (validateForm('.profile-form-ajax')){
                // unhide('.status-updating');
                // hide('.profile-form-ajax');
                // hideModalActionButtons('form-mode-ajax');
                makeAjaxCall(url, method, token, params);
            } else {
                return false;
            }
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
