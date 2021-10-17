@extends('layouts.auth_layout')

@section('title')
	Login
@endsection

@section('inlinecss')
<style type="text/css">


</style>

@endsection

@section('content')

	@include('notifications')
    
    <section class="loginform cf">
<img src="{{ asset('img/logo.jpg') }}" width="430" height="72"  alt=""/>
    <div id="Companydb">
      <h3><em><strong>Candidate Registration Form</strong></em></h3>
    </div><p>
<div id="Companyname">
<ul>
<li>
{{ Form::label('title_id', 'Title:') }}
{{ $candidate ? Form::select('title_id', $titlesLookup, $candidate->title_id) : Form::select('title_id', $titlesLookup) }}

{{ Form::label('first_name', 'First Name:') }}
{{ Form::text('first_name') }}
{{ $errors->first('first_name') }}

{{ Form::label('last_name', 'Last Name:') }}
{{ Form::text('last_name') }}
{{ $errors->first('last_name') }}

{{ Form::label('salutation', 'Salutation:') }}
{{ Form::text('salutation') }}
{{ $errors->first('salutation') }}
</li>
</ul>
</div>
{{ Form::label('headline', 'Headline:') }}
{{ Form::text('headline') }}
{{ $errors->first('headline') }}

{{ Form::label('dob', 'Date of Birth:') }}
{{ Form::text('dob') }}
{{ $errors->first('dob') }}

{{ Form::label('phone_home', 'Home Phone:') }}
{{ Form::text('phone_home') }}
{{ $errors->first('phone_home') }}

{{ Form::label('phone_work', 'Work Phone:') }}
{{ Form::text('phone_work') }}
{{ $errors->first('phone_work') }}

{{ Form::label('phone_mobile', 'Mobile Phone:') }}
{{ Form::text('phone_mobile') }}
{{ $errors->first('phone_mobile') }}

{{ Form::label('email_1', 'Email 1:') }}
{{ Form::text('email_1') }}
{{ $errors->first('email_1') }}

{{ Form::label('email_2', 'Email 2:') }}
{{ Form::text('email_2') }}
{{ $errors->first('email_2') }}

{{ Form::label('email_3', 'Email 3:') }}
{{ Form::text('email_3') }}
{{ $errors->first('email_3') }}

{{ Form::label('web_address', 'Web Address:') }}
{{ Form::text('web_address') }}
{{ $errors->first('web_address') }}

{{ Form::label('facebook_profile', 'Facebook Profile:') }}
{{ Form::text('facebook_profile') }}
{{ $errors->first('facebook_profile') }}

{{ Form::label('linkedin_profile', 'Linkedin Profile:') }}
{{ Form::text('linkedin_profile') }}
{{ $errors->first('linkedin_profile') }}

{{ Form::label('googleplus_profile', 'Google Plus Profile:') }}
{{ Form::text('googleplus_profile') }}
{{ $errors->first('googleplus_profile') }}

{{ Form::label('skype_name', 'Skype Name:') }}
{{ Form::text('skype_name') }}
{{ $errors->first('skype_name') }}

{{ Form::label('address', 'Address:') }}
{{ Form::text('address') }}
{{ $errors->first('address') }}

{{ Form::label('address_town', 'Town:') }}
{{ Form::text('address_town') }}
{{ $errors->first('address_town') }}

{{ Form::label('address_city', 'City:') }}
{{ Form::text('address_city') }}
{{ $errors->first('address_city') }}

{{ Form::label('address_county', 'County:') }}
{{ Form::text('address_county') }}
{{ $errors->first('address_county') }}

{{ Form::label('address_country_id', 'Country:') }}
{{ $candidate ? Form::select('address_country_id', $countriesLookup, $candidate->address_country_id) : Form::select('address_country_id', $countriesLookup) }}

{{ Form::label('address_postcode', 'Post Code:') }}
{{ Form::text('address_postcode') }}
{{ $errors->first('address_postcode') }}

{{ Form::label('currency_id', 'Currency:') }}
{{ $candidate ? Form::select('currency_id', $currenciesLookup, $candidate->currency_id) : Form::select('currency_id', $currenciesLookup) }}

{{ Form::label('moved_on', 'Moved On:') }}
{{ Form::text('moved_on') }}
{{ $errors->first('moved_on') }}

{{ Form::label('ni_number', 'NI Number:') }}
{{ Form::text('ni_number') }}
{{ $errors->first('ni_number') }}

{{ Form::label('education_id', 'Education:') }}
{{ $candidate ? Form::select('education_id', $educationLookup, $candidate->education_id) : Form::select('education_id', $educationLookup) }}

