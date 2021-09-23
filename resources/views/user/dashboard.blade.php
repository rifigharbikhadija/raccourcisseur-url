@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
       {{ session()->get('message') }}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-12">
                    <h2>{{ __('My Links') }}</h2>
                    <table class="table">
                        <thead class="bg-secondary">
                            <tr class="border-top-0 text-light">
                                <td>{{ __('Url') }}</td>
                                <td>{{ __('Shorten Link') }}</td>
                                <td>{{ __('Visitors') }}</td>
                                <td>{{ __('Created At') }}</td>
                                <td >{{ __('Action') }}</td>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td><a href="{{ url($link->hash) }}">{{ url($link->hash) }}</a></td>
                                    <td>{{ $link->visitors_count }}</td>
                                    <td>{{ $link->created_at->diffForHumans() }}</td>
                                    <td class="">
                                        <a href="{{ url("links/{$link->id}") }}">{{ __('Show') }}</a>
                                        <a href="{{ url("delete-link/{$link->id}") }}" class="text-danger">{{ __('Delete') }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No links yet!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $links->links() }}
    </div>
</div>
@endsection
