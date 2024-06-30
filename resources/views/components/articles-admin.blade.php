@props(['articles', 'action_icons'])

<x-bladewind::table
    compact="true"
    no_data_message="There are no articles yet."
    :data="json_decode(json_encode($articles->items()), true)"
    :action_icons="$action_icons"
/>

{{ $articles->links() }}
