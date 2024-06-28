@props(['users', 'action_icons'])

<x-bladewind::table
    compact="true"
    no_data_message="There are no users in this system."
    exclude_columns="email_verified_at, created_at, updated_at, password, remember_token"
    :data="json_decode(json_encode($users->items()), true)"
    :action_icons="$action_icons"
/>

{{ $users->links() }}
