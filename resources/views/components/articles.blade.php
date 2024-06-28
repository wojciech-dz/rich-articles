@props(['articles', 'action_icons'])

<x-bladewind::table
    compact="true"
    no_data_message="User has no articles yet."
    exclude_columns="author_id"
    :data="json_decode(json_encode($articles->items()), true)"
    :action_icons="$action_icons"
/>

{{ $articles->links() }}
