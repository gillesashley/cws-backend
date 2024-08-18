@extends('layouts.app')

@section('content')
    <!--start breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Points & Payments</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p0 align-items-center">
                    <li class="breadcrumb-item"><a href="javascript:;">
                            <ion-icon name="receipt" role="img"
                                      class="md hydrated" aria-label="home outline"></ion-icon>
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Transactions</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Settings</button>
                <button type="button"
                        class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"><span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"><a class="dropdown-item"
                                                                                       href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Payment Transactions</h6>
                <div class="fs-5 ms-auto dropdown">
                    <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown">
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <table id="example" class="table-responsive table table-striped table-bordered align-middle mb-0"
               style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Constituency</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($withdrawals) && is_array($withdrawals))
                @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td>{{ $withdrawal['id'] }}</td>
                        <td>{{ $withdrawal['user']['name'] }}</td>
                        <td>{{ $withdrawal['user']['constituency']['name'] }}</td>
                        <td>GHC {{ number_format($withdrawal['amount'], 2) }}</td>
                        <td>{{ ucfirst($withdrawal['status']) }}</td>
                        <td>
                            @if($withdrawal['status'] === 'pending')
                                <form action="{{ route('admin.withdrawals.update', $withdrawal['id']) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                </form>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#declineModal{{ $withdrawal['id'] }}">
                                    Decline
                                </button>
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>

                    <!-- Decline Modal -->
                    <div class="modal fade" id="declineModal{{ $withdrawal['id'] }}" tabindex="-1"
                         aria-labelledby="declineModalLabel{{ $withdrawal['id'] }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="declineModalLabel{{ $withdrawal['id'] }}">Decline
                                        Withdrawal
                                        Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.withdrawals.update', $withdrawal['id']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="hidden" name="status" value="rejected">
                                        <div class="mb-3">
                                            <label for="rejection_reason" class="form-label">Reason for
                                                Declining</label>
                                            <textarea class="form-control" id="rejection_reason" name="rejection_reason"
                                                      rows="3" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-danger">Decline Request</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <tr>
                    <td colspan="6">No withdrawal requests found.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@endsection
