@section('inlinecss')
<style type="text/css">
#previousNotes
{
	width:92%;
}

.note
{
	font-size:10px;
	border-bottom:1px solid rgba(0, 0, 0, 0.3);
}

.note p
{
	margin: 3px;
}

.noteHeader
{
	font-weight:bold;
	font-size:12px;
}
</style>
@endsection

<div id="notes" class="loginform">

	<div id="newNote">

		{{ Form::open(array('route' => 'notes.save')) }}

			{{ Form::textarea('note') }}

			{{ Form::hidden('parent_object', $noteSettings->parent_object) }}
			{{ Form::hidden('parent_id', $noteSettings->parent_id) }}
			{{ Form::hidden('redirect_url', $noteSettings->redirectUrl) }}

			{{ Form::token() }}

			{{ Form::Submit('Save Note') }}

		{{ Form::close()}}

		<script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/noteform.js') }}"></script>

	</div>

	<div id="previousNotes" class="loginform">

		@foreach($notes as $note)
			<div class="note">
				<div class="noteHeader">
					Note Posted On {{ $note->created_at }} by {{ $note->lastChangedByUser->name }}
				</div>
				{{ $note->note }}
			</div>
		@endforeach

	</div>

</div>