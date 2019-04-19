@extends('layouts.app')

@section('content')
    <div class="container" id="app"></div>
@endsection
@push('scripts')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush
