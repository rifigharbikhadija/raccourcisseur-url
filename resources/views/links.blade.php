@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h2>{{ __('All Links') }}</h2>

                        <table class="table">
                            <thead class="bg-secondary text-light">
                            <tr>
                                <td>{{ __('Url') }}</td>
                                <td>{{ __('Shorten Link') }}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($links as $link)
                                <tr>
                                    <td>{{ $link->url }}</td>
                                    <td><a href="{{ url($link->hash) }}">{{ url($link->hash) }}</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No links yet!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $links->links() }}

            </div>
        </div>
    </div>
@endsection
