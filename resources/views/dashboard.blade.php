<x-bladewind::notification />

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('dashboard.dashboard') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __('dashboard.login_success') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <x-articles :articles="$articles" :action_icons="$action_icons" />
            </div>

            <form method="POST" action="{{ route('article.create') }}">

                <h1 class="my-2 text-2xl font-light text-blue-900/80">{{ __('dashboard.new_article') }}</h1>

                <div>
                    <x-bladewind::input type="text" label="{{ __('dashboard.article_title') }}" required="true"  />
                </div>

                <div>
                    <x-texteditor />
                </div>

                <div class="text-center">
                    <x-bladewind::button
                        name="btn-save"
                        has_spinner="true"
                        type="primary"
                        outline="true"
                        border_width="2"
                        can_submit="true"
                        class="mt-3">
                        {{ __('dashboard.publish') }}
                    </x-bladewind::button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
