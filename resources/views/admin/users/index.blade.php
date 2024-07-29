{{-- // index.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="ms-auto">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            Add New User
        </button>
    </div>

    <div class="card radius-10 w-100">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h6 class="mb-0">Users</h6>
                <div class="fs-5 ms-auto dropdown">
                    <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                            class="bi bi-three-dots"></i></div>
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
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered align-middle mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Region</th>
                            <th>Constituency</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user['name'] }}</td>
                                <td>{{ $user['email'] }}</td>
                                <td>{{ $user['role'] }}</td>
                                <td>{{ $user['region']['name'] ?? 'N/A' }}</td>
                                <td>{{ $user['constituency']['name'] ?? 'N/A' }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if (isset($pagination))
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        @if ($pagination['current_page'] > 1)
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ route('admin.users.index', ['page' => $pagination['current_page'] - 1]) }}"
                                    aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $pagination['total_pages']; $i++)
                            <li class="page-item {{ $pagination['current_page'] == $i ? 'active' : '' }}">
                                <a class="page-link"
                                    href="{{ route('admin.users.index', ['page' => $i]) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        @if ($pagination['current_page'] < $pagination['total_pages'])
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ route('admin.users.index', ['page' => $pagination['current_page'] + 1]) }}"
                                    aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>

    @include('admin.users.create')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush




<div class="card radius-10 w-100">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <h6 class="mb-0">Recent Orders</h6>
            <div class="fs-5 ms-auto dropdown">
                <div class="dropdown-toggle dropdown-toggle-nocaret cursor-pointer" data-bs-toggle="dropdown"><i
                        class="bi bi-three-dots"></i></div>
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
        <div class="table-responsive mt-2">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#89742</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/11.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Smart Mobile Phone</h6>
                                </div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>$214</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 8, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img" class="md hydrated"
                                        aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img" class="md hydrated"
                                        aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#68570</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/07.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Sports Time Watch</h6>
                                </div>
                            </div>
                        </td>
                        <td>1</td>
                        <td>$185</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 9, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img"
                                        class="md hydrated" aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img"
                                        class="md hydrated" aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#38567</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/17.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Women Red Heals</h6>
                                </div>
                            </div>
                        </td>
                        <td>3</td>
                        <td>$356</td>
                        <td><span class="badge alert-danger">Cancelled</span></td>
                        <td>Apr 10, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img"
                                        class="md hydrated" aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img"
                                        class="md hydrated" aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#48572</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/04.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Yellow Winter Jacket</h6>
                                </div>
                            </div>
                        </td>
                        <td>1</td>
                        <td>$149</td>
                        <td><span class="badge alert-success">Completed</span></td>
                        <td>Apr 11, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img"
                                        class="md hydrated" aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img"
                                        class="md hydrated" aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#96857</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/10.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Orange Micro Headphone</h6>
                                </div>
                            </div>
                        </td>
                        <td>2</td>
                        <td>$199</td>
                        <td><span class="badge alert-danger">Cancelled</span></td>
                        <td>Apr 15, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img"
                                        class="md hydrated" aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img"
                                        class="md hydrated" aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>#96857</td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-box border">
                                    <img src="assets/images/products/12.png" alt="">
                                </div>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Pro Samsung Laptop</h6>
                                </div>
                            </div>
                        </td>
                        <td>1</td>
                        <td>$699</td>
                        <td><span class="badge alert-warning">Pending</span></td>
                        <td>Apr 18, 2021</td>
                        <td>
                            <div class="d-flex align-items-center gap-3 fs-6">
                                <a href="javascript:;" class="text-primary" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="View detail"
                                    aria-label="Views"><ion-icon name="eye-sharp" role="img" class="md hydrated"
                                        aria-label="eye sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Edit info"
                                    aria-label="Edit"><ion-icon name="pencil-sharp" role="img"
                                        class="md hydrated" aria-label="pencil sharp"></ion-icon></a>
                                <a href="javascript:;" class="text-danger" data-bs-toggle="tooltip"
                                    data-bs-placement="bottom" title="" data-bs-original-title="Delete"
                                    aria-label="Delete"><ion-icon name="trash-sharp" role="img"
                                        class="md hydrated" aria-label="trash sharp"></ion-icon></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