{{ Form::label('eligable_uk', 'Eligable UK:') }}
{{ $candidate ? Form::checkbox('eligable_uk', 'eligable_uk', $candidate->eligable_uk) : Form::checkbox('eligable_uk', 'eligable_uk') }}

{{ Form::label('eligable_europe', 'Eligable Europe:') }}
{{ $candidate ? Form::checkbox('eligable_europe', 'eligable_europe', $candidate->eligable_europe) : Form::checkbox('eligable_europe', 'eligable_europe') }}

{{ Form::label('curpos_title', 'Current Position:') }}
{{ Form::text('curpos_title') }}
{{ $errors->first('curpos_title') }}

{{ Form::label('curpos_employer', 'Current Employer:') }}
{{ Form::text('curpos_employer') }}
{{ $errors->first('curpos_employer') }}

{{ Form::label('curpos_devision', 'Current Devision:') }}
{{ Form::text('curpos_devision') }}
{{ $errors->first('curpos_devision') }}

{{ Form::label('curpos_notice', 'Notice Period:') }}
{{ Form::text('curpos_notice') }}
{{ $errors->first('curpos_notice') }}

{{ Form::label('despos_title', 'Desired Positon:') }}
{{ Form::text('despos_title') }}
{{ $errors->first('despos_title') }}

{{ Form::label('renum_perm', 'Permenant:') }}
{{ $candidate ? Form::checkbox('renum_perm', 'renum_perm', $candidate->renum_perm) : Form::checkbox('renum_perm', 'renum_perm') }}

{{ Form::label('renum_perm_ammt', 'at (£):') }}
{{ Form::text('renum_perm_ammt') }}
{{ $errors->first('renum_perm_ammt') }}

{{ Form::label('renum_self_emp', 'Self Employed:') }}
{{ $candidate ? Form::checkbox('renum_self_emp', 'renum_self_emp', $candidate->renum_self_emp) : Form::checkbox('renum_self_emp', 'renum_self_emp') }}

{{ Form::label('renum_self_emp_ammt', 'at (£):') }}
{{ Form::text('renum_self_emp_ammt') }}
{{ $errors->first('renum_self_emp_ammt') }}

{{ Form::label('renum_temp', 'Temporary:') }}
{{ $candidate ? Form::checkbox('renum_temp', 'renum_temp', $candidate->renum_temp) : Form::checkbox('renum_temp', 'renum_temp') }}

{{ Form::label('renum_temp_ammt', 'at (£):') }}
{{ Form::text('renum_temp_ammt') }}
{{ $errors->first('renum_temp_ammt') }}

{{ Form::label('renum_cont', 'Contract:') }}
{{ $candidate ? Form::checkbox('renum_cont', 'renum_cont', $candidate->renum_cont) : Form::checkbox('renum_cont', 'renum_cont') }}

{{ Form::label('renum_cont_ammt', 'at (£):') }}
{{ Form::text('renum_cont_ammt') }}
{{ $errors->first('renum_cont_ammt') }}

{{ Form::label('available', 'Available:') }}
{{ Form::text('available') }}
{{ $errors->first('available') }}

{{ Form::label('will_relocate', 'Will Relocate:') }}
{{ $candidate ? Form::checkbox('will_relocate', 'will_relocate', $candidate->will_relocate) : Form::checkbox('will_relocate', 'will_relocate') }}

{{ Form::label('commute_distance', 'Commute Distance:') }}
{{ Form::text('commute_distance') }}
{{ $errors->first('commute_distance') }}

{{ Form::label('commute_from_postcode', 'Commute From (if different from Address Postcode):') }}
{{ Form::text('commute_from_postcode') }}
{{ $errors->first('commute_from_postcode') }}

{{ Form::label('priority_id', 'Priority:') }}
{{ $candidate ? Form::select('priority_id', $prioritiesLookup, $candidate->priority_id) : Form::select('priority_id', $prioritiesLookup) }}

{{ Form::label('primary_user', 'Owner:') }}
{{ $candidate ? Form::select('primary_user', $usersLookup, $candidate->primary_user) : Form::select('primary_user', $usersLookup) }}

{{ Form::label('our_ref', 'Our Ref:') }}
{{ Form::text('our_ref') }}
{{ $errors->first('our_ref') }}

{{ Form::label('last_contact', 'Last Contact:') }}
{{ Form::text('last_contact') }}
{{ $errors->first('last_contact') }}

{{ Form::label('next_contact', 'Next Contact:') }}
{{ Form::text('next_contact') }}
{{ $errors->first('next_contact') }}

<script type="text/javascript" src="{{ asset('js/candidateform.js') }}"></script>