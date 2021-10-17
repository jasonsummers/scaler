@if($clientNav)

	<ul>
		<li><a href="{{ URL::route('clients.view', $clientNav->id) }}">{{ $clientNav->name }}</a></li>

		@foreach($clientNav->contacts as $contact)

			<li><a href="{{ URL::route('clients.viewcontact', $contact->id) }}">{{ $contact->name }}</a></li>

		@endforeach

		<li><a href="{{ URL::route('clients.newcontact', $clientNav->id) }}">New Contact</a></li>
	</ul>

@endif