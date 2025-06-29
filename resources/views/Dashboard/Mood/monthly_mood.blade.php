@extends('Dashboard.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Your Mood History</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary btn-icon-text mb-3 mb-md-0" data-toggle="modal"
                data-target="#exampleModal">
                <i data-feather="download"></i>
                Download Mood Report
            </button>
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
                                        {{-- <tr>
                                            <td>2</td>
                                            <td>NobleUI Angular</td>
                                            <td>01/01/2021</td>
                                            <td>26/04/2021</td>
                                            <td><span class="badge badge-success">Review</span></td>
                                            <td>Carl Henson</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>NobleUI ReactJs</td>
                                            <td>01/05/2021</td>
                                            <td>10/09/2021</td>
                                            <td><span class="badge badge-info-muted">Pending</span></td>
                                            <td>Jensen Combs</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>NobleUI VueJs</td>
                                            <td>01/01/2021</td>
                                            <td>31/11/2021</td>
                                            <td><span class="badge badge-warning">Work in Progress</span>
                                            </td>
                                            <td>Amiah Burton</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>NobleUI Laravel</td>
                                            <td>01/01/2021</td>
                                            <td>31/12/2021</td>
                                            <td><span class="badge badge-danger-muted text-white">Coming soon</span></td>
                                            <td>Yaretzi Mayo</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>NobleUI NodeJs</td>
                                            <td>01/01/2021</td>
                                            <td>31/12/2021</td>
                                            <td><span class="badge badge-primary">Coming soon</span></td>
                                            <td>Carl Henson</td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom">3</td>
                                            <td class="border-bottom">NobleUI EmberJs</td>
                                            <td class="border-bottom">01/05/2021</td>
                                            <td class="border-bottom">10/11/2021</td>
                                            <td class="border-bottom"><span class="badge badge-info-muted">Pending</span>
                                            </td>
                                            <td class="border-bottom">Jensen Combs</td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                                <hr>
                                <div class="alert alert-info text-center">
                                    <h5>🌟 Mood Of The Last 30 Days 🌟</h5>
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
