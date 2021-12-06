@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Campaigns
                    @auth
                        <a href="{{route('show_create')}}" class="btn btn-primary create-btn">Create campaign</a>
                    @endauth
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                            </symbol>
                        </svg>
                        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2"
                            width="24"
                            height="24"
                            role="img"
                            aria-label="Success:">
                                <use xlink:href="#check-circle-fill"/>
                            </svg>
                            <div>
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    @endif

                    @guest
                        <h5>Welcome to the advertising campaigns platform!</h5>
                        <p>Please register or log in to view or create campaigns</p>
                    @else
                        @if (sizeof($campaigns) > 0)
                        <table class="table table-bordered" aria-label="List of advertising campaigns">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total Budget</th>
                                    <th>Daily Budget</th>
                                    <th>Images</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $campaign)
                                    <tr>
                                        <td>{{$campaign->name}}</td>
                                        <td>{{\Carbon\Carbon::parse($campaign->from_date)->format('d M, Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($campaign->to_date)->format('d M, Y')}}</td>
                                        <td>{{number_format($campaign->total_budget, 2)}}</td>
                                        <td>{{number_format($campaign->daily_budget, 2)}}</td>
                                        <td><preview-button campaign_id="{{$campaign->id}}"></preview-button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <preview></preview>
                        @else
                            <p class="text-center">No advertising campaign has been created</p>
                        @endif
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
