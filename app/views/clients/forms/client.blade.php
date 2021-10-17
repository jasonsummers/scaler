<img src="{{ asset('img/logo.jpg') }}" width="430" height="72"  alt=""/>
    <div id="Companydb">
      	<h3><em><strong>Client Registration Form</strong></em></h3>
    </div>

<div id="Companyname">
	<ul>
		<li>
			{{ Form::label('name', 'Company Name:') }}
			{{ Form::text('name') }}
			{{ $errors->first('name') }}
		</li>
	</ul>
</div>
<ul>
<li>
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
{{ $client ? Form::select('address_country_id', $countriesLookup, $client->address_country_id) : Form::select('address_country_id', $countriesLookup) }}

{{ Form::label('address_postcode', 'Post Code:') }}
{{ Form::text('address_postcode') }}
{{ $errors->first('address_postcode') }}
</li>
</ul>
<ul>
<li>
{{ Form::label('telephone_main', 'Main Tel:') }}
{{ Form::text('telephone_main') }}
{{ $errors->first('telephone_main') }}

{{ Form::label('fax_main', 'Main Fax:') }}
{{ Form::text('fax_main') }}
{{ $errors->first('fax_main') }}

{{ Form::label('website_1', 'Website:') }}
{{ Form::text('website_1') }}
{{ $errors->first('website_1') }}

{{ Form::label('website_2', 'Alt Website 1:') }}
{{ Form::text('website_2') }}
{{ $errors->first('website_2') }}

{{ Form::label('website_3', 'Alt Website 2:') }}
{{ Form::text('website_3') }}
{{ $errors->first('website_3') }}

{{ Form::label('industry_id', 'Industry:') }}
{{ $client ? Form::select('industry_id', $industriesLookup, $client->industry_id) : Form::select('industry_id', $industriesLookup) }}
</li>
</ul>
<ul>
<li>
{{ Form::label('vacancy_value', 'Vacancy Value:') }}
{{ Form::text('vacancy_value') }}
{{ $errors->first('vacancy_value') }}

{{ Form::label('placement_value', 'Placement Value:') }}
{{ Form::text('placement_value') }}
{{ $errors->first('placement_value') }}
</li>
</ul>
<p></p>
<ul>
<li>
//TODO:: add in logo upload.

{{ Form::label('priority_id', 'Priority:') }}
{{ $client ? Form::select('priority_id', $prioritiesLookup, $client->priority_id) : Form::select('priority_id', $prioritiesLookup) }}

{{ Form::label('primary_user', 'Owner:') }}
{{ $client ? Form::select('primary_user', $usersLookup, $client->primary_user) : Form::select('primary_user', $usersLookup) }}
</li>
</ul>