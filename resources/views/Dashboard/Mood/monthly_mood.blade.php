@extends('Dashboard.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Your Mood History</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <a href="{{ route('mood.pdf') }}" class="btn btn-primary btn-icon-text mb-3 mb-md-0">
                <i data-feather="download"></i>
                Download Mood Report
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow justify-content-center">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-baseline mb-2">
                                <h6 class="card-title  mb-20">This Month's Mood List</h6>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0 ">
                                    <thead>
                                        <tr>
                                            <th class="pt-0">You's Mood</th>
                                            <th class="pt-0">Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($moodCounts as $mood => $count)
                                            <tr>
                                                <td>{{ $mood }}</td>
                                                <td><span class="badge badge-danger">{{ $count }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                                <div class="alert alert-info text-center">
                                    ★ <strong>Mood Of The Last 30 Days</strong> ★<br>
                                    <strong>{{ $moodOfMonth }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
