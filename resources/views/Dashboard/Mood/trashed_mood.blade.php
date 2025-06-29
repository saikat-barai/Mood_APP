@extends('Dashboard.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Your Trushed Mood List</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            {{-- <button type="button" class="btn btn-primary btn-icon-text mb-3 mb-md-0" data-toggle="modal"
                data-target="#exampleModal">
                <i data-feather="plus"></i>
                Create New Mood
            </button> --}}
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Mood</th>
                                    <th>Note</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($moods as $mood)
                                    <tr>
                                        <td>{{ $mood->created_at->format('d F Y') }}</td>
                                        <td>{{ $mood->mood }}</td>
                                        <td>{{ $mood->note }}</td>
                                        <td>
                                            <!-- Edit Button triggers modal -->
                                            <a href="{{ route('mood.restore', ['id' => $mood->id]) }}"
                                                class="btn btn-primary">
                                                Restore
                                            </a>

                                            <!-- Delete (optional) -->
                                            <form action="{{ route('mood.hardDelete', ['id' => $mood->id]) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
