@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                    <h2>{{ __('Links Detail') }}</h2>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="bg-secondary text-light">{{ __('URL') }}</td>
                                    <td>{{ $link->url }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-secondary text-light">{{ __('Shorten Link') }}</td>
                                    <td>{{ secure_url($link->hash) }}</td>
                                </tr>
                                <tr>
                                    <td class="bg-secondary text-light">{{ __('Created') }}</td>
                                    <td>{{ $link->created_at->diffForHumans() }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h2>{{ __('Visitors') }}</h2>
                        <table class="table">
                            <thead class="bg-secondary text-light">
                            <tr>
                                <td>{{ __('Visitor ID') }}</td>
                                <td>{{ __('IP') }}</td>
                                <td>{{ __('Browser') }}</td>
                                <td>{{ __('Country') }}</td>
                                <td>{{ __('Visited') }}</td>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse ($visitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->user_id }}</td>
                                    <td>{{ $visitor->ip }}</td>
                                    <td>{{ $visitor->browser }}</td>
                                    <td>{{ $visitor->country }}</td>
                                    <td>{{ $visitor->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No visitor yet!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        {{ $visitors->links() }}
            </div>
        </div>
    </div>
@endsection
