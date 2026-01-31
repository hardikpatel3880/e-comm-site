@extends('layouts.app')

@section('content')

@session('success')
<div class="alert alert-success" role="alert">
    {{ $value }}
</div>
@endsession
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <i class="fas fa-table me-1"></i>
            Products Management
        </div>
        <a class="btn btn-success mb-2" href="{{ route('product.create') }}"><i class="fa fa-plus"></i>
            Product</a>

    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Thumbnail</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->productName }}</td>

                    <td>
                        @if ($product->productThumbnail)
                        <img src="{{ url('collection/product/thumbnail/'.$product->productThumbnail) }}" width="60"
                            height="60" style="object-fit: cover;" alt="Thumbnail">
                        @else
                        <span class="text-muted">No image</span>
                        @endif
                    </td>

                    <td>₹{{ $product->productPrice }}</td>

                    <td>
                        @if ($product->sizes->count())
                        @foreach ($product->sizes as $size)
                        <span class="badge bg-primary">{{ $size->size->size ?? '-' }}</span>
                        @endforeach
                        @else
                        <span class="text-muted">No sizes</span>
                        @endif
                    </td>
                    <td>{{ $product->status == 'Y' ? 'Active' : 'Inactive' }}</td>
                    <td>
                        <a class="btn btn-sm btn-warning" href="{{ route('product.edit', $product->id) }}"><i
                                class="fa fa-edit"></i></a>
                        <a class="btn btn-sm btn-danger" href="{{route('product.delete', $product->id)}}"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
{{-- {!! $data->links('pagination::bootstrap-5') !!} --}}

{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
{{-- <Script>
    document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('#datatablesSimple');
    if (table) {
        new simpleDatatables.DataTable(table);
    }
});

</Script> --}}
@endsection