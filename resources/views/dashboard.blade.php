@extends('layouts.app')

@section('title', 'View My Submissions')

@section('content')

<h3 class="text-center">My Submissions</h3><br />

<div class="container">
    @component('components.submission_card_grid', ['submissions' => $submissions]) @endcomponent
</div>
@endsection
