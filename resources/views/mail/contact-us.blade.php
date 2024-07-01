<header>
    On {{ date("d/m/Y H:i:s") }} user {{ $first_name }} {{ $last_name }} &lt;{{ $email }}&gt; sent following message:
</header>
<div>
    {{ $user_message }}
</div>
