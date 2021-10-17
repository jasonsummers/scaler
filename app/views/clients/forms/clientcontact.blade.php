@section('inlinecss')

<style type="text/css">
#Companydb
{
	font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	color: #999;
	font-size: 15pt;
}
</style>

@endsection

{{ Form::label('title_id', 'Title:') }}
{{ $contact ? Form::select('title_id', $titlesLookup, $contact->title_id) : Form::select('title_id', $titlesLookup) }}

{{ Form::label('first_name', 'First Name:') }}
{{ Form::text('first_name') }}
{{ $errors->first('first_name') }}

{{ Form::label('last_name', 'Late Name:') }}
{{ Form::text('last_name') }}
{{ $errors->first('last_name') }}

{{ Form::label('salutation', 'Salutation:') }}
{{ Form::text('salutation') }}
{{ $errors->first('salutation') }}

{{ Form::label('job_title', 'Job Title:') }}
{{ Form::text('job_title') }}
{{ $errors->first('job_title') }}

{{ Form::label('linkedin_profile', 'Linkedin Profile:') }}
{{ Form::text('linkedin_profile') }}
{{ $errors->first('linkedin_profile') }}

{{ Form::label('facebook_profile', 'Facebook Profile:') }}
{{ Form::text('facebook_profile') }}
{{ $errors->first('facebook_profile') }}

{{ Form::label('phone_mobile', 'Mobile Number:') }}
{{ Form::text('phone_mobile') }}
{{ $errors->first('phone_mobile') }}

{{ Form::label('phone_work', 'Work Number:') }}
{{ Form::text('phone_work') }}
{{ $errors->first('phone_work') }}

{{ Form::label('email_1', 'Email 1:') }}
{{ Form::text('email_1') }}
{{ $errors->first('email_1') }}

{{ Form::label('email_2', 'Email 2:') }}
{{ Form::text('email_2') }}
{{ $errors->first('email_2') }}

{{ Form::label('email_3', 'Email 3:') }}
{{ Form::text('email_3') }}
{{ $errors->first('email_3') }}

{{ Form::label('skype_name', 'Skype Name:') }}
{{ Form::text('skype_name') }}
{{ $errors->first('skype_name') }}

{{ Form::label('twitter', 'Twitter:') }}
{{ Form::text('twitter') }}
{{ $errors->first('twitter') }}

{{ Form::label('priority_id', 'Priority:') }}
{{ $contact ? Form::select('priority_id', $prioritiesLookup, $contact->priority_id) : Form::select('priority_id', $prioritiesLookup) }}

{{ Form::label('primary_user', 'Owner:') }}
{{ $contact ? Form::select('primary_user', $usersLookup, $contact->primary_user) : Form::select('primary_user', $usersLookup) }}

{{ Form::label('last_contact', 'Last Contact:') }}
{{ Form::text('last_contact') }}
{{ $errors->first('last_contact') }}

{{ Form::label('next_contact', 'Next Contact:') }}
{{ Form::text('next_contact') }}
{{ $errors->first('next_contact') }}

{{ Form::label('vacancy_value', 'Vacancy Value:') }}
{{ Form::text('vacancy_value') }}
{{ $errors->first('vacancy_value') }}

{{ Form::label('placement_value', 'Placement Value:') }}
{{ Form::text('placement_value') }}
{{ $errors->first('placement_value') }}

<script type="text/javascript" src="{{ asset('js/clientcontactform.js') }}"></script>
