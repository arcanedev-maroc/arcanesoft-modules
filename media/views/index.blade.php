@extends(arcanesoft\foundation()->template())

@section('page-title')
    <i class="far fa-fw fa-images"></i> {{ __('Media') }}
@endsection

@section('content')
    <v-media-browser></v-media-browser>
    <v-media-manager></v-media-manager>
@endsection

@push('scripts')
@endpush
