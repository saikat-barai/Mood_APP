@extends('Dashboard.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Your Mood List</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
            <button type="button" class="btn btn-primary btn-icon-text mb-3 mb-md-0" data-toggle="modal"
                data-target="#exampleModal">
                <i data-feather="plus"></i>
                Create New Mood
            </button>
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
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#editModal{{ $mood->id }}">
                                                Edit
                                            </button>

                                            <!-- Delete (optional) -->
                                            <form action="{{ route('mood.destroy', ['id' => $mood->id]) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                {{-- @method('DELETE') --}}
                                                <button type="submit"class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- 🔽 Modal for Editing -->
                                    <div class="modal fade" id="editModal{{ $mood->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel{{ $mood->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('mood.update', ['id' => $mood->id]) }}" method="POST">
                                                @csrf
                                                {{-- @method('PUT') --}}

                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Mood</h5>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            <span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Select a Mood:</label>
                                                            <select name="mood" class="form-control">
                                                                <option value="Happy"
                                                                    {{ $mood->mood == 'Happy' ? 'selected' : '' }}>Happy
                                                                </option>
                                                                <option value="Sad"
                                                                    {{ $mood->mood == 'Sad' ? 'selected' : '' }}>Sad
                                                                </option>
                                                                <option value="Angry"
                                                                    {{ $mood->mood == 'Angry' ? 'selected' : '' }}>Angry
                                                                </option>
                                                                <option value="Excited"
                                                                    {{ $mood->mood == 'Excited' ? 'selected' : '' }}>
                                                                    Excited</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Note:</label>
                                                            <input type="text" name="note"
                                                                value="{{ $mood->note }}" class="form-control">
                                                            @error('note')
                                                                <div class="text-danger small">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Mood</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mood.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Select A Mood:</label>
                            <select name="mood" class="form-control" id="">
                                <option value="">Select Your Mood</option>
                                <option value="Happy">Happy</option>
                                <option value="Sad">Sad</option>
                                <option value="Angry">Angry</option>
                                <option value="Excited">Excited</option>
                            </select>
                            @error('mood')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Short Note:</label>
                            <input type="text" name="note" class="form-control" id="">
                            @error('note')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script></script>
@endsection
