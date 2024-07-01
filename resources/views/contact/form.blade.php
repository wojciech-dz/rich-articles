<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('mail.contact-us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="POST" action="{{ route('contact.send') }}" class="mt-6 space-y-6">
                        @csrf

                        <h1 class="my-2 text-2xl font-light text-blue-900/80">{{ __('mail.contact-us') }}</h1>

                        <div>
                            <x-bladewind::input
                                id="first_name"
                                name="first_name"
                                type="text"
                                label="{{ __('mail.first_name') }}"
                                placeholder="{{ __('mail.first_name') }}"
                                required="true"
                                show_error_inline="true"
                            />
                        </div>

                        <div>
                            <x-bladewind::input
                                id="last_name"
                                name="last_name"
                                type="text"
                                label="{{ __('mail.last_name') }}"
                                placeholder="{{ __('mail.last_name') }}"
                                required="true"
                                show_error_inline="true"
                            />
                        </div>

                        <div>
                            <x-bladewind::input
                                id="email"
                                name="email"
                                type="text"
                                label="{{ __('mail.email') }}"
                                placeholder="{{ __('mail.email') }}"
                                required="true"
                                show_error_inline="true"
                            />
                        </div>

                        <div>
                            <x-bladewind::textarea
                                id="message"
                                name="message"
                                rows="5"
                                required="true"
                                label="{{ __('mail.message') }}"
                                placeholder="{{ __('mail.message') }}"
{{--                                toolbar="true"--}}
{{--                                except="underline, align, indent, link, color, background, list, image, blockquote, code-block, clean"--}}
                                error_message="{{ __('mail.fill_message') }}"
                                show_error_inline="true"
                            />
                        </div>

                        <div class="text-center">
                            <x-bladewind::button
                                name="btn-send"
                                has_spinner="true"
                                type="primary"
                                outline="true"
                                border_width="2"
                                can_submit="true"
                                class="mt-3"
                            >
                                {{ __('mail.send') }}
                            </x-bladewind::button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
