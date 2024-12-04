@extends('layouts.home')

@section('content')
    @if(isset($searchResults))
        @include('layouts.search-page')
    @elseif(isset($documentResults))
        @include('layouts.document-info')
    @endif
@endsection